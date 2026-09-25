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
        $studentId = Auth::guard('student')->id();

        // Get paid course IDs
        $paidCourseIds = Payment::where('student_id', $studentId)
            ->where('payment_status', 'paid')
            ->pluck('course_id')
            ->toArray();

        // Fetch categories with courses but only notes that are wishlisted by the student
        $categories = Category::whereHas('courses.notes', function ($query) use ($studentId, $paidCourseIds) {
            $query->whereHas('wishlists', function ($q) use ($studentId) {
                $q->where('student_id', $studentId);
            });
        })
            ->with([
                'courses' => function ($query) use ($studentId, $paidCourseIds) {
                    $query->whereHas('notes.wishlists', function ($q) use ($studentId) {
                        $q->where('student_id', $studentId);
                    })->with(['notes' => function ($q) use ($studentId) {
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
                                })->with(['notes' => function ($qq) use ($studentId) {
                                    $qq->whereHas('wishlists', function ($qqq) use ($studentId) {
                                        $qqq->where('student_id', $studentId);
                                    });
                                }]);
                            }
                        ]);
                }
            ])
            ->get();

        // Fetch courses for listing, only wishlisted notes
        $courses = Course::where('status', 1)
            ->whereHas('notes.wishlists', function ($q) use ($studentId) {
                $q->where('student_id', $studentId);
            })
            ->with(['notes' => function ($q) use ($studentId) {
                $q->whereHas('wishlists', function ($qq) use ($studentId) {
                    $qq->where('student_id', $studentId);
                });
            }])
            ->get();

        return view('notesstu.list', compact('categories', 'courses'));
    }

    public function storenotes(Request $request)
    {
        // Uploading course notes is an admin action (admin.storenotes).
        abort(403);
    }
}
