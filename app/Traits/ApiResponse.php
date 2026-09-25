<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Send success response
     */
    public function successResponse($data = null, string $message = 'Success', int $statusCode = 200, array $meta = null): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];

        if ($meta) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Send error response
     */
    public function errorResponse(string $message, string $error = 'error', int $statusCode = 400, array $details = null): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'error' => $error,
        ];

        if ($details) {
            $response['details'] = $details;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Send paginated response
     */
    public function paginatedResponse($data, $paginator, string $message = 'Success'): JsonResponse
    {
        return $this->successResponse(
            data: $data,
            message: $message,
            meta: [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
                'has_more' => $paginator->hasMorePages(),
            ]
        );
    }

    /**
     * Send created response
     */
    public function createdResponse($data = null, string $message = 'Created successfully'): JsonResponse
    {
        return $this->successResponse($data, $message, 201);
    }

    /**
     * Send not found response
     */
    public function notFoundResponse(string $message = 'Resource not found'): JsonResponse
    {
        return $this->errorResponse($message, 'not_found', 404);
    }

    /**
     * Send unauthorized response
     */
    public function unauthorizedResponse(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->errorResponse($message, 'unauthorized', 401);
    }

    /**
     * Send forbidden response
     */
    public function forbiddenResponse(string $message = 'Access denied'): JsonResponse
    {
        return $this->errorResponse($message, 'forbidden', 403);
    }

    /**
     * Send validation error response
     */
    public function validationErrorResponse(array $errors, string $message = 'Validation failed'): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'error' => 'validation_error',
            'details' => $errors,
        ];

        return response()->json($response, 422);
    }
}
