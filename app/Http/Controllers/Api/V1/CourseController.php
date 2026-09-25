<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\CourseRepository;
use App\Exceptions\InvalidSearchException;
use Illuminate\Http\Request;

class CourseController extends BaseApiController
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Get all published courses with pagination
     */
    public function index(Request $request)
    {
        try {
            $perPage = (int) $request->get('per_page', 15);
            $courses = $this->courseRepository->getPublished($perPage);

            return $this->paginatedResponse(
                data: $courses->items(),
                paginator: $courses,
                message: 'Courses retrieved successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch courses', 'fetch_error', 500);
        }
    }

    /**
     * Get single course
     */
    public function show(int $id)
    {
        try {
            $course = $this->courseRepository->find($id);

            if (!$course) {
                return $this->notFoundResponse('Course not found');
            }

            return $this->successResponse(
                data: $course,
                message: 'Course retrieved successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch course', 'fetch_error', 500);
        }
    }

    /**
     * Search courses
     */
    public function search(Request $request)
    {
        try {
            $query = $request->get('q', '');

            if (strlen($query) < 3) {
                throw new InvalidSearchException(
                    'Search query must be at least 3 characters',
                    InvalidSearchException::QUERY_TOO_SHORT
                );
            }

            if (strlen($query) > 255) {
                throw new InvalidSearchException(
                    'Search query is too long',
                    InvalidSearchException::QUERY_TOO_LONG
                );
            }

            $perPage = (int) $request->get('per_page', 15);
            $courses = $this->courseRepository->search($query, $perPage);

            return $this->paginatedResponse(
                data: $courses->items(),
                paginator: $courses,
                message: 'Search results'
            );
        } catch (InvalidSearchException $e) {
            return $this->errorResponse($e->getMessage(), $e->code, 422);
        } catch (\Exception $e) {
            return $this->errorResponse('Search failed', 'search_error', 500);
        }
    }

    /**
     * Get featured courses
     */
    public function featured()
    {
        try {
            $courses = $this->courseRepository->getFeatured(6);

            return $this->successResponse(
                data: $courses,
                message: 'Featured courses retrieved successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch featured courses', 'fetch_error', 500);
        }
    }

    /**
     * Get courses by category
     */
    public function byCategory(int $categoryId, Request $request)
    {
        try {
            $perPage = (int) $request->get('per_page', 15);
            $courses = $this->courseRepository->getByCategory($categoryId, $perPage);

            return $this->paginatedResponse(
                data: $courses->items(),
                paginator: $courses,
                message: 'Courses retrieved successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch courses', 'fetch_error', 500);
        }
    }
}
