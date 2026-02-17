<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Student;
use App\Models\Payment;
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

    public function viewpayment()
    {
        return view('payment.view');
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
        return view('admission.add');
    }

    public function student()
    {
        return view('dashboard.student');
    }

    public function liststudent()
    {
        $students = Student::all();
        return view('student.list', compact('students'));
    }

    public function editstudent($id)
    {
        $student = Student::findOrFail($id);
        return view('student.edit', compact('student'));
    }

    public function editpayment($id)
    {
        $payment = Payment::findOrFail($id);
        return view('payment.edit', compact('payment'));
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
        return view('student.add');
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


    /**
     * First level route
     */
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
