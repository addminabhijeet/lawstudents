<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentAdmission;
use App\Support\FeeDues;
use App\Support\AdminListing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Reports and exports (read only): a "who owes what" page, and spreadsheet (CSV)
 * downloads of every record, not just the page on screen.
 * Nothing here changes stored data. Aadhaar and PAN numbers are never exported.
 */
class ReportController extends Controller
{
    private const TYPES = ['students', 'admissions', 'payments', 'dues', 'messages'];

    public function index()
    {
        $counts = [
            'students' => Student::where('deleted', 0)->count(),
            'admissions' => StudentAdmission::where('deleted', 0)->count(),
            'payments' => Payment::where('deleted', 0)->count(),
            'dues' => FeeDues::query()->count(),
            'messages' => ContactForm::where('delete', 1)->count(),
        ];

        return view('reports.index', compact('counts'));
    }

    public function dues(Request $request)
    {
        $data = $request->validate([
            'filter' => 'nullable|in:all,overdue,soon,undated,partial',
            'q' => 'nullable|string|max:80',
        ]);
        $filter = $data['filter'] ?? 'all';

        $totals = [
            'all' => FeeDues::totals(FeeDues::query()),
            'overdue' => FeeDues::totals(FeeDues::overdue()),
            'soon' => FeeDues::totals(FeeDues::dueSoon()),
            'undated' => FeeDues::totals(FeeDues::undated()),
            'partial' => FeeDues::totals(FeeDues::query()->where('payment_status', 'partial')),
        ];

        $query = match ($filter) {
            'overdue' => FeeDues::overdue(),
            'soon' => FeeDues::dueSoon(),
            'undated' => FeeDues::undated(),
            'partial' => FeeDues::query()->where('payment_status', 'partial'),
            default => FeeDues::query(),
        };

        if (!empty($data['q'])) {
            $term = '%'.addcslashes(trim($data['q']), '%_\\').'%';
            $query->where(fn ($q) => $q->where('to_name', 'like', $term)->orWhere('to_email', 'like', $term)
                ->orWhere('to_phone', 'like', $term)->orWhere('invoice_number', 'like', $term));
        }

        $rows = AdminListing::paginate(
            $query->orderByRaw('due_date IS NULL, due_date ASC')->orderBy('id'), $request
        );

        return view('reports.dues', [
            'rows' => $rows,
            'filter' => $filter,
            'q' => $data['q'] ?? '',
            'totals' => $totals,
        ]);
    }

