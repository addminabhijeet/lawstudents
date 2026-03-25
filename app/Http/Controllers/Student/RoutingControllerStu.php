<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Defaultpassword;
use App\Models\StudentAdmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RoutingControllerStu extends Controller
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
        $payments = Payment::with('student')->latest()->get();

        return view('paymentstu.list', compact('payments'));
    }

    public function updatepayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'invoice_label'     => 'nullable|string|max:255',
            'invoice_number'    => 'required|string|max:255',
            'invoice_product'   => 'nullable|string|max:255',

            'issue_date'        => 'required|date',
            'due_date'          => 'required|date|after_or_equal:issue_date',

            'from_name'         => 'required|string|max:255',
            'from_email'        => 'nullable|email|max:255',
            'from_phone'        => 'nullable|string|max:20',
            'from_address'      => 'nullable|string',

            'to_name'           => 'required|string|max:255',
            'to_email'          => 'nullable|email|max:255',
            'to_phone'          => 'nullable|string|max:20',
            'to_address'        => 'nullable|string',

            'items'                     => 'required|array|min:1',
            'items.*.product'           => 'required|string|max:255',
            'items.*.qty'               => 'required|numeric|min:1',
            'items.*.price'             => 'required|numeric|min:0',

            'tax_percentage'    => 'nullable|numeric|min:0',
            'discount'          => 'nullable|numeric|min:0',

            'currency'          => 'required|string|max:10',
            'payment_method'    => 'nullable|string|in:debit,paypal',

            'invoice_note'      => 'nullable|string',
        ]);

        $subTotal = 0;
        $items = [];

        foreach ($validated['items'] as $item) {

            $qty = (float) $item['qty'];
            $price = (float) $item['price'];
            $total = $qty * $price;

            $subTotal += $total;

            $items[] = [
                'product' => $item['product'],
                'qty'     => $qty,
                'price'   => $price,
                'total'   => $total,
            ];
        }

        $taxPercentage = (float) ($validated['tax_percentage'] ?? 0);
        $taxAmount = ($subTotal * $taxPercentage) / 100;

        $discount = (float) ($validated['discount'] ?? 0);

        $grandTotal = $subTotal + $taxAmount - $discount;

        $payment->update([
            'invoice_label'     => $validated['invoice_label'] ?? null,
            'invoice_number'    => $validated['invoice_number'],
            'invoice_product'   => $validated['invoice_product'] ?? null,

            'issue_date'        => $validated['issue_date'],
            'due_date'          => $validated['due_date'],

            'from_name'         => $validated['from_name'],
            'from_email'        => $validated['from_email'] ?? null,
            'from_phone'        => $validated['from_phone'] ?? null,
            'from_address'      => $validated['from_address'] ?? null,

            'to_name'           => $validated['to_name'],
            'to_email'          => $validated['to_email'] ?? null,
            'to_phone'          => $validated['to_phone'] ?? null,
            'to_address'        => $validated['to_address'] ?? null,

            'items'             => $items,

            'sub_total'         => $subTotal,
            'tax_percentage'    => $taxPercentage,
            'tax_amount'        => $taxAmount,
            'discount'          => $discount,
            'grand_total'       => $grandTotal,

            'currency'          => $validated['currency'],

            'payment_method'    => $validated['payment_method'] ?? null,

            'invoice_note'      => $validated['invoice_note'] ?? null,

            'late_fees'         => $request->has('late_fees'),
            'client_note_enabled' => $request->has('client_note_enabled'),
            'save_payment'      => $request->has('save_payment'),
        ]);

        return redirect()
            ->route('admin.listpayment')
            ->with('success', 'Payment updated successfully.');
    }

    public function addpayment()
    {
        return view('paymentstu.add');
    }

    public function listadmission()
    {
        return view('admissionstu.list');
    }

    public function addadmission()
    {
        return view('admissionstu.add');
    }

    public function student()
    {
        $student = auth()->guard('student')->user();

        // Registration (student account exists)
        $registration = $student ? 'Yes' : 'No';

        // Admission
        $admission = StudentAdmission::where('student_id', $student->id)->exists() ? 'Yes' : 'No';

        // Payment
        $payment = Payment::where('student_id', $student->id)
            ->where('payment_status', 'paid')
            ->exists() ? 'Yes' : 'No';

        // Invoice
        $invoice = Payment::where('student_id', $student->id)->exists() ? 'Yes' : 'No';

        // ID Card (example: admission approved)
        $idcard = StudentAdmission::where('student_id', $student->id)
            ->where('admission_status', 'approved')
            ->exists() ? 'Yes' : 'No';

        return view('dashboard.student', compact(
            'registration',
            'admission',
            'payment',
            'invoice',
            'idcard'
        ));
    }

    public function liststudent()
    {
        $student = auth('student')->user();

        $students = Student::where('id', $student->id)->get();

        return view('studentstu.list', compact('students'));
    }

    public function editstudent($id)
    {
        $student = Student::findOrFail($id);
        return view('studentstu.edit', compact('student'));
    }

    public function viewstudent()
    {
        $student = Student::where('deleted', 0)
            ->where('id', Auth::guard('student')->id())
            ->first();

        $defaultpassword = Defaultpassword::latest('id')->value('defaultpassword');

        $notFound = false;

        if (!$student) {
            $notFound = true;
        }

        return view('studentstu.view', compact('student', 'defaultpassword', 'notFound'));
    }

    public function viewidcard()
    {
        $admission = null;

        $admission = StudentAdmission::where('student_id', Auth::guard('student')->id())
            ->latest()
            ->first();

        $idcard = Payment::where('student_id', Auth::guard('student')->id())
            ->where('viewid', 1)
            ->latest()
            ->first();

        $notFound = false;

        if (!$idcard) {
            $notFound = true;
        }

        return view('idcardstu.idcard', compact('idcard', 'notFound', 'admission'));
    }

    public function editpayment($id)
    {
        $payment = Payment::findOrFail($id);
        return view('paymentstu.edit', compact('payment'));
    }

    public function viewpayment()
    {
        $payments = Payment::where('student_id', Auth::guard('student')->id())->latest()->get();

        $payment = $payments->first();

        $notFound = $payments->isEmpty();

        return view('paymentstu.view', compact('payment', 'payments', 'notFound'));
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
        return view('coursestu.list');
    }

    public function addstudent()
    {
        return view('studentstu.add');
    }

    public function admin()
    {
        return view('dashboard.admin');
    }

    public function registerstusubmit(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:students,username',
            'email' => 'required|email|max:150|unique:students,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $student = Student::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        StudentAdmission::create([
            'student_id' => $student->id,
            'full_name' => $data['name'],
            'email' => $data['email'],
            'dob' => null,
            'gender' => null,
            'phone' => null,
            'address_line1' => null,
            'city' => null,
            'state' => null,
            'pincode' => null,
            'last_qualification' => null,
            'board_university' => null,
            'passing_year' => null,
            'course_name' => null,
            'admission_session' => null,
        ]);

        return redirect()->route('admin.addstudent')
            ->with('success', 'Student registration successful.');
    }


    public function updatestusubmit(Request $request, $id): RedirectResponse
    {
        $student = Student::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:students,username,' . $student->id,
            'email' => 'required|email|max:150|unique:students,email,' . $student->id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        $student->update([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'] ?? $student->password,
        ]);

        return redirect()->route('admin.liststudent')
            ->with('success', 'Student updated successfully.');
    }
}
