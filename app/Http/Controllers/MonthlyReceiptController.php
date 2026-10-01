<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class MonthlyReceiptController extends Controller
{
    public function adminIndex(Request $request)
    {
        $studentId = $request->validate(['student_id' => ['nullable', 'integer', 'min:1']])['student_id'] ?? null;
        $query = Payment::query()->where('deleted', 0);
        if ($studentId !== null) {
            $query->where('student_id', $studentId);
        }

        $studentName = $studentId ? Student::find($studentId)?->name : null;

        return $this->index($query, true, $studentId, $studentName);
    }

    public function studentIndex()
    {
        return $this->index(
            Payment::query()->where('deleted', 0)->where('student_id', auth('student')->id()),
            false
        );
    }

    private function index($query, bool $isAdmin, ?int $studentId = null, ?string $studentName = null)
    {
        $months = $query->with('student')->orderByRaw('COALESCE(issue_date, created_at) DESC')
            ->orderByDesc('id')
            ->get()
            ->groupBy(fn (Payment $receipt) => ($receipt->issue_date ?? $receipt->created_at)?->format('Y-m') ?? 'Undated');

        return view('payment.monthly', compact('months', 'isAdmin', 'studentId', 'studentName'));
    }

    public function adminShow(Payment $receipt)
    {
        abort_if((int) $receipt->deleted !== 0, 404);

        return $this->show($receipt, 'payment.view');
    }

    public function studentShow(Payment $receipt)
    {
        abort_if((int) $receipt->deleted !== 0 || (int) $receipt->student_id !== (int) auth('student')->id(), 404);

        return $this->show($receipt, 'paymentstu.view');
    }

    private function show(Payment $receipt, string $view)
    {
        $payment = $receipt;
        $payments = collect([$receipt]);
        $notFound = false;

        return view($view, compact('payment', 'payments', 'notFound'));
    }
}
