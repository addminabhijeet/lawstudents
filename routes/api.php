<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\Api\V1\{
    AuthController,
    CourseController,
    PaymentController,
    StudentController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Legacy endpoint
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API v1 Routes
Route::prefix('v1')->group(function () {

    // Public Auth Routes (no authentication required)
    Route::prefix('auth')->group(function () {
        Route::post('send-email-otp', [AuthController::class, 'sendEmailOtp']);
        Route::post('send-phone-otp', [AuthController::class, 'sendPhoneOtp']);
        Route::post('verify-email-otp', [AuthController::class, 'verifyEmailOtp']);
        Route::post('verify-phone-otp', [AuthController::class, 'verifyPhoneOtp']);
    });

    // Public Course Routes
    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('search', [CourseController::class, 'search']);
        Route::get('featured', [CourseController::class, 'featured']);
        Route::get('category/{categoryId}', [CourseController::class, 'byCategory']);
        Route::get('{id}', [CourseController::class, 'show']);
    });

    // Protected Routes (authentication required)
    Route::middleware('auth:sanctum')->group(function () {

        // Student Routes
        Route::prefix('student')->group(function () {
            Route::get('profile', [StudentController::class, 'profile']);
            Route::put('profile', [StudentController::class, 'updateProfile']);
            Route::get('courses', [StudentController::class, 'enrolledCourses']);
            Route::get('dashboard', [StudentController::class, 'dashboard']);
        });

        // Payment Routes
        Route::prefix('payments')->group(function () {
            Route::post('initiate', [PaymentController::class, 'initiate']);
            Route::post('verify', [PaymentController::class, 'verify']);
            Route::get('history', [PaymentController::class, 'history']);
            Route::post('refund', [PaymentController::class, 'requestRefund']);
        });
    });
});

// Category API Endpoints - Unlimited Nested Categories
Route::prefix('categories')->group(function () {
    // Get all root categories
    Route::get('/', [CategoryApiController::class, 'getRoots']);

    // Get children of a parent category
    Route::get('{categoryId}/children', [CategoryApiController::class, 'getChildren']);

    // Get ancestors (breadcrumb) of a category
    Route::get('{categoryId}/ancestors', [CategoryApiController::class, 'getAncestors']);

    // Get full tree from a parent (or root if null)
    Route::get('{categoryId?}/tree', [CategoryApiController::class, 'getTree']);

    // Search categories by name
    Route::get('search', [CategoryApiController::class, 'search']);

    // Get all courses under a category (including nested)
    Route::get('{categoryId}/courses', [CategoryApiController::class, 'getCourses']);

    // Get single category with metadata
    Route::get('{categoryId}', [CategoryApiController::class, 'getCategory']);

    // Get category statistics
    Route::get('stats/all', [CategoryApiController::class, 'getStats']);
});
