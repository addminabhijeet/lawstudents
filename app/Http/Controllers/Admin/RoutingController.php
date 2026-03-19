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
        $payments = StudentAdmission::with('student')->latest()->get();

        return view('idcard.list', compact('payments'));
    }

    public function updatepayment(Request $request, $id)
    {
        if (!$request->has('payments')) {
            return back()->with('error', 'No payments data received');
        }

        foreach ($request->payments as $payData) {

            if (!isset($payData['id'])) continue;

            $payment = Payment::find($payData['id']);
            if (!$payment) continue;

            // ✅ Safe validation
            $validated = validator($payData, [
                'invoice_label'     => 'nullable|string|max:255',
                'invoice_number'    => 'required|string|max:255',
                'invoice_product'   => 'nullable|string|max:255',

                'issue_date'        => 'nullable|date',
                'due_date'          => 'nullable|date',

                'from_name'         => 'nullable|string|max:255',
                'to_name'           => 'nullable|string|max:255',

                'items'             => 'nullable|array',
                'items.*.product'   => 'nullable|string|max:255',
                'items.*.qty'       => 'nullable|numeric|min:1',
                'items.*.price'     => 'nullable|numeric|min:0',

                'tax_percentage'    => 'nullable|numeric|min:0',
                'discount'          => 'nullable|numeric|min:0',

                'currency'          => 'nullable|string|max:10',
                'payment_method'    => 'nullable|string|in:debit,paypal',

                'invoice_note'      => 'nullable|string',
                'paid_amount'       => 'nullable|numeric|min:0',
            ])->validate();

            $subTotal = 0;
            $items = [];

            if (!empty($validated['items'])) {
                foreach ($validated['items'] as $item) {
                    $qty = (float) ($item['qty'] ?? 0);
                    $price = (float) ($item['price'] ?? 0);
                    $total = $qty * $price;

                    $subTotal += $total;

                    $items[] = [
                        'product' => $item['product'] ?? '',
                        'qty'     => $qty,
                        'price'   => $price,
                        'total'   => $total,
                    ];
                }
            }

            $taxPercentage = (float) ($validated['tax_percentage'] ?? 0);
            $taxAmount = ($subTotal * $taxPercentage) / 100;

            $discount = (float) ($validated['discount'] ?? 0);

            $grandTotal = $subTotal + $taxAmount - $discount;

            // ✅ Only update paid_amount if request provides a value
            $paidAmount = array_key_exists('paid_amount', $validated) && $validated['paid_amount'] !== null
                ? (float) $validated['paid_amount']
                : $payment->paid_amount; // keep original if null

            $remainingAmount = $grandTotal - ($paidAmount ?? 0);

            // Payment status based on paid_amount
            $paymentStatus = ($paidAmount ?? 0) >= $grandTotal ? 'paid' : (($paidAmount ?? 0) > 0 ? 'partial' : 'pending');

            // Update existing payment
            $payment->update([
                'invoice_label'       => $validated['invoice_label'] ?? $payment->invoice_label,
                'invoice_number'      => $validated['invoice_number'],
                'invoice_product'     => $validated['invoice_product'] ?? $payment->invoice_product,

                'issue_date'          => $validated['issue_date'] ?? $payment->issue_date,
                'due_date'            => $validated['due_date'] ?? $payment->due_date,

                'from_name'           => $validated['from_name'] ?? $payment->from_name,
                'to_name'             => $validated['to_name'] ?? $payment->to_name,

                'items'               => $items ?: $payment->items,

                'sub_total'           => $subTotal,
                'tax_percentage'      => $taxPercentage,
                'tax_amount'          => $taxAmount,
                'discount'            => $discount,
                'grand_total'         => $grandTotal,

                'currency'            => $validated['currency'] ?? $payment->currency,
                'payment_method'      => $validated['payment_method'] ?? $payment->payment_method,
                'invoice_note'        => $validated['invoice_note'] ?? $payment->invoice_note,

                'paid_amount'         => $paidAmount,
                'remaining_amount'    => $remainingAmount,
                'payment_status'      => $paymentStatus,

                'late_fees'           => isset($payData['late_fees']),
                'client_note_enabled' => isset($payData['client_note_enabled']),
                'save_payment'        => isset($payData['save_payment']),
            ]);

            // ✅ Partial payment: create remaining invoice if needed
            if ($paymentStatus === 'partial' && $remainingAmount > 0) {

                $exists = Payment::where('student_id', $payment->student_id)
                    ->where('invoice_label', $payment->invoice_label . ' (Remaining)')
                    ->exists();

                if (!$exists) {
                    $year = date('Y');

                    $lastInvoice = Payment::where('invoice_number', 'like', 'INV' . $year . '%')
                        ->orderBy('id', 'desc')
                        ->first();

                    $nextNumber = $lastInvoice ? intval(substr($lastInvoice->invoice_number, 7)) + 1 : 1;
                    $nextInvoiceNumber = 'INV' . $year . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

                    Payment::create([
                        'student_id'       => $payment->student_id,
                        'invoice_label'    => $payment->invoice_label . ' (Remaining)',

                        'invoice_number'   => $nextInvoiceNumber,
                        'invoice_product'  => $payment->invoice_product,

                        'issue_date'       => now(),
                        'due_date'         => $payment->due_date ?? now()->addDays(7),

                        'to_name'          => $payment->to_name,
                        'to_email'         => $payment->to_email,
                        'to_phone'         => $payment->to_phone,
                        'to_address'       => $payment->to_address,

                        'sub_total'        => $subTotal,
                        'tax_percentage'   => $taxPercentage,
                        'tax_amount'       => $taxAmount,
                        'discount'         => $discount,
                        'grand_total'      => $grandTotal,

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
