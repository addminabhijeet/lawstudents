<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Extracted from CourseController. Manages the course curriculum structure:
 * Courses, Categories (hierarchical), and Subcategories.
 */
class CourseManagementController extends Controller
{
    // ========== Courses (Items) ==========

    public function listcourse()
    {
        $categories = Category::with([
            'courses' => function ($query) {
                $query->where('delete', 1);
            },
            'children' => function ($query) {
                $query->where('status', 1)->where('delete', 1);
            }
        ])
            ->where('delete', 1)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        return view('course.list', compact('categories'));
    }

    public function editcourse($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        return response()->json($course);
    }

    public function storecourse(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|unique:courses,title',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'brochure' => 'nullable|mimes:pdf|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'title.unique' => 'This course already exists.'
        ]);

        $brochurePath = null;
        $thumbnailPath = null;

        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('brochures', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Course::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'discount' => $request->discount ?? 0,
            'brochure' => $brochurePath,
            'thumbnail' => $thumbnailPath,
        ]);

        return back()->with('success', 'Course Created Successfully');
    }

    public function updatecourse(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return back()->with('error', 'Course not found');
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'brochure' => 'nullable|mimes:pdf|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle brochure update
        if ($request->hasFile('brochure')) {
            if ($course->brochure && Storage::disk('public')->exists($course->brochure)) {
                Storage::disk('public')->delete($course->brochure);
            }
            $brochurePath = $request->file('brochure')->store('brochures', 'public');
            $course->brochure = $brochurePath;
        }

        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $course->thumbnail = $thumbnailPath;
        }

        $course->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'discount' => $request->discount ?? 0,
            'brochure' => $course->brochure,
            'thumbnail' => $course->thumbnail,
        ]);

        return back()->with('success', 'Course Updated Successfully');
    }

    public function coursedelete(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update(['delete' => 0]);
        return back()->with('success', 'Course Deleted Successfully');
    }

    public function deletecourse($id)
    {
        $course = Course::findOrFail($id);
        $course->update(['delete' => 0]);
        return back()->with('success', 'Course Deleted Successfully');
    }

    // ========== Categories (Hierarchical) ==========

    public function listcoursecategory()
    {
        $allCategories = Category::with([
            'courses' => function ($query) {
                $query->where('delete', 1);
            },
            'children' => function ($query) {
                $query->where('status', 1)->where('delete', 1);
            }
        ])
            ->where('delete', 1)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        $categories = Category::where('delete', 1)->paginate(10);

        return view('course.listcategory', compact('categories', 'allCategories'));
    }

    public function storecategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id'
        ], [
            'name.unique' => 'This category already exists.'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return back()->with('success', 'Category Created Successfully');
    }

    public function editCategory($id)
    {
        return Category::findOrFail($id);
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return back()->with('success', 'Category Updated Successfully');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['delete' => 0]);
        return back()->with('success', 'Category deleted successfully');
    }

    // ========== Subcategories ==========

    public function listcoursesubcategory()
    {
        $categories = Category::with([
            'courses' => function ($query) {
                $query->where('delete', 1);
            },
            'children' => function ($query) {
                $query->where('status', 1)->where('delete', 1);
            }
        ])
            ->where('delete', 1)
            ->orderBy('sort_order')
            ->paginate(10);

        return view('course.listsubcategory', compact('categories'));
    }
}
