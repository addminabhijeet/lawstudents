<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAdmission;

class StudentAdmissinController extends Controller
{
    /**
     * Display all admissions (READ)
     */
    public function index()
    {
        $admissions = StudentAdmission::latest()->get();
        return view('admission.list', compact('admissions'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.admissions.create');
    }

    /**
     * Store new admission (CREATE)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'full_name' => 'required|string|max:150',
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

        StudentAdmission::create($data);

        return redirect()->back()->with('success', 'Admission created successfully.');
    }

    /**
     * Show single admission (READ ONE)
     */
    public function show($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        return view('admin.admissions.show', compact('admission'));
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        return view('admin.admissions.edit', compact('admission'));
    }

    /**
     * Update admission (UPDATE)
     */
    public function update(Request $request, $id)
    {
        $admission = StudentAdmission::findOrFail($id);

        $data = $request->validate([
            'full_name' => 'required|string|max:150',
            'dob' => 'required|date',
            'gender' => 'required',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'course_name' => 'required|string|max:150',
            'admission_session' => 'required|string|max:20',
        ]);

        $admission->update($data);

        return redirect()->back()->with('success', 'Admission updated successfully.');
    }

    /**
     * Delete admission (DELETE)
     */
    public function destroy($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        $admission->delete();

        return redirect()->back()->with('success', 'Admission deleted successfully.');
    }
}
