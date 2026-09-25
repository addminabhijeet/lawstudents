<?php

namespace App\Services;

use App\Exceptions\CourseAccessException;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Log;

class CourseAccessService
{
    /**
     * Check if student can access course
     */
    public function canAccessCourse(Student $student, Course $course): bool
    {
        // Check if course exists and is not archived
        if (!$course || $course->is_archived) {
            throw new CourseAccessException(
                'This course is not available',
                CourseAccessException::COURSE_ARCHIVED,
                404
            );
        }

        // Check if student is enrolled
        if (!$this->isEnrolled($student, $course)) {
            throw new CourseAccessException(
                'You are not enrolled in this course',
                CourseAccessException::NOT_ENROLLED,
                403
            );
        }

        // Check if access has expired
        if ($this->isAccessExpired($student, $course)) {
            throw new CourseAccessException(
                'Your access to this course has expired',
                CourseAccessException::ACCESS_EXPIRED,
                403
            );
        }

        return true;
    }

    /**
     * Check if student is enrolled in course
     */
    public function isEnrolled(Student $student, Course $course): bool
    {
        // Check if payment is completed
        $payment = $student->payments()
            ->where('course_id', $course->id)
            ->where('status', 'completed')
            ->first();

        if ($payment) {
            return true;
        }

        // Check if free preview is available
        if ($course->is_free) {
            return true;
        }

        // Check if user has free preview access (within preview period)
        if ($this->hasFreePreviewAccess($student, $course)) {
            return true;
        }

        return false;
    }

    /**
     * Check if student has free preview access
     */
    public function hasFreePreviewAccess(Student $student, Course $course): bool
    {
        if (!config('course.enrollment.allow_free_preview')) {
            return false;
        }

        // Check if within free preview duration
        $previewDays = config('course.enrollment.free_preview_duration_days');
        if ($student->created_at->diffInDays(now()) > $previewDays) {
            return false;
        }

        return true;
    }

    /**
     * Check if course access has expired
     */
    public function isAccessExpired(Student $student, Course $course): bool
    {
        $payment = $student->payments()
            ->where('course_id', $course->id)
            ->where('status', 'completed')
            ->first();

        if (!$payment || !$payment->access_expires_at) {
            return false; // Lifetime access
        }

        return $payment->access_expires_at->isPast();
    }

    /**
     * Get student's enrollment details for course
     */
    public function getEnrollmentDetails(Student $student, Course $course): array
    {
        $payment = $student->payments()
            ->where('course_id', $course->id)
            ->where('status', 'completed')
            ->first();

        if (!$payment) {
            return [
                'enrolled' => false,
                'type' => $this->hasFreePreviewAccess($student, $course) ? 'preview' : null,
            ];
        }

        return [
            'enrolled' => true,
            'type' => 'paid',
            'enrolled_at' => $payment->verified_at,
            'expires_at' => $payment->access_expires_at,
            'days_remaining' => $payment->access_expires_at ? $payment->access_expires_at->diffInDays(now()) : null,
        ];
    }

    /**
     * Get courses student can access
     */
    public function getAccessibleCourses(Student $student): \Illuminate\Database\Eloquent\Collection
    {
        return Course::where(function ($query) use ($student) {
            // Paid courses the student has enrolled in
            $query->whereHas('payments', function ($paymentQuery) use ($student) {
                $paymentQuery->where('student_id', $student->id)
                    ->where('status', 'completed');
            });
        })
        ->orWhere(function ($query) {
            // Free courses
            $query->where('is_free', true);
        })
        ->orWhere(function ($query) use ($student) {
            // Courses in free preview period
            if (config('course.enrollment.allow_free_preview') &&
                $student->created_at->diffInDays(now()) <= config('course.enrollment.free_preview_duration_days')) {
                $query->where('is_free', false);
            }
        })
        ->where('is_archived', false)
        ->get();
    }

    /**
     * Log course access
     */
    public function logAccess(Student $student, Course $course): void
    {
        Log::info('Course accessed', [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'ip' => request()->ip(),
            'timestamp' => now(),
        ]);
    }
}
