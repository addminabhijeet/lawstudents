<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Student::class;
    }

    /**
     * Get active students
     */
    public function getActive(int $perPage = 15)
    {
        return $this->model
            ->where('deleted', false)
            ->paginate($perPage);
    }

    /**
     * Find by email
     */
    public function findByEmail(string $email): ?Student
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Find by username
     */
    public function findByUsername(string $username): ?Student
    {
        return $this->model->where('username', $username)->first();
    }

    /**
     * Search students
     */
    public function search(string $query, int $perPage = 15)
    {
        return $this->model
            ->where('deleted', false)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%")
                  ->orWhere('username', 'like', "%{$query}%");
            })
            ->paginate($perPage);
    }

    /**
     * Get students with course enrollment
     */
    public function getWithEnrollments(int $perPage = 15)
    {
        return $this->model
            ->where('deleted', false)
            ->with(['payments'])
            ->withCount('payments')
            ->paginate($perPage);
    }

    /**
     * Get new students (registered in last N days)
     */
    public function getNewStudents(int $days = 7, int $limit = 10)
    {
        return $this->model
            ->where('deleted', false)
            ->where('created_at', '>=', now()->subDays($days))
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Deactivate student
     */
    public function deactivate(int $id): bool
    {
        return $this->update($id, ['deleted' => true]);
    }

    /**
     * Activate student
     */
    public function activate(int $id): bool
    {
        return $this->update($id, ['deleted' => false]);
    }
}
