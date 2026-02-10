<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\Auth\AdminLoginController;

// All routes under /student prefix
Route::prefix('student')->name('student.')->middleware(['auth:student'])->group(function () {

    Route::get('dashboard', [RoutingController::class, 'firstLevel'])->name('dashboard');
    Route::get('register', [RoutingController::class, 'firstLevel'])->name('register');
    Route::get('add', [RoutingController::class, 'firstLevel'])->name('add');
    Route::post('register-submit', [AdminLoginController::class, 'store'])->name('register.submit');
    Route::get('list', [RoutingController::class, 'firstLevel'])->name('list');
    Route::get('admission-create', [RoutingController::class, 'firstLevel'])->name('admission.create');
});
