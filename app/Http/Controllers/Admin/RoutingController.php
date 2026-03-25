<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Course;
use App\Models\User;
use App\Models\Declaration;
use App\Models\Defaultpassword;
use App\Models\StudentAdmission;
use Illuminate\Http\RedirectResponse;

class RoutingController extends Controller
{
    public function root()
    {
        return view('demo.index');
    }

    public function log()
    {
        return view('leads-view');
    }

    public function login()
    {
        return view('auth.auth-login-minimal');
    }

    public function verify()
    {
        return view('auth.student-verify-otp');
    }

    public function register()
    {
        return view('auth.auth-register-minimal');
    }

    public function registerstu()
    {
        return view('auth.auth-registerstu-minimal');
    }

    public function listpayment()
    {
        $payments = Payment::with('student')->latest()->paginate(10);

        return view('payment.list', compact('payments'));
    }

    public function listidcard()
    {
        $payments = Payment::with('student')->latest()->paginate(10);

        return view('idcard.list', compact('payments'));
    }

    public function updatepayment(Request $request, $id)
    {
        if (!$request->has('payments')) {
            return back()->with('error', 'No payments data received');
        }

        foreach ($request->payments as $payData) {

            if (!isset($payData['id'])) continue;

            $currentPayment = Payment::find($payData['id']);
            if (!$currentPayment) continue;

            $latestPaymentId = Payment::where('student_id', $currentPayment->student_id)
                ->max('id');

            if ($currentPayment->id != $latestPaymentId) {
                continue;
            }

            $payment = Payment::where('student_id', $currentPayment->student_id)
                ->orderBy('id', 'desc')
                ->first();

            if (!$payment) continue;

            $validated = validator($payData, [
                'due_date'    => 'nullable|date',
                'paid_amount' => 'nullable|numeric|min:0',
            ])->validate();

            $dueDate = $validated['due_date'] ?? $payment->due_date;

            $paidAmount = array_key_exists('paid_amount', $validated) && $validated['paid_amount'] !== null
                ? (float) $validated['paid_amount']
                : $payment->paid_amount;

            $grandTotal = $payment->grand_total;
            $remainingAmount = $grandTotal - ($paidAmount ?? 0);

            $paymentStatus = ($paidAmount >= $grandTotal)
                ? 'paid'
                : ($paidAmount > 0 ? 'partial' : 'pending');

            $payment->update([
                'due_date'         => $dueDate,
                'paid_amount'      => $paidAmount,
                'remaining_amount' => $remainingAmount,
                'payment_status'   => $paymentStatus,
            ]);

            if (
                $paymentStatus === 'partial' &&
                $remainingAmount > 0 &&
                !empty($paidAmount) &&
                $paidAmount > 0
            ) {

                $exists = Payment::where('student_id', $payment->student_id)
                    ->where('invoice_label', 'Remaining Payment')
                    ->where('grand_total', $remainingAmount)
                    ->whereDate('created_at', now()->toDateString())
                    ->exists();

                if (!$exists) {

                    $year = date('Y');

                    $lastInvoice = Payment::where('invoice_number', 'like', 'INV' . $year . '%')
                        ->orderBy('id', 'desc')
                        ->first();

                    $nextNumber = $lastInvoice
                        ? intval(substr($lastInvoice->invoice_number, 7)) + 1
                        : 1;

                    $nextInvoiceNumber = 'INV' . $year . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

                    Payment::create([
                        'student_id'       => $payment->student_id,
                        'course_id'        => $payment->course_id,

                        'invoice_label'    => 'Remaining Payment',
                        'invoice_number'   => $nextInvoiceNumber,
                        'invoice_product'  => $payment->invoice_product,

                        'issue_date'       => now(),
                        'due_date'         => $dueDate ?? now()->addDays(7),

                        'to_name'          => $payment->to_name,
                        'to_email'         => $payment->to_email,
                        'to_phone'         => $payment->to_phone,
                        'to_address'       => $payment->to_address,

                        'sub_total'        => $remainingAmount,
                        'grand_total'      => $remainingAmount,

                        'currency'         => $payment->currency,

                        'payment_status'   => 'pending',
                        'paid_amount'      => null,
                        'remaining_amount' => $remainingAmount,
                    ]);
                }
            }
        }
        return redirect()
            ->route('admin.listpayment')
            ->with('success', 'All payments updated successfully.');
    }

    public function addpayment()
    {
        return view('payment.add');
    }

    public function listadmission()
    {
        return view('admission.list');
    }

    public function addadmission()
    {
        $courses = Course::where('status', 1)->get();
        $declaration = Declaration::first();

        return view('admission.add', compact('courses', 'declaration'));
    }

    public function student()
    {
        return view('dashboard.student');
    }

    public function liststudent()
    {
        $students = Student::where('deleted', 0)->paginate(10);
        return view('student.list', compact('students'));
    }

    public function editstudent($id)
    {
        $student = Student::where('deleted', 0)->findOrFail($id);
        $defaultpassword = Defaultpassword::latest('id')->value('defaultpassword');
        return view('student.edit', compact('student', 'defaultpassword'));
    }

    public function viewstudent($id)
    {
        $student = Student::where('deleted', 0)->findOrFail($id);
        $defaultpassword = User::first()->value('defaultpass');
        return view('student.view', compact('student', 'defaultpassword'));
    }

    public function destroystudent($id)
    {
        $student = Student::findOrFail($id);
        $student->update(['deleted' => 1]);
        return redirect()->back()->with('success', 'Student deleted successfully.');
    }

    public function editpayment($id)
    {
        $payment = Payment::findOrFail($id);

        // Get all payments of the same student
        $allPayments = Payment::where('student_id', $payment->student_id)->get();

        return view('payment.edit', compact('payment', 'allPayments'));
    }

