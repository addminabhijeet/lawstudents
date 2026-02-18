<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseNote;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseNoteController extends Controller
{
    public function listnotes()
    {
        $categories = Category::with([
            'children.courses.notes',
            'courses.notes'
        ])
            ->whereNull('parent_id')
            ->get();

        return view('admin.course_notes.list', compact('categories'));
    }

    public function store(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'pdf'   => 'required|mimes:pdf|max:20480', // 20MB
        ]);

        $course = Course::findOrFail($courseId);

        $file = $request->file('pdf');

        $path = $file->store('course_notes', 'public');

        CourseNote::create([
            'course_id'      => $course->id,
            'title'          => $request->title,
            'file_path'      => $path,
            'file_size'      => $file->getSize(),
            'is_downloadable' => true,
            'status'         => true,
        ]);

        return back()->with('success', 'PDF Note uploaded successfully.');
    }

    public function download($id)
    {
        $note = CourseNote::where('status', 1)->findOrFail($id);

        if (!$note->is_downloadable) {
            abort(403, 'Download not allowed.');
        }

        // Increase download count
        $note->increment('download_count');

        $filePath = storage_path('app/public/' . $note->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $note->title . '.pdf');
    }


    public function destroy($id)
    {
        $note = CourseNote::findOrFail($id);

        Storage::disk('public')->delete($note->file_path);

        $note->delete();

        return back()->with('success', 'Note deleted successfully.');
    }
}
