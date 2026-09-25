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

    public function listpayment()
    {
        $payments = Payment::with('student')
            ->where('student_id', Auth::guard('student')->id())
            ->latest()
            ->get();

        return view('paymentstu.list', compact('payments'));
    }

    public function updatepayment(Request $request, $id)
    {
        // Invoices are managed by admins only (see Admin\RoutingController).
        abort(403);
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
        abort_unless((int) $id === Auth::guard('student')->id(), 403);

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
        $admission = StudentAdmission::where('student_id', Auth::guard('student')->id())
            ->latest()
            ->first();

        $latestPayment = Payment::where('student_id', Auth::guard('student')->id())
            ->latest()
            ->first();

        $idcard = null;
        $notFound = true;

        if ($latestPayment && $latestPayment->viewid) {
            $idcard = $latestPayment;
            $notFound = false;
        }

        return view('idcardstu.idcard', compact('idcard', 'notFound', 'admission'));
    }

    public function editpayment($id)
    {
        // Invoices are managed by admins only (see Admin\RoutingController).
        abort(403);
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
        // Creating student accounts is an admin action (admin.registerstusubmit).
        abort(403);
    }


    public function updatestusubmit(Request $request, $id): RedirectResponse
    {
        abort_unless((int) $id === Auth::guard('student')->id(), 403);

        $student = Student::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:students,username,' . $student->id,
            'email' => 'required|email|max:150|unique:students,email,' . $student->id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        $student->fill([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
        ]);

        // Only touch the password when a new one was given; passing the
        // stored hash back through the mutator would re-hash it.
        if (!empty($data['password'])) {
            $student->password = $data['password'];
        }

        $student->save();

        return redirect()->route('student.viewstudent')
            ->with('success', 'Profile updated successfully.');
    }
}
