<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Replaces the old web-reachable verify_services.php script.
 */
class ServiceContainerTest extends TestCase
{
    public static function resolvableClasses(): array
    {
        return [
            [\App\Services\AuthenticationService::class],
            [\App\Services\PaymentService::class],
            [\App\Services\CourseAccessService::class],
            [\App\Services\NotificationService::class],
            [\App\Repositories\CourseRepository::class],
            [\App\Repositories\StudentRepository::class],
            [\App\Repositories\PaymentRepository::class],
        ];
    }

    #[DataProvider('resolvableClasses')]
    public function test_class_resolves_from_container(string $class): void
    {
        $this->assertInstanceOf($class, $this->app->make($class));
    }

    public function test_middleware_exception_and_api_classes_exist(): void
    {
        $classes = [
            \App\Http\Middleware\SecurityHeaders::class,
            \App\Http\Middleware\AdminAuditLogging::class,
            \App\Http\Middleware\ApiRateLimiting::class,
            \App\Exceptions\FileUploadException::class,
            \App\Exceptions\PaymentException::class,
            \App\Exceptions\OtpException::class,
            \App\Exceptions\CourseAccessException::class,
            \App\Exceptions\InvalidSearchException::class,
            \App\Http\Controllers\Api\BaseApiController::class,
            \App\Http\Controllers\Api\V1\AuthController::class,
            \App\Http\Controllers\Api\V1\CourseController::class,
            \App\Http\Controllers\Api\V1\PaymentController::class,
            \App\Http\Controllers\Api\V1\StudentController::class,
        ];

        foreach ($classes as $class) {
            $this->assertTrue(class_exists($class), "{$class} is missing");
        }
    }
}
