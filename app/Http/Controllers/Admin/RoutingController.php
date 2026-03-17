<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Course;
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
        $payments = Payment::with('student')->latest()->get();

        return view('payment.list', compact('payments'));
    }

    public function listidcard()
    {
        $payments = Payment::with('student')->latest()->get();

        return view('idcard.list', compact('payments'));
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
        $students = Student::where('deleted', 0)->get();
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
        $defaultpassword = Defaultpassword::latest('id')->value('defaultpassword');
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
        return view('payment.edit', compact('payment'));
    }

    public function viewpayment($id)
    {
        $payment = Payment::findOrFail($id);
        return view('payment.view', compact('payment'));
    }

    public function viewidcard($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        $idcard = Payment::findOrFail($id);
        return view('idcard.idcard', compact('idcard','admission'));
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
        $defaultpassword = Defaultpassword::latest('id')->value('defaultpassword');
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
            'username' => 'required|string|max:100|unique:students,username',
            'email' => 'required|email|max:150|unique:students,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $lastStudent = \App\Models\Student::latest('id')->first();
        if ($lastStudent && preg_match('/STU(\d+)/', $lastStudent->username, $matches)) {
            $data['username'] = 'STU' . str_pad((int)$matches[1] + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $data['username'] = 'STU00001';
        }

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

    public function firstLevel(Request $request, $first)
    {
        if (View::exists($first)) {
            return view($first);
        }

        abort(404);
    }

    /**
     * Second level route
     */
    public function secondLevel(Request $request, $first, $second)
    {
        $view = $first . '.' . $second;

        if (View::exists($view)) {
            return view($view);
        }

        abort(404);
    }

    /**
     * Third level route
     */
    public function thirdLevel(Request $request, $first, $second, $third)
    {
        $view = $first . '.' . $second . '.' . $third;

        if (View::exists($view)) {
            return view($view);
        }

        abort(404);
    }
}
