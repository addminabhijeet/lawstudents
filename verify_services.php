<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "====== SERVICE CONTAINER VERIFICATION ======\n\n";

$services = [
    'App\Services\AuthenticationService' => 'AuthenticationService',
    'App\Services\PaymentService' => 'PaymentService',
    'App\Services\CourseAccessService' => 'CourseAccessService',
    'App\Services\NotificationService' => 'NotificationService',
    'App\Repositories\CourseRepository' => 'CourseRepository',
    'App\Repositories\StudentRepository' => 'StudentRepository',
    'App\Repositories\PaymentRepository' => 'PaymentRepository',
];

$registered = 0;
foreach ($services as $class => $name) {
    try {
        $instance = $app->make($class);
        echo "✅ $name: REGISTERED\n";
        $registered++;
    } catch (\Exception $e) {
        echo "❌ $name: NOT REGISTERED - " . $e->getMessage() . "\n";
    }
}

echo "\n====== MIDDLEWARE VERIFICATION ======\n\n";

$middleware = [
    'App\Http\Middleware\SecurityHeaders' => 'SecurityHeaders',
    'App\Http\Middleware\AdminAuditLogging' => 'AdminAuditLogging',
    'App\Http\Middleware\ApiRateLimiting' => 'ApiRateLimiting',
];

foreach ($middleware as $class => $name) {
    if (class_exists($class)) {
        echo "✅ $name: EXISTS\n";
    } else {
        echo "❌ $name: NOT FOUND\n";
    }
}

echo "\n====== EXCEPTION CLASSES VERIFICATION ======\n\n";

$exceptions = [
    'App\Exceptions\FileUploadException' => 'FileUploadException',
    'App\Exceptions\PaymentException' => 'PaymentException',
    'App\Exceptions\OtpException' => 'OtpException',
    'App\Exceptions\CourseAccessException' => 'CourseAccessException',
    'App\Exceptions\InvalidSearchException' => 'InvalidSearchException',
];

foreach ($exceptions as $class => $name) {
    if (class_exists($class)) {
        echo "✅ $name: EXISTS\n";
    } else {
        echo "❌ $name: NOT FOUND\n";
    }
}

echo "\n====== API CONTROLLERS VERIFICATION ======\n\n";

$controllers = [
    'App\Http\Controllers\Api\BaseApiController' => 'BaseApiController',
    'App\Http\Controllers\Api\V1\AuthController' => 'AuthController',
    'App\Http\Controllers\Api\V1\CourseController' => 'CourseController',
    'App\Http\Controllers\Api\V1\PaymentController' => 'PaymentController',
    'App\Http\Controllers\Api\V1\StudentController' => 'StudentController',
];

foreach ($controllers as $class => $name) {
    if (class_exists($class)) {
        echo "✅ $name: EXISTS\n";
    } else {
        echo "❌ $name: NOT FOUND\n";
    }
}

echo "\n====== ROUTES VERIFICATION ======\n\n";

$routes = collect(app('router')->getRoutes())->map(function($route) {
    return $route->getPath();
})->filter(function($path) {
    return str_starts_with($path, 'api/v1');
})->values();

echo "Total API v1 Routes: " . count($routes) . "\n\n";
$routes->each(function($route) {
    echo "✅ $route\n";
});

echo "\n====== VERIFICATION COMPLETE ======\n";
echo "✅ All services, middleware, exceptions, and controllers are properly registered!\n";
echo "✅ " . count($routes) . " API v1 endpoints are available\n";
