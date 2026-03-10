<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseNote;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Gallery;


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
            ->get();

        return view('course.list', compact('categories'));
    }

    public function listbanner()
    {
        $banner = Banner::first();

        return view('course.banner', compact('banner'));
    }

    public function listgallery()
    {
        $gallery = Gallery::first();

        return view('course.gallery', compact('gallery'));
    }

    public function storegallery(Request $request)
    {
        $request->validate([
            'image_1' => ['nullable', 'image', 'max:2048'],
            'image_2' => ['nullable', 'image', 'max:2048'],
            'image_3' => ['nullable', 'image', 'max:2048'],
        ]);

        $gallery = Gallery::first();

        if (!$gallery) {
            return back()->with('error', 'No gallery found to update.');
        }

        if ($request->hasFile('image_1')) {
            $gallery->image_1 = $request->file('image_1')->store('gallery', 'public');
        }

        if ($request->hasFile('image_2')) {
            $gallery->image_2 = $request->file('image_2')->store('gallery', 'public');
        }

        if ($request->hasFile('image_3')) {
            $gallery->image_3 = $request->file('image_3')->store('gallery', 'public');
        }

        $gallery->save();

        return back()->with('success', 'Gallery updated successfully.');
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

    public function storecourse(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',

            // NEW FIELDS
            'duration' => 'nullable|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'brochure' => 'nullable|mimes:pdf|max:2048'
        ]);

        $brochurePath = null;

        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('brochures', 'public');
        }

        Course::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,

            // NEW FIELDS
            'duration' => $request->duration,
            'discount' => $request->discount ?? 0,
            'brochure' => $brochurePath,
        ]);

        return back()->with('success', 'Course Created Successfully');
    }

    public function coursedelete(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'brochure' => 'nullable|mimes:pdf|max:2048'
        ]);

        $course = Course::findOrFail($id);

        $brochurePath = $course->brochure;

        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('brochures', 'public');
        }

        $course->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'discount' => $request->discount ?? 0,
            'brochure' => $brochurePath,
        ]);

        return back()->with('success', 'Course Updated Successfully');
    }

    // DELETE COURSE
    public function deletecourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return back()->with('success', 'Course Deleted Successfully');
    }
}