    public function viewpayment($id)
    {
        $payment = Payment::findOrFail($id);
        return view('payment.view', compact('payment'));
    }

    public function viewidcard($id)
    {
        $idcard = Payment::findOrFail($id);

        $admission = StudentAdmission::where('student_id', $idcard->student_id)->firstOrFail();

        return view('idcard.idcard', compact('idcard', 'admission'));
    }

    public function listnotes()
    {
        return view('notes.list');
    }

    public function listsubject()
    {
        return view('subject.list');
    }

    public function listcourse()
    {
        return view('course.list');
    }

    public function addstudent()
    {
        // Get the last student username
        $lastStudent = Student::latest('id')->first();
        $defaultpassword = User::first()->value('defaultpass');
        if ($lastStudent && preg_match('/STU(\d+)/', $lastStudent->username, $matches)) {
            $lastNumber = (int) $matches[1];
            $username = 'STU' . str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $username = 'STU00001';
        }

        return view('student.add', compact('username', 'defaultpassword'));
    }

    public function admin()
    {
        $studentsCount = \App\Models\Student::count();
        $admissionsCount = \App\Models\StudentAdmission::count();
        $paymentsCount = \App\Models\Payment::count();
        $idCardsCount = \App\Models\StudentAdmission::whereNotNull('admno')->count();
        $coursesCount = \App\Models\Course::count();
        $notesCount = \App\Models\CourseNote::count();

        return view('dashboard.admin', compact(
            'studentsCount',
            'admissionsCount',
            'paymentsCount',
            'idCardsCount',
            'coursesCount',
            'notesCount'
        ));
    }

    public function registerstusubmit(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:students,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Generate username
        $lastStudent = \App\Models\Student::latest('id')->first();
        if ($lastStudent && preg_match('/STU(\d+)/', $lastStudent->username, $matches)) {
            $username = 'STU' . str_pad((int)$matches[1] + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $username = 'STU00001';
        }

        // Create Student
        $student = Student::create([
            'name' => $data['name'],
            'username' => $username,
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // Create Admission
        $admission = StudentAdmission::create([
            'student_id' => $student->id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'father_name' => $request->father_name,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'course_ids' => $request->course_ids,
            'admission_status' => $request->admission_status,
            'paidamount' => $request->paidamount ?? 0,
            'remamount' => $request->remamount ?? 0,
        ]);

        // ===============================
        // PAYMENT LOGIC (same as update)
        // ===============================

        $year = date('Y');

        $lastInvoice = Payment::where('invoice_number', 'like', 'INV' . $year . '%')
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = $lastInvoice
            ? intval(substr($lastInvoice->invoice_number, 7)) + 1
            : 1;

        $invoiceNumber = 'INV' . $year . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        $courses = Course::whereIn('id', $request->course_ids ?? [])->get();

        $subTotal = $courses->sum('price');

        $discountPercent = (float) ($request->discount_percent ?? 0);
        $discountAmount  = (float) ($request->discount ?? ($subTotal * ($discountPercent / 100)));
        $grandTotal      = $subTotal - $discountAmount;

        $paidAmount      = (float) ($request->paidamount ?? 0);
        $remainingAmount = (float) ($request->remamount ?? ($grandTotal - $paidAmount));

        $paymentStatus = $paidAmount >= $grandTotal
            ? 'paid'
            : ($paidAmount > 0 ? 'partial' : 'pending');

        Payment::create([
            'student_id'      => $student->id,
            'invoice_label'   => 'Admission Fee',
            'course_id'       => !empty($request->course_ids) ? implode(',', $request->course_ids) : null,
            'invoice_number'  => $invoiceNumber,
            'invoice_product' => $courses->pluck('title')->implode(', '),

            'issue_date'      => now(),
            'due_date'        => now()->addDays(7),

            'to_name'         => $request->full_name,
            'to_email'        => $request->email,
            'to_phone'        => $request->phone,
            'to_address'      => $request->address_line1,

            'sub_total'       => $subTotal,
            'discount'        => $discountAmount,
            'discount_percent' => $discountPercent,
            'grand_total'     => $grandTotal,

            'currency'        => 'INR',
            'payment_status'  => $paymentStatus,
            'paid_amount'     => $paidAmount,
            'remaining_amount' => $remainingAmount,
        ]);

        // ✅ Handle partial payment (same logic)
        if ($paymentStatus === 'partial') {

            Payment::create([
                'student_id'      => $student->id,
                'invoice_label'   => 'Admission Fee (Remaining)',
                'course_id'       => !empty($request->course_ids) ? implode(',', $request->course_ids) : null,
                'invoice_number'  => 'INV' . $year . str_pad($nextNumber + 1, 6, '0', STR_PAD_LEFT),
                'invoice_product' => $courses->pluck('title')->implode(', '),

                'issue_date'      => now(),
                'due_date'        => now()->addDays(7),

                'to_name'         => $request->full_name,
                'to_email'        => $request->email,
                'to_phone'        => $request->phone,
                'to_address'      => $request->address_line1,

                'sub_total'       => $remainingAmount,
                'grand_total'     => $remainingAmount,

                'currency'        => 'INR',
                'payment_status'  => 'pending',
            ]);
        }

        return redirect()->route('admin.editadmission', ['id' => $admission->id])
            ->with('success', 'Student Registed Successfully, Now Fill Admission Details.');
    }


    public function updatestusubmit(Request $request, $id): RedirectResponse
    {
        $student = Student::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:students,email,' . $student->id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        $student->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] ?? $student->password,
        ]);

        return redirect()->route('admin.liststudent')
            ->with('success', 'Student updated successfully.');
    }
}
