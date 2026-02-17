<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use Illuminate\Support\Str;
use App\Models\Student;

class StudentAdmissinController extends Controller
{

    public function index()
    {
        $admissions = StudentAdmission::latest()->get();
        return view('admission.list', compact('admissions'));
    }

    public function create()
    {
        return view('admin.admissions.create');
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
        ]);

        $student = Student::create([
            'name'     => $data['full_name'],
            'username' => Str::slug($data['full_name']) . rand(100, 999),
            'email' => $data['email'],
            'password' => '123456',
        ]);

        $data['student_id'] = $student->id;

        StudentAdmission::create($data);

        return redirect()->back()->with('success', 'Admission created successfully.');
    }


    public function show($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        return view('admin.admissions.show', compact('admission'));
    }

    public function edit($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        return view('admission.edit', compact('admission'));
    }

    public function updateadmsubmit(Request $request, $id)
    {
        $admission = StudentAdmission::findOrFail($id);

        $data = $request->validate([
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
        ]);

        $admission->update($data);

        return redirect()->back()->with('success', 'Admission updated successfully.');
    }

    public function destroy($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        $admission->delete();

        return redirect()->back()->with('success', 'Admission deleted successfully.');
    }
}
