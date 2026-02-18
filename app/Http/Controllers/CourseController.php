<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
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
        $categories = Category::with('courses')
            ->whereNotNull('parent_id')
            ->get();

        return view('course.list', compact('categories'));
    }


    // Store Category
    public function storeCategory(Request $request)
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
    public function storeCourse(Request $request)
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
