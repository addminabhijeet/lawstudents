<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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
