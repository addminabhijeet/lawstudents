<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __invoke(): View
    {
        return view('gallery.gallery');
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
}
