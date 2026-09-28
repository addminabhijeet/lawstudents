<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Support\StudentDashboard;
use App\Support\StudentPanel;

/**
 * Two read-only pages for the student panel: a fee summary that gathers what the
 * payment slip and the dashboard already know, and a help page with the office's
 * contact details. Both show only the signed-in student's own records; nothing here
 * writes to the database.
 */
class PortalController extends Controller
{
    public function fees()
    {
        $student = auth('student')->user();

        // the same set the Payment Slips page lists
        $invoices = Payment::where('student_id', $student->id)->latest()->get();
        $latest = $invoices->first();

        $month = StudentDashboard::for($student)['cards']['payment'];   // [word, state, detail]
        $owing = $latest && in_array($latest->payment_status, ['pending', 'partial'], true) ? $latest : null;
        $due = $owing ? max(0, (float) $owing->grand_total - (float) ($owing->paid_amount ?? 0)) : 0.0;

        $office = StudentPanel::office();
        $message = 'Hello, I am '.$student->name.' ('.$student->username.'). I have paid'
            .($owing ? ' invoice '.$owing->invoice_number : ' my fee').'. Please confirm and update my account. Thank you.';

        return view('portal.fees', [
            'invoices' => $invoices,
            'latest' => $latest,
            'owing' => $owing,
            'due' => $due,
            'month' => $month,
            'paidTotal' => (float) $invoices->sum('paid_amount'),
            'office' => $office,
            'whatsapp' => $office['whatsapp'] ? 'https://wa.me/'.$office['whatsapp'].'?text='.rawurlencode($message) : null,
        ]);
    }

    public function help()
    {
        return view('portal.help', ['office' => StudentPanel::office()]);
    }
}
