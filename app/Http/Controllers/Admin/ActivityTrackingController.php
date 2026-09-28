<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityEvent;
use App\Models\Admin;
use App\Models\AdmissionLead;
use App\Models\LeadFollowUp;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentAdmission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityTrackingController extends Controller
{
    private function dates(Request $request): array
    {
        $request->validate(['from' => 'nullable|date_format:Y-m-d', 'to' => 'nullable|date_format:Y-m-d|after_or_equal:from']);
        $tz = config('activity.timezone');
        $from = Carbon::parse($request->input('from', now($tz)->subDays(29)->toDateString()), $tz)->startOfDay();
        $to = Carbon::parse($request->input('to', now($tz)->toDateString()), $tz)->endOfDay();
        abort_if($from->gt($to) || $from->diffInDays($to) > 366, 422, 'Select a date range of up to one year.');
        return [$from->setTimezone(config('app.timezone')), $to->setTimezone(config('app.timezone'))];
    }

    public function index(Request $request)
    {
        [$from, $to] = $this->dates($request);
        $events = ActivityEvent::whereBetween('occurred_at', [$from, $to]);
        $visitors = (clone $events)->where('panel', 'website')->where('event', 'page_view')->distinct()->count('visitor_id');
        $cohort = (clone $events)->where('panel', 'website')->where('event', 'page_view')->select('visitor_id');
        $leads = AdmissionLead::whereBetween('submitted_at', [$from, $to]);
        $funnelLeads = (clone $leads)->whereIn('visitor_id', $cohort);
        $funnel = [
            'Website browsers' => $visitors,
            'Browsers starting a form' => (clone $events)->where('panel', 'website')->where('event', 'form_start')->whereIn('visitor_id', clone $cohort)->distinct()->count('visitor_id'),
            'Browsers with saved enquiries' => (clone $funnelLeads)->distinct()->count('visitor_id'),
            'Browsers linked to students' => (clone $funnelLeads)->whereNotNull('student_id')->distinct()->count('visitor_id'),
            'Browsers with approved admissions' => (clone $funnelLeads)->whereNotNull('enrolled_at')->distinct()->count('visitor_id'),
        ];
        $target = max(1, config('activity.response_target_hours'));
        $waiting = AdmissionLead::whereNull('first_response_at')->whereNotIn('status', ['closed', 'enrolled'])
            ->where('submitted_at', '<', now()->subHours($target))->count();
        $responses = (clone $leads)->whereNotNull('first_response_at')->get(['submitted_at', 'first_response_at']);
        $responseHours = $responses->isEmpty() ? null : $responses->avg(fn ($lead) => $lead->submitted_at->diffInMinutes($lead->first_response_at) / 60);
        $pages = (clone $events)->where('event', 'page_view')->select('panel', 'path')
            ->selectRaw('COUNT(*) as views, COUNT(DISTINCT visitor_id) as visitors')
            ->groupBy('panel', 'path')->orderByDesc('views')->limit(15)->get();
        $friction = (clone $events)->whereIn('event', ['field_invalid', 'form_failed'])->select('path', 'event')
            ->selectRaw('COUNT(*) as total')->groupBy('path', 'event')->orderByDesc('total')->limit(15)->get();
        $unfinished = (clone $events)->where('event', 'form_start')->where('occurred_at', '<', now()->subMinutes(30))
            ->whereNotExists(function ($q) {
                $q->selectRaw('1')->from('activity_events as submitted')
                    ->whereColumn('submitted.page_id', 'activity_events.page_id')->where('submitted.event', 'form_submit_attempt')
                    ->whereRaw("JSON_EXTRACT(submitted.metadata, '$.form') = JSON_EXTRACT(activity_events.metadata, '$.form')");
            })->count();
        $staff = LeadFollowUp::with('admin')->whereBetween('created_at', [$from, $to])->get()
            ->groupBy('admin_id')->map(fn ($rows) => [
                'name' => $rows->first()->admin?->name ?? 'Admin #'.$rows->first()->admin_id,
                'actions' => $rows->count(), 'leads' => $rows->pluck('admission_lead_id')->unique()->count(),
                'contacted' => $rows->whereIn('outcome', ['contacted', 'awaiting_student'])->count(),
            ]);
        return view('activity.dashboard', compact('funnel', 'waiting', 'responseHours', 'pages', 'friction', 'unfinished', 'staff', 'target'));
    }

    public function events(Request $request)
    {
        [$from, $to] = $this->dates($request);
        $data = $request->validate([
            'panel' => 'nullable|in:website,admin,student,api', 'actor_type' => 'nullable|in:visitor,admin,student,user',
            'actor_id' => 'nullable|integer|min:1', 'student_id' => 'nullable|integer|min:1',
            'visitor_id' => 'nullable|uuid', 'event' => 'nullable|string|max:60',
        ]);
        $query = ActivityEvent::whereBetween('occurred_at', [$from, $to]);
        foreach ($data as $key => $value) {
            if ($value !== null && $value !== '') $query->where($key, $value);
        }
        return view('activity.events', ['events' => $query->orderByDesc('occurred_at')->orderByDesc('id')->paginate(50)->withQueryString()]);
    }

    public function leads(Request $request)
    {
        $data = $request->validate(['q' => 'nullable|string|max:150', 'status' => 'nullable|in:new,contacted,awaiting_student,admission_started,enrolled,closed', 'overdue' => 'nullable|boolean']);
        $query = AdmissionLead::with(['assignedAdmin', 'student']);
        if (!empty($data['q'])) {
            $term = '%'.addcslashes($data['q'], '%_\\').'%';
            $query->where(fn ($q) => $q->where('name', 'like', $term)->orWhere('email', 'like', $term)->orWhere('phone', 'like', $term));
        }
        if (!empty($data['status'])) $query->where('status', $data['status']);
        if ($request->boolean('overdue')) {
            $query->whereNotIn('status', ['closed', 'enrolled'])->where(function ($q) {
                $q->where('next_follow_up_at', '<', now())->orWhere(fn ($q) => $q->whereNull('first_response_at')
                    ->where('submitted_at', '<', now()->subHours(config('activity.response_target_hours'))));
            });
        }
        return view('activity.leads', ['leads' => $query->orderBy('submitted_at')->paginate(30)->withQueryString()]);
    }

    public function lead(AdmissionLead $lead)
    {
        $lead->load(['student.admission', 'assignedAdmin', 'followUps.admin']);
        $events = ActivityEvent::where(function ($q) use ($lead) {
            $q->where(fn ($q) => $q->where('subject_type', 'AdmissionLead')->where('subject_id', $lead->id));
            if ($lead->visitor_id) {
                $q->orWhere(fn ($q) => $q->where('visitor_id', $lead->visitor_id)->where('actor_type', 'visitor')->where('occurred_at', '<=', $lead->submitted_at));
            }
            if ($lead->student_id) $q->orWhere('student_id', $lead->student_id);
            $q->orWhere(fn ($q) => $q->where('subject_type', 'LeadFollowUp')->whereIn('subject_id', $lead->followUps->pluck('id')));
        })->latest('occurred_at')->paginate(40);
        $matches = $lead->email && !$lead->student_id ? Student::where('email', $lead->email)->where('deleted', 0)->get(['id', 'name', 'email']) : collect();
        return view('activity.lead', compact('lead', 'events', 'matches') + ['admins' => Admin::orderBy('name')->get(['id', 'name'])]);
    }

    public function followUp(Request $request, AdmissionLead $lead)
    {
        $data = $request->validate([
            'outcome' => 'required|in:assigned,no_answer,contacted,awaiting_student,admission_started,closed',
            'note' => 'nullable|string|max:2000', 'assigned_admin_id' => 'nullable|integer|exists:admins,id',
            'student_id' => 'nullable|integer|exists:students,id',
            'next_follow_up_at' => 'nullable|date_format:Y-m-d\TH:i',
        ]);
        if (!empty($data['student_id'])) {
            $student = Student::where('deleted', 0)->findOrFail($data['student_id']);
            abort_if($lead->student_id && $lead->student_id !== $student->id, 422, 'This enquiry is already linked to a different student.');
        }
        DB::transaction(function () use ($data, $lead) {
            $lead = AdmissionLead::lockForUpdate()->findOrFail($lead->id);
            $updates = ['assigned_admin_id' => $data['assigned_admin_id'] ?? $lead->assigned_admin_id ?? auth('admin')->id()];
            if (!empty($data['student_id'])) {
                abort_if($lead->student_id && (int) $lead->student_id !== (int) $data['student_id'], 422);
                $updates['student_id'] = $data['student_id'];
            }
            if (!$lead->enrolled_at && in_array($data['outcome'], ['contacted', 'awaiting_student', 'admission_started', 'closed'])) {
                $updates['status'] = $data['outcome'];
            }
            if (!$lead->first_response_at && in_array($data['outcome'], ['contacted', 'awaiting_student'])) $updates['first_response_at'] = now();
            $updates['next_follow_up_at'] = !empty($data['next_follow_up_at'])
                ? Carbon::createFromFormat('Y-m-d\TH:i', $data['next_follow_up_at'], config('activity.timezone'))->setTimezone(config('app.timezone')) : null;
            $studentId = $updates['student_id'] ?? $lead->student_id;
            if ($studentId && StudentAdmission::where('student_id', $studentId)->where('deleted', 0)->where('admission_status', 'approved')->exists()) {
                $updates['status'] = 'enrolled';
                // Linking a pre-existing approval does not invent a historical conversion time.
                $updates['enrolled_at'] = $lead->enrolled_at ?? now();
            }
            if (in_array($updates['status'] ?? $lead->status, ['enrolled', 'closed'])) $updates['next_follow_up_at'] = null;
            $lead->update($updates);
            LeadFollowUp::create(['admission_lead_id' => $lead->id, 'admin_id' => auth('admin')->id(),
                'outcome' => $data['outcome'], 'note' => $data['note'] ?? null, 'created_at' => now()]);
        });
        return back()->with('success', 'Follow-up saved.');
    }

    public function renewals(Request $request)
    {
        $request->validate(['month' => 'nullable|date_format:Y-m', 'state' => 'nullable|in:all,unpaid']);
        $month = Carbon::createFromFormat('!Y-m', $request->input('month', now()->format('Y-m')));
        $start = $month->toDateString();
        $end = $month->copy()->endOfMonth()->toDateString();
        $paid = fn ($q) => $q->whereBetween('issue_date', [$start, $end])->where('payment_status', 'paid');
        // Same monthly paid-invoice rule used by the student dashboard and course access.
        $eligible = Student::where('deleted', 0)->whereHas('admission', fn ($q) => $q->where('deleted', 0)->where('admission_status', 'approved')->where('created_at', '<=', $month->copy()->endOfMonth()));
        $eligibleCount = (clone $eligible)->count();
        $paidCount = (clone $eligible)->whereHas('payments', $paid)->count();
        if ($request->input('state', 'unpaid') === 'unpaid') $eligible->whereDoesntHave('payments', $paid);
        $students = $eligible->with(['admission', 'payments' => fn ($q) => $q->whereBetween('issue_date', [$start, $end])])
            ->addSelect(['last_activity_at' => ActivityEvent::select('occurred_at')->whereColumn('actor_id', 'students.id')
                ->where('actor_type', 'student')->orderByDesc('occurred_at')->limit(1)])
            ->orderBy('name')->paginate(30)->withQueryString();
        return view('activity.renewals', compact('students', 'eligibleCount', 'paidCount', 'month'));
    }
}
