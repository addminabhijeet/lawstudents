<?php

namespace App\Repositories;

use App\Models\Payment;
use Carbon\Carbon;

class PaymentRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Payment::class;
    }

    /**
     * Get completed payments
     */
    public function getCompleted(int $perPage = 15)
    {
        return $this->model
            ->where('status', 'completed')
            ->paginate($perPage);
    }

    /**
     * Get pending payments
     */
    public function getPending(int $perPage = 15)
    {
        return $this->model
            ->where('status', 'pending')
            ->paginate($perPage);
    }

    /**
     * Get failed payments
     */
    public function getFailed(int $perPage = 15)
    {
        return $this->model
            ->where('status', 'failed')
            ->paginate($perPage);
    }

    /**
     * Get payments for student
     */
    public function getStudentPayments(int $studentId, int $perPage = 15)
    {
        return $this->model
            ->where('student_id', $studentId)
            ->with('course')
            ->latest('created_at')
            ->paginate($perPage);
    }

    /**
     * Get payments for course
     */
    public function getCoursePayments(int $courseId, int $perPage = 15)
    {
        return $this->model
            ->where('course_id', $courseId)
            ->with('student')
            ->latest('verified_at')
            ->paginate($perPage);
    }

    /**
     * Get total revenue
     */
    public function getTotalRevenue(): float
    {
        return $this->model
            ->where('status', 'completed')
            ->sum('total_amount');
    }

    /**
     * Get revenue for date range
     */
    public function getRevenueForRange(Carbon $startDate, Carbon $endDate): float
    {
        return $this->model
            ->where('status', 'completed')
            ->whereBetween('verified_at', [$startDate, $endDate])
            ->sum('total_amount');
    }

    /**
     * Get revenue by course
     */
    public function getRevenueByUser(int $courseId): float
    {
        return $this->model
            ->where('course_id', $courseId)
            ->where('status', 'completed')
            ->sum('total_amount');
    }

    /**
     * Get payment stats
     */
    public function getStats(): array
    {
        return [
            'total_payments' => $this->model->count(),
            'completed_payments' => $this->model->where('status', 'completed')->count(),
            'pending_payments' => $this->model->where('status', 'pending')->count(),
            'failed_payments' => $this->model->where('status', 'failed')->count(),
            'total_revenue' => $this->getTotalRevenue(),
            'average_payment' => $this->model->where('status', 'completed')->avg('total_amount'),
        ];
    }

    /**
     * Find duplicate payment
     */
    public function findDuplicate(int $studentId, int $courseId)
    {
        return $this->model
            ->where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->whereIn('status', ['pending', 'processing'])
            ->first();
    }
}
