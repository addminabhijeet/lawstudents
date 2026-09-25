<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentAdmission;
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
        // Creating admissions (and their student accounts) is an admin action.
        abort(403);
    }

    public function viewadmission()
    {
        $admission = StudentAdmission::where('deleted', 0)
            ->where('student_id', Auth::guard('student')->id())
            ->first();

        $notFound = false;

        if (!$admission) {
            $notFound = true;
            $selectedCourses = collect(); // empty collection if no admission
        } else {
            // ✅ Prepare selected courses without changing existing logic
            $selectedCourses = $admission->courses;
        }

        return view('admissionstu.view', compact('admission', 'notFound', 'selectedCourses'));
    }
    
    public function edit($id)
    {
        $admission = $this->ownAdmission($id);
        return view('admissionstu.edit', compact('admission'));
    }

    public function updateadmsubmit(Request $request, $id)
    {
        $admission = $this->ownAdmission($id);

        // admission_status is deliberately not accepted here: approval is an
        // admin decision (it creates the fee invoice and unlocks the ID card).
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
        ]);

        $admission->update($data);

        return redirect()->back()->with('success', 'Admission updated successfully.');
    }

    public function destroy($id)
    {
        $admission = $this->ownAdmission($id);
        $admission->delete();

        return redirect()->back()->with('success', 'Admission deleted successfully.');
    }

    private function ownAdmission($id): StudentAdmission
    {
        return StudentAdmission::where('student_id', Auth::guard('student')->id())
            ->findOrFail($id);
    }
}
