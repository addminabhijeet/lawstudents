<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Course::class;
    }

    /**
     * Get published courses
     */
    public function getPublished(int $perPage = 15)
    {
        return $this->model
            ->where('is_published', true)
            ->where('is_archived', false)
            ->paginate($perPage);
    }

    /**
     * Get featured courses
     */
    public function getFeatured(int $limit = 6)
    {
        return $this->model
            ->where('is_published', true)
            ->where('is_featured', true)
            ->where('is_archived', false)
            ->limit($limit)
            ->get();
    }

    /**
     * Search courses
     */
    public function search(string $query, int $perPage = 15)
    {
        return $this->model
            ->where('is_published', true)
            ->where('is_archived', false)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate($perPage);
    }

    /**
     * Get courses by category
     */
    public function getByCategory(int $categoryId, int $perPage = 15)
    {
        return $this->model
            ->where('category_id', $categoryId)
            ->where('is_published', true)
            ->where('is_archived', false)
            ->paginate($perPage);
    }

    /**
     * Get courses with enrollment count
     */
    public function getWithStats(int $perPage = 15)
    {
        return $this->model
            ->where('is_published', true)
            ->where('is_archived', false)
            ->withCount('payments')
            ->paginate($perPage);
    }
}
