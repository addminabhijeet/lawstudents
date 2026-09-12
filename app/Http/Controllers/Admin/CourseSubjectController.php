<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSubject;
use Illuminate\Http\Request;

// New, additive controller for the "Subject" grouping level added under
// Course Page Structure (Course → Subject → Chapter/PDF Notes). Does not
// touch Admin\CourseController or Admin\CourseNoteController.
class CourseSubjectController extends Controller
{
    public function listsubjects()
    {
        $subjects = CourseSubject::where('delete', 1)
            ->with('course')
            ->latest()
            ->paginate(15);

        return view('course.subjects.list', compact('subjects'));
    }

    public function addsubject()
    {
        $courses = Course::where('delete', 1)->orderBy('title')->get();
        return view('course.subjects.add', compact('courses'));
    }

    public function storesubject(Request $request)
    {
        $request->validate([
            'course_id'  => 'required|exists:courses,id',
            'name'       => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        CourseSubject::create([
            'course_id'  => $request->course_id,
            'name'       => $request->name,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.listsubjects')->with('success', 'Subject created successfully.');
    }

    public function editsubject($id)
    {
        $subject = CourseSubject::findOrFail($id);
        $courses = Course::where('delete', 1)->orderBy('title')->get();

        return view('course.subjects.edit', compact('subject', 'courses'));
    }

    public function updatesubject(Request $request, $id)
    {
        $request->validate([
            'course_id'  => 'required|exists:courses,id',
            'name'       => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $subject = CourseSubject::findOrFail($id);
        $subject->course_id  = $request->course_id;
        $subject->name       = $request->name;
        $subject->sort_order = $request->sort_order ?? 0;
        $subject->save();

        return redirect()->route('admin.listsubjects')->with('success', 'Subject updated successfully.');
    }

    public function deletesubject($id)
    {
        $subject = CourseSubject::findOrFail($id);
        $subject->update(['delete' => 0]);

        return back()->with('success', 'Subject deleted successfully.');
    }
}
