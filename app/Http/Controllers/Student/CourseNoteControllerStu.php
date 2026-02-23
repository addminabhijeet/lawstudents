<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Payment;
use App\Models\CourseNote;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;

class CourseNoteControllerStu extends Controller
{

    public function listnotes()
    {

        $student = Auth::guard('student')->user();

        // Get paid course IDs
        $paidCourseIds = Payment::where('student_id', $student->id)
            ->where('payment_status', 'paid')
            ->pluck('course_id')
            ->toArray();

        $categories = Category::whereHas('courses.notes', function ($query) use ($paidCourseIds) {
            $query->where(function ($q) use ($paidCourseIds) {
                $q->where('is_free', 1)
                    ->orWhereIn('id', $paidCourseIds);
            });
        })
            ->with([
                'courses' => function ($query) use ($paidCourseIds) {
                    $query->whereHas('notes')
                        ->where(function ($q) use ($paidCourseIds) {
                            $q->where('is_free', 1)
                                ->orWhereIn('id', $paidCourseIds);
                        })
                        ->with('notes');
                },
                'children' => function ($query) use ($paidCourseIds) {
                    $query->whereHas('courses.notes', function ($q) use ($paidCourseIds) {
                        $q->where(function ($qq) use ($paidCourseIds) {
                            $qq->where('is_free', 1)
                                ->orWhereIn('id', $paidCourseIds);
                        });
                    })
                        ->with([
                            'courses' => function ($q) use ($paidCourseIds) {
                                $q->whereHas('notes')
                                    ->where(function ($qq) use ($paidCourseIds) {
                                        $qq->where('is_free', 1)
                                            ->orWhereIn('id', $paidCourseIds);
                                    })
                                    ->with('notes');
                            }
                        ]);
                }
            ])
            ->get();

        $courses = Course::where('status', 1)
            ->where(function ($q) use ($paidCourseIds) {
                $q->where('is_free', 1)
                    ->orWhereIn('id', $paidCourseIds);
            })
            ->get();

        return view('notesstu.list', compact('categories', 'courses'));
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
            'is_downloadable' => $request->has('is_downloadable'),
            'status'          => true,
            'download_count'  => 0,
            'version'         => $request->version ?? '1.0',
            'visibility'      => $request->visibility ?? 'enrolled',
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
