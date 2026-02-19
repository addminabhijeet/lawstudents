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
        $categories = Category::whereHas('courses.notes')
            ->with([
                'courses' => function ($query) {
                    $query->whereHas('notes')
                        ->with(['notes']);
                },
                'children' => function ($query) {
                    $query->whereHas('courses.notes')
                        ->with([
                            'courses' => function ($q) {
                                $q->whereHas('notes')
                                    ->with(['notes']);
                            }
                        ]);
                }
            ])
            ->get();

        return view('notes.list', compact('categories'));
    }

    public function store(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'pdf'   => 'required|mimes:pdf|max:20480', // 20MB
            'description' => 'nullable|string',
            'is_downloadable' => 'nullable|boolean',
            'visibility' => 'nullable|in:free,paid,enrolled',
            'version' => 'nullable|string|max:20',
        ]);

        $course = Course::findOrFail($courseId);

        $file = $request->file('pdf');
        $path = $file->store('course_notes', 'public');

        // Optional: Count PDF pages using Smalot\PdfParser
        $pageCount = null;
        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($file->getPathname());
            $pageCount = $pdf->getPages() ? count($pdf->getPages()) : null;
        } catch (\Exception $e) {
            $pageCount = null; // fallback if PDF parsing fails
        }

        CourseNote::create([
            'course_id'      => $course->id,
            'title'          => $request->title,
            'file_path'      => $path,
            'file_size'      => $file->getSize(),
            'page_count'     => $pageCount,
            'is_downloadable' => $request->has('is_downloadable') ? $request->is_downloadable : true,
            'status'         => true,
            'download_count' => 0,
            'version'        => $request->version ?? '1.0',
            'visibility'     => $request->visibility ?? 'enrolled',
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
