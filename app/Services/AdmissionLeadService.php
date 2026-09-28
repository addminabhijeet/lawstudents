<?php

namespace App\Services;

use App\Models\AdmissionLead;
use App\Models\ContactForm;
use App\Models\Student;
use App\Models\StudentAdmission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdmissionLeadService
{
    public function sync(Model $model, Request $request, string $event): void
    {
        if ($model instanceof ContactForm && $event === 'created') {
            AdmissionLead::firstOrCreate(['contact_form_id' => $model->id], [
                'visitor_id' => app(ActivityTracker::class)->context($request)['visitor_id'],
                'name' => mb_substr(trim($model->first_name.' '.$model->last_name), 0, 150),
                'email' => $model->email, 'phone' => $model->phone,
                'course_interest' => $model->service_type, 'source' => 'contact_form',
                'submitted_at' => $model->created_at ?? now(),
            ]);
        }
        if ($model instanceof Student && $event === 'created' && auth('admin')->check()
            && $request->routeIs('admin.registerstusubmit') && $request->filled('admission_lead_id')) {
            // A hidden, admin-only lead reference joins the existing registration workflow.
            AdmissionLead::whereKey($request->integer('admission_lead_id'))->whereNull('student_id')->get()
                ->each(fn ($lead) => $lead->update(['student_id' => $model->id, 'status' => 'admission_started',
                    'assigned_admin_id' => auth('admin')->id()]));
        }
        if ($model instanceof StudentAdmission && $model->admission_status === 'approved' && $event !== 'deleted') {
            AdmissionLead::where('student_id', $model->student_id)->whereNull('enrolled_at')->get()
                ->each(fn ($lead) => $lead->update(['status' => 'enrolled', 'enrolled_at' => now(), 'next_follow_up_at' => null]));
        }
    }
}
