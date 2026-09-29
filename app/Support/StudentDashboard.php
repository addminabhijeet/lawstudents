<?php

namespace App\Support;

use App\Models\Category;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentAdmission;
use Carbon\Carbon;

/**
 * What the student dashboard shows, worked out with the same rules as the pages its
 * cards open, so the dashboard never says one thing while the page says another:
 *  - admission: the record the Admission page shows (not deleted, first one)
 *  - payment:   a paid invoice issued this month, the rule that unlocks My Courses
 *  - invoices:  every invoice the Payment page lists
 *  - ID card:   the latest invoice marked for an ID card, the rule the ID Card page uses
 * Read only: nothing here writes to the database.
 */
class StudentDashboard
{
    /** Card states, used for colour and the next step: done, wait, alert, todo, info. */
    public static function for(Student $student): array
    {
        $now = Carbon::now();
        $month = $now->format('F Y');

        $admission = StudentAdmission::where('deleted', 0)
            ->where('student_id', $student->id)
            ->first();

        $invoices = Payment::where('student_id', $student->id)->latest()->get();
        $thisMonth = $invoices->filter(fn ($p) => $p->issue_date && $p->issue_date->isSameMonth($now));
        $paidThisMonth = $thisMonth->where('payment_status', 'paid');
        $lastPaid = $invoices->where('payment_status', 'paid')->first();
        $latest = $invoices->first();

        /* My Courses: the courses of this month's paid invoices that sit in a category
           ISSUE-QA-004 FIX: If no paid courses found this month, include latest paid payment (ISSUE-003 fallback) */
        $courseIds = $paidThisMonth->pluck('course_id')->filter()
            ->flatMap(fn ($ids) => explode(',', $ids))
            ->map(fn ($id) => (int) $id)->unique()->values()->all();

        // If no courses found this month, check latest paid payment (ISSUE-003 fallback logic)
        if (empty($courseIds) && $lastPaid && $lastPaid->course_id) {
            $courseIds = array_map('intval', array_filter(explode(',', $lastPaid->course_id)));
        }

        $openCourses = $courseIds
            ? Category::whereHas('courses', fn ($q) => $q->whereIn('id', $courseIds))
                ->with(['courses' => fn ($q) => $q->whereIn('id', $courseIds)])
                ->get()->flatMap->courses->unique('id')->count()
            : 0;

        $idCardReady = $latest && $latest->viewid;

        /* ---- the five cards ---- */
        $status = $admission?->admission_status;
        [$admText, $admState, $admDetail] = match (true) {
            ! $admission => ['Not started', 'todo', 'Contact the office to complete it'],
            $status === 'approved' => ['Approved', 'done', 'Admission No ' . $admission->admno],
            $status === 'rejected' => ['Not approved', 'alert', 'Please contact the office'],
            default => ['Under review', 'wait', 'Admission No ' . $admission->admno],   // pending, or no decision yet
        };

        if ($paidThisMonth->isNotEmpty()) {
            [$payText, $payState] = ['Paid', 'done'];
            $payDetail = $month . ' fee received';
        } elseif ($thisMonth->where('payment_status', 'partial')->isNotEmpty()) {
            [$payText, $payState] = ['Part paid', 'wait'];
            $payDetail = $month . ' fee partly received';
        } else {
            [$payText, $payState] = ['Due', 'alert'];
            $payDetail = $month . ' fee not received yet';
        }
        if ($payState !== 'done' && $lastPaid) {
            $payDetail .= ' · last paid ' . self::money($lastPaid->paid_amount)
                . ($lastPaid->issue_date ? ' on ' . $lastPaid->issue_date->format('d M Y') : '');
        }

        $count = $invoices->count();
        $cards = [
            'registration' => ['Registered', 'done', 'Registration No ' . ($student->username ?: '—')],
            'admission' => [$admText, $admState, $admDetail],
            'payment' => [$payText, $payState, $payDetail],
            'invoice' => [
                (string) $count,
                'info',                                                // a count, not a to-do
                $latest ? 'Latest ' . $latest->invoice_number . ($latest->issue_date ? ' · ' . $latest->issue_date->format('d M Y') : '') : 'No invoices yet',
            ],
            'idcard' => $idCardReady
                ? ['Ready', 'done', 'Open to print or save as PDF']
                : ['Not yet', 'todo', 'Will be generated when the office marks your payment as confirmed'],
        ];

        return [
            'name' => $student->name,
            'firstName' => strtok(trim((string) $student->name), ' ') ?: 'there',
            'registrationNo' => $student->username,
            'admissionNo' => $admission?->admno,
            'today' => $now->format('l, j F Y'),
            'month' => $month,
            'openCourses' => $openCourses,
            'idCardReady' => (bool) $idCardReady,
            'invoiceCount' => $count,
            'cards' => $cards,
            'next' => self::nextStep($admission, $status, $openCourses, $month),
        ];
    }

    /** The one thing the student should do (or know) now, most urgent first. */
    private static function nextStep(?StudentAdmission $admission, ?string $status, int $openCourses, string $month): array
    {
        /* (the office records admissions: the student-side form posts to the admin panel) */
        if (! $admission) {
            return [
                'state' => 'todo', 'icon' => 'feather-edit-3',
                'title' => 'Your admission has not been set up yet',
                'text' => 'Please contact the office to complete your admission. Once it is approved, your fee details and courses follow.',
                'actions' => [['Contact the office', route('frontend.contact'), true]],
            ];
        }

        if ($status === 'rejected') {
            return [
                'state' => 'alert', 'icon' => 'feather-alert-circle',
                'title' => 'Your admission was not approved',
                'text' => 'Please contact the office to find out why and what you can do next.',
                'actions' => [['Contact the office', route('frontend.contact'), true], ['View admission', route('student.viewadmission'), false]],
            ];
        }

        if ($openCourses === 0) {
            return [
                'state' => 'alert', 'icon' => 'feather-lock',
                'title' => 'Pay your ' . $month . ' fee to open your courses',
                'text' => 'Courses open month by month. As soon as the office marks your ' . $month
                    . ' payment as paid, your courses appear under My Courses. The bank details are on your payment slip.',
                'actions' => [['Payment details', route('student.viewpayment'), true], ['Contact the office', route('frontend.contact'), false]],
            ];
        }

        if ($status !== 'approved') {
            return [
                'state' => 'wait', 'icon' => 'feather-clock',
                'title' => 'Your admission is under review',
                'text' => 'Your courses are open. The office is still checking your admission; this page updates when they do.',
                'actions' => [['Open My Courses', route('student.listcourse'), true], ['View admission', route('student.viewadmission'), false]],
            ];
        }

        return [
            'state' => 'done', 'icon' => 'feather-check-circle',
            'title' => 'You are all set for ' . $month,
            'text' => $openCourses . ' ' . ($openCourses === 1 ? 'course is' : 'courses are') . ' open for you this month.',
            'actions' => [['Open My Courses', route('student.listcourse'), true]],
        ];
    }

    private static function money($amount): string
    {
        return '₹' . number_format((float) $amount, 0);
    }
}