    public function export(Request $request, string $type): StreamedResponse
    {
        abort_unless(in_array($type, self::TYPES, true), 404);

        $filters = $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'status' => 'nullable|string|max:20',
        ]);

        [$header, $rows] = match ($type) {
            'students' => $this->students(),
            'admissions' => $this->admissions($filters),
            'payments' => $this->payments($filters),
            'dues' => $this->duesRows(),
            'messages' => $this->messages($filters),
        };

        $name = 'law-students-'.$type.'-'.now(config('activity.timezone', 'Asia/Kolkata'))->format('Y-m-d').'.csv';

        return response()->streamDownload(function () use ($header, $rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // so Excel reads it as UTF-8
            fputcsv($out, $header);
            foreach ($rows() as $row) {
                fputcsv($out, array_map([$this, 'safe'], $row));
            }
            fclose($out);
        }, $name, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /* ---------------------------------------------------------------- */

    private function students(): array
    {
        $header = ['Username', 'Name', 'Email', 'Registered on'];
        $rows = function () {
            foreach (Student::where('deleted', 0)->orderBy('id')->cursor() as $s) {
                yield [$s->username, $s->name, $s->email, optional($s->created_at)->format('Y-m-d H:i')];
            }
        };

        return [$header, $rows];
    }

    private function admissions(array $f): array
    {
        $header = ['Admission no', 'Name', 'Email', 'Phone', 'Alternate phone', "Father's name", 'City', 'State', 'Pincode',
            'Course(s)', 'Session', 'Status', 'Fee paid', 'Fee remaining', 'Applied on'];
        $titles = Course::pluck('title', 'id');
        $rows = function () use ($f, $titles) {
            $q = StudentAdmission::where('deleted', 0)->orderBy('id');
            if (!empty($f['status'])) {
                $q->where('admission_status', $f['status']);
            }
            $this->between($q, $f);
            foreach ($q->cursor() as $a) {
                $courses = collect($a->course_ids ?? [])->map(fn ($id) => $titles[$id] ?? null)->filter()->implode('; ');
                yield [$a->admno, $a->full_name, $a->email, $a->phone, $a->alternate_phone, $a->father_name, $a->city, $a->state,
                    $a->pincode, $courses, $a->admission_session, $a->admission_status ?: 'pending', $a->paidamount, $a->remamount,
                    optional($a->created_at)->format('Y-m-d H:i')];
            }
        };

        return [$header, $rows];
    }

    private function payments(array $f): array
    {
        $header = ['Invoice no', 'Type', 'Student', 'Email', 'Phone', 'Course(s)', 'Issue date', 'Due date', 'Total', 'Paid',
            'Remaining', 'Status', 'Created on'];
        $rows = function () use ($f) {
            $q = Payment::where('deleted', 0)->orderBy('id');
            if (!empty($f['status'])) {
                $q->where('payment_status', $f['status']);
            }
            $this->between($q, $f);
            foreach ($q->cursor() as $p) {
                yield $this->paymentRow($p);
            }
        };

        return [$header, $rows];
    }

    private function duesRows(): array
    {
        $header = ['Invoice no', 'Type', 'Student', 'Email', 'Phone', 'Course(s)', 'Issue date', 'Due date', 'Total', 'Paid',
            'Remaining', 'Status', 'Created on', 'Days overdue'];
        $rows = function () {
            foreach (FeeDues::query()->orderByRaw('due_date IS NULL, due_date ASC')->orderBy('id')->cursor() as $p) {
                $late = $p->due_date && $p->due_date->isPast() ? (int) $p->due_date->diffInDays(now()->startOfDay()) : 0;
                yield array_merge($this->paymentRow($p), [$late]);
            }
        };

        return [$header, $rows];
    }

    private function paymentRow(Payment $p): array
    {
        $remaining = $p->remaining_amount;

        return [$p->invoice_number, $p->invoice_label, $p->to_name, $p->to_email, $p->to_phone, $p->invoice_product,
            optional($p->issue_date)->format('Y-m-d'), optional($p->due_date)->format('Y-m-d'), $p->grand_total,
            $p->paid_amount ?? 0, $remaining, $p->payment_status, optional($p->created_at)->format('Y-m-d H:i')];
    }

    private function messages(array $f): array
    {
        $header = ['Received on', 'Name', 'Email', 'Phone', 'Service', 'Message'];
        $rows = function () use ($f) {
            $q = ContactForm::where('delete', 1)->orderBy('id');
            $this->between($q, $f);
            foreach ($q->cursor() as $m) {
                yield [optional($m->created_at)->format('Y-m-d H:i'), trim($m->first_name.' '.$m->last_name), $m->email, $m->phone,
                    $m->service_type, $m->message];
            }
        };

        return [$header, $rows];
    }

    private function between($query, array $f): void
    {
        if (!empty($f['from'])) {
            $query->where('created_at', '>=', Carbon::parse($f['from'], config('activity.timezone', 'Asia/Kolkata'))->startOfDay()->utc());
        }
        if (!empty($f['to'])) {
            $query->where('created_at', '<=', Carbon::parse($f['to'], config('activity.timezone', 'Asia/Kolkata'))->endOfDay()->utc());
        }
    }

    /** A spreadsheet runs text that starts with = + - @ as a formula: mark it as text. */
    private function safe($value): string
    {
        $value = (string) ($value ?? '');
        if ($value !== '' && preg_match('/^[=+\-@\t\r]/', $value) && !is_numeric($value)) {
            return "'".$value;
        }

        return $value;
    }
}
