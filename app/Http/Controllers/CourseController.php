<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseNote;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

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

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        $notes = CourseNote::where('visibility', 'free')
            ->where('status', 1)
            ->where('title', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($note) {
                return [
                    'title' => $note->title,
                    'type' => 'Note',
                ];
            });

        $courses = Course::where('is_free', 1)
            ->where('title', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($course) {
                return [
                    'title' => $course->title,
                    'type' => 'Course',
                ];
            });

        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($category) {
                return [
                    'title' => $category->name,
                    'type' => 'Category',
                ];
            });

        return response()->json(
            $notes->merge($courses)->merge($categories)
        );
    }

    public function listcourse()
    {
        $categories = Category::with('courses')
            ->get();

        return view('course.list', compact('categories'));
    }

    public function listbanner()
    {
        $banner = Banner::first();

        return view('course.banner', compact('banner'));
    }

    public function storebanner(Request $request)
    {
        $request->validate([
            'image_1' => ['nullable', 'image', 'max:2048'],
            'image_2' => ['nullable', 'image', 'max:2048'],
            'image_3' => ['nullable', 'image', 'max:2048'],
        ]);

        $banner = Banner::first();

        if (!$banner) {
            return back()->with('error', 'No banner found to update.');
        }

        if ($request->hasFile('image_1')) {
            $banner->image_1 = $request->file('image_1')->store('banners', 'public');
        }

        if ($request->hasFile('image_2')) {
            $banner->image_2 = $request->file('image_2')->store('banners', 'public');
        }

        if ($request->hasFile('image_3')) {
            $banner->image_3 = $request->file('image_3')->store('banners', 'public');
        }

        $banner->save();

        return back()->with('success', 'Banner updated successfully.');
    }

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
