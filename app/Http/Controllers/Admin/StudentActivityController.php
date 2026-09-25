<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\NoteProgress;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentActivity;
use App\Models\StudentAdmission;
use Carbon\Carbon;

/**
 * Extracted from CourseController. Handles admin viewing of student activity and progress.
 */
class StudentActivityController extends Controller
{
    public function liststudentactivity()
    {
        $admissions = StudentAdmission::where('deleted', 0)
            ->latest()
            ->paginate(10);
        return view('student.listactivity', compact('admissions'));
    }

    public function viewstudentactivity($studentId)
    {
        $student = Student::findOrFail($studentId);

        $payments = Payment::where('student_id', $student->id)
            ->where('payment_status', 'paid')
            ->whereMonth('issue_date', Carbon::now()->month)
            ->whereYear('issue_date', Carbon::now()->year)
            ->pluck('course_id');

        $paidCourseIds = [];
        foreach ($payments as $courseIdsString) {
            if ($courseIdsString) {
                $ids = explode(',', $courseIdsString);
                $paidCourseIds = array_merge($paidCourseIds, $ids);
            }
        }

        $paidCourseIds = array_map('intval', $paidCourseIds);
        $paidCourseIds = array_unique($paidCourseIds);

        if (empty($paidCourseIds)) {
            return view('student.viewactivity', [
                'courses' => collect(),
                'progressData' => []
            ]);
        }

        $courses = Course::with([
            'category',
            'notes' => function ($query) {
                $query->where('status', 1);
            }
        ])
            ->whereIn('id', $paidCourseIds)
            ->get();

        if ($courses->isEmpty()) {
            abort(404, 'Courses not found.');
        }

        $progressData = NoteProgress::where('student_id', $student->id)
            ->whereIn('course_id', $paidCourseIds)
            ->selectRaw('course_id, AVG(progress_percent) as progress')
            ->groupBy('course_id')
            ->pluck('progress', 'course_id');

        // Activity log
        foreach ($courses as $course) {
            StudentActivity::create([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'activity_type' => 'view_course'
            ]);
        }

        return view('student.viewactivity', compact('courses', 'progressData'));
    }
}
