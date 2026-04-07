<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseNote;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;

class CourseNoteController extends Controller
{

    public function listnotes()
    {
        $categories = Category::where('delete', 1) // category not deleted
            ->whereHas('courses.notes', function ($q) {
                $q->where('delete', 1); // notes not deleted
            })
            ->with([
                'courses' => function ($query) {
                    $query->where('delete', 1) // course not deleted
                        ->whereHas('notes', function ($q) {
                            $q->where('delete', 1);
                        })
                        ->with(['notes' => function ($q) {
                            $q->where('delete', 1);
                        }]);
                },
                'children' => function ($query) {
                    $query->where('delete', 1) // child category not deleted
                        ->whereHas('courses.notes', function ($q) {
                            $q->where('delete', 1);
                        })
                        ->with([
                            'courses' => function ($q) {
                                $q->where('delete', 1)
                                    ->whereHas('notes', function ($q2) {
                                        $q2->where('delete', 1);
                                    })
                                    ->with(['notes' => function ($q2) {
                                        $q2->where('delete', 1);
                                    }]);
                            }
                        ]);
                }
            ])
            ->get();

        $courses = Course::where('status', 1)
            ->where('delete', 1) // added delete check
            ->get();

        return view('notes.list', compact('categories', 'courses'));
    }

    public function listfreenotes()
    {
        $categories = Category::whereHas('courses.notes')
            ->with([
                'courses' => function ($query) {
                    $query->whereHas('notes')
                        ->with('notes');
                },
                'children' => function ($query) {
                    $query->whereHas('courses.notes')
                        ->with([
                            'courses' => function ($q) {
                                $q->whereHas('notes')
                                    ->with('notes');
                            }
                        ]);
                }
            ])
            ->get();

        $courses = Course::where('status', 1)->get();

        return view('notes.listfree', compact('categories', 'courses'));
    }


    public function storenotes(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required|string|max:255',
            'pdf'       => 'required|mimes:pdf|max:20480',
        ]);

        $course = Course::findOrFail($request->course_id);

        $file = $request->file('pdf');
        $path = $file->store('course_notes', 'public');

        CourseNote::create([
            'course_id'       => $course->id,
            'title'           => $request->title,
            'file_path'       => $path,
            'file_size'       => $file->getSize(),
            'page_count'      => null,
            'status'          => true,
            'download_count'  => 0,
        ]);

        return back()->with('success', 'PDF Note uploaded successfully.');
    }

    public function updatenotes(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required|string|max:255',
            'pdf'       => 'nullable|mimes:pdf|max:20480',
        ]);

        $note = CourseNote::findOrFail($id);

        $note->course_id       = $request->course_id;
        $note->title           = $request->title;

        // If new PDF uploaded
        if ($request->hasFile('pdf')) {

            // Delete old file
            if ($note->file_path && Storage::disk('public')->exists($note->file_path)) {
                Storage::disk('public')->delete($note->file_path);
            }

            $file = $request->file('pdf');
            $path = $file->store('course_notes', 'public');

            $note->file_path  = $path;
            $note->file_size  = $file->getSize();
        }

        $note->save();

        return back()->with('success', 'Note updated successfully.');
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


    public function viewNote($id)
    {
        $note = CourseNote::findOrFail($id);

        if (!Storage::disk('public')->exists($note->file_path)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($note->file_path);

        return response()->file($path);
    }


    public function deletenotes($id)
    {
        $note = CourseNote::findOrFail($id);

        // Instead of delete(), update flag
        $note->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Note deleted successfully.');
    }
}
