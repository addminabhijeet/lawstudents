<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends BaseApiController
{
    protected StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Get authenticated student profile
     */
    public function profile(Request $request)
    {
        try {
            $student = $request->user();

            return $this->successResponse(
                data: $student,
                message: 'Profile retrieved successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch profile', 'fetch_error', 500);
        }
    }

    /**
     * Update student profile
     */
    public function updateProfile(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email:rfc,dns|unique:students,email,' . $request->user()->id,
                'phone' => 'nullable|string|max:20',
            ]);

            $student = $request->user();
            $this->studentRepository->update($student->id, $validated);

            $updated = $this->studentRepository->find($student->id);

            return $this->successResponse(
                data: $updated,
                message: 'Profile updated successfully'
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update profile', 'update_error', 500);
        }
    }

    /**
     * Get student's enrolled courses
     */
    public function enrolledCourses(Request $request)
    {
        try {
            $student = $request->user();
            $perPage = (int) $request->get('per_page', 15);

            $enrollments = $student->payments()
                ->where('status', 'completed')
                ->with('course')
                ->paginate($perPage);

            return $this->paginatedResponse(
                data: $enrollments->items(),
                paginator: $enrollments,
                message: 'Enrolled courses retrieved'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch enrolled courses', 'fetch_error', 500);
        }
    }

    /**
     * Get student statistics/dashboard data
     */
    public function dashboard(Request $request)
    {
        try {
            $student = $request->user();

            $data = [
                'total_courses_enrolled' => $student->payments()
                    ->where('status', 'completed')
                    ->distinct('course_id')
                    ->count(),
                'total_spent' => $student->payments()
                    ->where('status', 'completed')
                    ->sum('total_amount'),
                'recent_purchases' => $student->payments()
                    ->where('status', 'completed')
                    ->with('course')
                    ->latest('verified_at')
                    ->limit(5)
                    ->get(),
                'pending_payments' => $student->payments()
                    ->where('status', 'pending')
                    ->count(),
            ];

            return $this->successResponse(
                data: $data,
                message: 'Dashboard data retrieved'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch dashboard data', 'fetch_error', 500);
        }
    }

    /**
     * Search for students (admin only)
     */
    public function search(Request $request)
    {
        try {
            $query = $request->get('q', '');
            $perPage = (int) $request->get('per_page', 15);

            $students = $this->studentRepository->search($query, $perPage);

            return $this->paginatedResponse(
                data: $students->items(),
                paginator: $students,
                message: 'Search results'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Search failed', 'search_error', 500);
        }
    }
}
