<?php

namespace App\Support;

use App\Models\AdmissionLead;
use App\Models\ContactForm;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentAdmission;
use Carbon\Carbon;

/**
 * Extra numbers and short lists for the admin dashboard (read only).
 *
 * The dashboard route keeps its own counts; this adds the money, trend and "needs
 * attention" figures around them. Every query is a plain read, and a failed one
 * leaves its widget empty instead of breaking the page.
 */
class AdminDashboard
{
    public function build(): array
    {
        $now = now();
        $monthStart = $now->copy()->startOfMonth();
        $lastMonthStart = $now->copy()->subMonthNoOverflow()->startOfMonth();

        $data = [
            'today' => now(config('activity.timezone', 'Asia/Kolkata')),
            'money' => ['billed' => 0, 'collected' => 0, 'outstanding' => 0, 'rate' => 0],
            'students' => ['this_month' => 0, 'last_month' => 0, 'delta' => null],
            'admission_status' => ['approved' => 0, 'pending' => 0, 'rejected' => 0],
            'payment_status' => ['paid' => 0, 'partial' => 0, 'pending' => 0, 'other' => 0],
            'overdue' => ['count' => 0, 'amount' => 0, 'rows' => []],
            'enquiries' => ['messages' => 0, 'leads' => 0],
            'series' => ['labels' => [], 'students' => [], 'billed' => [], 'collected' => []],
            'recent_students' => collect(),
            'recent_payments' => collect(),
            'recent_messages' => collect(),
            'awaiting_approval' => collect(),
        ];

        $this->safely(function () use (&$data) {
            $row = Payment::where('deleted', 0)
                ->selectRaw('COALESCE(SUM(grand_total),0) as billed, COALESCE(SUM(paid_amount),0) as collected')
                ->first();
            $billed = (float) $row->billed;
            $collected = (float) $row->collected;
            $data['money'] = [
                'billed' => $billed,
                'collected' => $collected,
                'outstanding' => max(0, $billed - $collected),
                'rate' => $billed > 0 ? (int) round($collected / $billed * 100) : 0,
            ];
        });

        $this->safely(function () use (&$data, $monthStart, $lastMonthStart) {
            $data['students']['this_month'] = Student::where('deleted', 0)->where('created_at', '>=', $monthStart)->count();
            $data['students']['last_month'] = Student::where('deleted', 0)
                ->where('created_at', '>=', $lastMonthStart)->where('created_at', '<', $monthStart)->count();
            $last = $data['students']['last_month'];
            // a percentage over a tiny base is noise, so it is shown only against 5+ students
            $data['students']['delta'] = $last >= 5 ? (int) round(($data['students']['this_month'] - $last) / $last * 100) : null;
        });

        $this->safely(function () use (&$data) {
            $rows = StudentAdmission::where('deleted', 0)->selectRaw('admission_status as status, COUNT(*) as total')->groupBy('admission_status')->get();
            foreach ($rows as $row) {
                $key = in_array($row->status, ['approved', 'rejected'], true) ? $row->status : 'pending';
                $data['admission_status'][$key] += (int) $row->total;
            }
        });

        $this->safely(function () use (&$data) {
            $rows = Payment::where('deleted', 0)->selectRaw('payment_status as status, COUNT(*) as total')->groupBy('payment_status')->get();
            foreach ($rows as $row) {
                $key = in_array($row->status, ['paid', 'partial', 'pending'], true) ? $row->status : 'other';
                $data['payment_status'][$key] += (int) $row->total;
            }
        });

        $this->safely(function () use (&$data) {
            $totals = FeeDues::totals(FeeDues::overdue());
            $data['overdue']['count'] = $totals['count'];
            $data['overdue']['amount'] = $totals['amount'];
            $data['overdue']['rows'] = FeeDues::overdue()->orderBy('due_date')->limit(5)
                ->get(['id', 'to_name', 'invoice_number', 'due_date', 'remaining_amount', 'grand_total', 'paid_amount']);
        });

        $this->safely(function () use (&$data) {
            $data['enquiries']['messages'] = ContactForm::where('delete', 1)->where('created_at', '>=', now()->subDays(7))->count();
            $data['enquiries']['leads'] = AdmissionLead::where('status', 'new')->count();
        });

        $this->safely(function () use (&$data, $monthStart) {
            $months = [];
            for ($i = 5; $i >= 0; $i--) {
                $m = $monthStart->copy()->subMonthsNoOverflow($i);
                $months[$m->format('Y-m')] = ['label' => $m->format('M'), 'students' => 0, 'billed' => 0.0, 'collected' => 0.0];
            }
            $from = $monthStart->copy()->subMonthsNoOverflow(5);

            foreach (Student::where('deleted', 0)->where('created_at', '>=', $from)->pluck('created_at') as $at) {
                $key = Carbon::parse($at)->format('Y-m');
                if (isset($months[$key])) {
                    $months[$key]['students']++;
                }
            }
            foreach (Payment::where('deleted', 0)->where('created_at', '>=', $from)->get(['created_at', 'grand_total', 'paid_amount']) as $p) {
                $key = Carbon::parse($p->created_at)->format('Y-m');
                if (isset($months[$key])) {
                    $months[$key]['billed'] += (float) $p->grand_total;
                    $months[$key]['collected'] += (float) $p->paid_amount;
                }
            }

            $data['series'] = [
                'labels' => array_column($months, 'label'),
                'students' => array_column($months, 'students'),
                'billed' => array_map('round', array_column($months, 'billed')),
                'collected' => array_map('round', array_column($months, 'collected')),
            ];
        });

        $this->safely(function () use (&$data) {
            $data['recent_students'] = Student::where('deleted', 0)->latest('id')->limit(6)->get(['id', 'name', 'username', 'email', 'created_at']);
            $data['recent_payments'] = Payment::where('deleted', 0)->latest('id')->limit(6)
                ->get(['id', 'to_name', 'invoice_number', 'payment_status', 'grand_total', 'paid_amount', 'created_at']);
            $data['recent_messages'] = ContactForm::where('delete', 1)->latest('id')->limit(5)
                ->get(['id', 'first_name', 'last_name', 'service_type', 'message', 'created_at']);
            $data['awaiting_approval'] = StudentAdmission::where('deleted', 0)
                ->where(fn ($q) => $q->whereNull('admission_status')->orWhere('admission_status', 'pending'))
                ->latest('id')->limit(5)->get(['id', 'full_name', 'admno', 'created_at']);
        });

        return $data;
    }

    private function safely(callable $fn): void
    {
        try {
            $fn();
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
