<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\RoutingController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest Admin (Login/Register)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [RoutingController::class, 'firstLevel'])->name('login');
        Route::post('login', [AdminLoginController::class, 'store'])->name('login.submit');
        Route::post('register', [AdminLoginController::class, 'store'])->name('register.submit');
    });

    // Authenticated Admin
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [RoutingController::class, 'firstLevel'])->name('dashboard');
        Route::get('logs', [RoutingController::class, 'firstLevel'])->name('logs');
    });
});
