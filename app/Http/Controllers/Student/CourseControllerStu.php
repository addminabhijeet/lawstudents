<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CourseControllerStu extends Controller
{
    // Show All Categories with Courses
    // public function listcourse()
    // {
    //     $categories = Category::with([
    //         'children',
    //         'courses' => function ($query) {
    //             $query->where('status', 1)
    //                 ->orderBy('created_at', 'desc');
    //         }
    //     ])
    //         ->whereNull('parent_id')
    //         ->where('status', 1)
    //         ->orderBy('sort_order')
    //         ->get();

    //     return view('course.list', compact('categories'));
    // }

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

    public function viewcourse()
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
