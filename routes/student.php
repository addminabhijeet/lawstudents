<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\StudentPasswordController;

Route::middleware(['student.auth', 'auth:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/', [RoutingController::class, 'student'])
            ->name('dashboard');
    });

Route::get('/legacy-student', [RoutingController::class, 'student'])
    ->name('student');
