<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class StudentAdmissinControllerStu extends Controller
{

    public function index()
    {
        $student = auth('student')->user();

        $admissions = StudentAdmission::where('student_id', $student->id)
            ->latest()
            ->get();

        return view('admissionstu.list', compact('admissions'));
    }

    public function create()
    {
        return view('admissionstu.create');
    }

    public function registeradmsubmit(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:students,email',
            'dob' => 'required|date',
            'gender' => 'required',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'last_qualification' => 'required|string|max:150',
            'board_university' => 'required|string|max:150',
            'passing_year' => 'required|integer',
            'course_name' => 'required|string|max:150',
            'admission_session' => 'required|string|max:20',
            'admission_status' => 'required|in:pending,approved,rejected',
        ]);

        $student = Student::create([
            'name'     => $data['full_name'],
            'username' => Str::slug($data['full_name']) . rand(100, 999),
            'email'    => $data['email'],
            'password' => '123456',
        ]);

        $data['student_id'] = $student->id;

        $admission = StudentAdmission::create($data);

        if ($admission->admission_status === 'approved') {

            $paymentExists = Payment::where('student_id', $student->id)->exists();

            if (!$paymentExists) {
                Payment::create([
                    'student_id' => $student->id,
                    'invoice_number' => 'INV-' . strtoupper(Str::random(6)),
                    'invoice_label' => 'Admission Fee',
                    'invoice_product' => $admission->course_name,
                    'issue_date' => now(),
                    'due_date' => now()->addDays(7),
                    'to_name' => $admission->full_name,
                    'to_email' => $admission->email,
                    'to_phone' => $admission->phone,
                    'to_address' => $admission->address_line1,
                    'sub_total' => 0,
                    'grand_total' => 0,
                    'currency' => 'INR',
                    'payment_status' => 'pending',
                ]);
            }
        }


        return redirect()->back()->with('success', 'Admission created successfully.');
    }

    public function viewadmission()
    {
        $admission = StudentAdmission::where('deleted', 0)
            ->where('id', Auth::id())->findOrFail();
        return view('admissionsstu.view', compact('admission'));
    }

    public function edit($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        return view('admissionstu.edit', compact('admission'));
    }

    public function updateadmsubmit(Request $request, $id)
    {
        $admission = StudentAdmission::findOrFail($id);

        $oldStatus = $admission->admission_status;

        $data = $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:students,email,' . $admission->student_id,
            'dob' => 'required|date',
            'gender' => 'required',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'last_qualification' => 'required|string|max:150',
            'board_university' => 'required|string|max:150',
            'passing_year' => 'required|integer',
            'course_name' => 'required|string|max:150',
            'admission_session' => 'required|string|max:20',
            'admission_status' => 'required|in:pending,approved,rejected',
        ]);

        $admission->update($data);

        if (
            $oldStatus !== 'approved' &&
            $admission->admission_status === 'approved'
        ) {

            $paymentExists = Payment::where('student_id', $admission->student_id)->exists();

            if (!$paymentExists) {
                Payment::create([
                    'student_id' => $admission->student_id,
                    'invoice_number' => 'INV-' . strtoupper(Str::random(6)),
                    'invoice_label' => 'Admission Fee',
                    'invoice_product' => $admission->course_name,
                    'issue_date' => now(),
                    'due_date' => now()->addDays(7),
                    'to_name' => $admission->full_name,
                    'to_email' => $admission->email,
                    'to_phone' => $admission->phone,
                    'to_address' => $admission->address_line1,
                    'sub_total' => 0,
                    'grand_total' => 0,
                    'currency' => 'INR',
                    'payment_status' => 'pending',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Admission updated successfully.');
    }



    public function destroy($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        $admission->delete();

        return redirect()->back()->with('success', 'Admission deleted successfully.');
    }
}
