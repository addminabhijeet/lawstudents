<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\StudentPasswordController;

Route::middleware(['student.auth'])->group(function () {

    Route::middleware(['auth:student'])
        ->prefix('student')
        ->name('student.')
        ->group(function () {

            Route::get('/', [RoutingController::class, 'student'])
                ->name('dashboard');

        });

    // password reset routes
    Route::controller(StudentPasswordController::class)->group(function () {

        Route::get('student-forgot', 'showForgotForm')
            ->name('student.forgot');

        Route::post('student-send-otp', 'sendOtp')
            ->name('student.send-otp');

        Route::get('student-verify-otp', 'showVerifyOtpForm')
            ->name('student.verify-otp');

        Route::post('student-verify-otp', 'verifyOtp')
            ->name('student.verify-otp.submit');

        Route::get('student-reset-password/{student}', 'showResetForm')
            ->name('student.reset-password');

        Route::post('student-reset-password-submit/{student}', 'resetPassword')
            ->name('student.reset-password.submit');
    });

    Route::get('/legacy-student', [RoutingController::class, 'student'])
        ->name('student');

});
