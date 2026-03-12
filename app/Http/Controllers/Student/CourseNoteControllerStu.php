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
        $studentId = $student->id;

        // Get paid course IDs
        $paidCourseIds = Payment::where('student_id', $studentId)
            ->where('payment_status', 'paid')
            ->pluck('course_id')
            ->toArray();

        // Get categories with courses and notes that are wishlisted by this student
        $categories = Category::whereHas('courses.notes', function ($query) use ($paidCourseIds, $studentId) {
            $query->whereHas('wishlists', function ($q) use ($studentId) {
                $q->where('student_id', $studentId);
            });
        })
            ->with([
                'courses' => function ($query) use ($paidCourseIds, $studentId) {
                    $query->whereHas('notes.wishlists', function ($q) use ($studentId) {
                        $q->where('student_id', $studentId);
                    })
                        ->with(['notes' => function ($q) use ($studentId) {
                            $q->whereHas('wishlists', function ($qq) use ($studentId) {
                                $qq->where('student_id', $studentId);
                            });
                        }]);
                },
                'children' => function ($query) use ($studentId) {
                    $query->whereHas('courses.notes.wishlists', function ($q) use ($studentId) {
                        $q->where('student_id', $studentId);
                    })
                        ->with([
                            'courses' => function ($q) use ($studentId) {
                                $q->whereHas('notes.wishlists', function ($qq) use ($studentId) {
                                    $qq->where('student_id', $studentId);
                                })
                                    ->with(['notes' => function ($qq) use ($studentId) {
                                        $qq->whereHas('wishlists', function ($qqq) use ($studentId) {
                                            $qqq->where('student_id', $studentId);
                                        });
                                    }]);
                            }
                        ]);
                }
            ])
            ->get();

        // Get only wishlisted notes directly (optional, if you need a flat list)
        $notes = CourseNote::whereHas('wishlists', function ($q) use ($studentId) {
            $q->where('student_id', $studentId);
        })->get();

        return view('notesstu.list', compact('categories', 'notes'));
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
