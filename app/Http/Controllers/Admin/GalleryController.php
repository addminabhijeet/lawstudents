<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

/**
 * Extracted from CourseController. Handles gallery image management.
 */
class GalleryController extends Controller
{
    public function listgallery()
    {
        $gallery = Gallery::latest()->get()->groupBy('group_name');
        $groups = Gallery::select('group_name')->distinct()->pluck('group_name');
        return view('course.gallery', compact('gallery', 'groups'));
    }

    public function storegallery(Request $request)
    {
        $request->validate([
            'image' => ['required'],
            'image.*' => ['image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'group_name' => ['nullable', 'string'],
            'new_group' => ['nullable', 'string'],
        ]);

        $group = $request->new_group ?: $request->group_name;

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path = $file->store('gallery', 'public');
                Gallery::create([
                    'image' => $path,
                    'description' => $request->description,
                    'group_name' => $group,
                    'status' => 1,
                    'order' => 0,
                ]);
            }
        }

        return back()->with('success', 'Gallery images uploaded successfully.');
    }

    public function editgallery($id)
    {
        $gallery = Gallery::latest()->get()->groupBy('group_name');
        $groups = Gallery::select('group_name')->distinct()->pluck('group_name');
        $editItem = Gallery::findOrFail($id);
        return view('course.gallery', compact('gallery', 'editItem', 'groups'));
    }

    public function updategallery(Request $request, $id)
    {
        $item = Gallery::findOrFail($id);

        $request->validate([
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'group_name' => ['nullable', 'string'],
            'new_group' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $item->image = $path;
        }

        $group = $request->new_group ?: $request->group_name;
        $item->group_name = $group;
        $item->description = $request->description;
        $item->save();

        return redirect()->back()->with('success', 'Gallery updated successfully.');
    }

    public function deletegallery($id)
    {
        $item = Gallery::findOrFail($id);
        $item->update(['delete' => 0]);
        return back()->with('success', 'Gallery item deleted successfully.');
    }
}
