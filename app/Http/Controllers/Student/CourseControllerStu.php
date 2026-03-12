<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseNote;
use Illuminate\Support\Facades\Response;

class CourseControllerStu extends Controller
{

    public function listcourse()
    {
        $student = Auth::guard('student')->user();

        // Get paid course IDs of logged in student
        $paidCourseIds = Payment::where('student_id', $student->id)
            ->where('payment_status', 'paid')
            ->pluck('course_id')
            ->toArray();

        // Show only courses student has paid for
        $categories = Category::whereHas('courses', function ($query) use ($paidCourseIds) {
            $query->whereIn('id', $paidCourseIds);
        })
            ->with(['courses' => function ($query) use ($paidCourseIds) {
                $query->whereIn('id', $paidCourseIds);
            }])
            ->get();

        return view('coursestu.list', compact('categories'));
    }

    public function viewcourse($id)
    {
        $student = Auth::guard('student')->user();

        // Check if student purchased this course
        $payment = Payment::where('student_id', $student->id)
            ->where('course_id', $id)
            ->where('payment_status', 'paid')
            ->first();

        if (!$payment) {
            abort(403, 'You have not purchased this course.');
        }

        // Load course with category and notes
        $course = Course::with(['category', 'notes' => function ($query) {
            $query->where('status', 1);
        }])->findOrFail($id);

        return view('coursestu.view', compact('course'));
    }

    public function viewNote($id)
    {
        $student = Auth::guard('student')->user();

        $note = CourseNote::with('course')->findOrFail($id);

        // Check if student purchased the course
        $payment = Payment::where('student_id', $student->id)
            ->where('course_id', $note->course_id)
            ->where('payment_status', 'paid')
            ->first();

        if (!$payment) {
            abort(403, 'You do not have access to this note.');
        }

        $filePath = storage_path('app/public/' . $note->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->file($filePath);
    }


    public function downloadNote($id)
    {
        $student = Auth::guard('student')->user();

        $note = CourseNote::with('course')->findOrFail($id);

        $payment = Payment::where('student_id', $student->id)
            ->where('course_id', $note->course_id)
            ->where('payment_status', 'paid')
            ->first();

        if (!$payment) {
            abort(403, 'You do not have access to this note.');
        }

        if (!$note->is_downloadable) {
            abort(403, 'Download not allowed.');
        }

        $note->increment('download_count');

        $filePath = storage_path('app/public/' . $note->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $note->title . '.pdf');
    }


    // Store Category
    public function storecategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return back()->with('success', 'Category Created Successfully');
    }


    // Store Course
    public function storecourse(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric'
        ]);

        Course::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price
        ]);

        return back()->with('success', 'Course Created Successfully');
    }
}
