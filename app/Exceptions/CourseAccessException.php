<?php

namespace App\Exceptions;

use Exception;

class CourseAccessException extends Exception
{
    public const UNAUTHORIZED_ACCESS = 'unauthorized_access';
    public const COURSE_NOT_FOUND = 'course_not_found';
    public const NOT_ENROLLED = 'not_enrolled';
    public const PAYMENT_REQUIRED = 'payment_required';
    public const ACCESS_EXPIRED = 'access_expired';
    public const COURSE_ARCHIVED = 'course_archived';

    protected $code = 'access_error';

    public function __construct(string $message = '', string $type = self::UNAUTHORIZED_ACCESS, int $status = 403)
    {
        parent::__construct($message ?: $this->getDefaultMessage($type), $status);
        $this->code = $type;
    }

    private function getDefaultMessage(string $type): string
    {
        return match($type) {
            self::UNAUTHORIZED_ACCESS => 'You do not have permission to access this course.',
            self::COURSE_NOT_FOUND => 'The requested course could not be found.',
            self::NOT_ENROLLED => 'You are not enrolled in this course. Please enroll first.',
            self::PAYMENT_REQUIRED => 'Payment is required to access this course.',
            self::ACCESS_EXPIRED => 'Your course access has expired.',
            self::COURSE_ARCHIVED => 'This course is no longer available.',
            default => 'Access denied.',
        };
    }

    public function render()
    {
        $statusCode = $this->code === self::COURSE_NOT_FOUND ? 404 : 403;

        return response()->json([
            'success' => false,
            'message' => $this->message,
            'error' => $this->code,
        ], $statusCode);
    }
}
