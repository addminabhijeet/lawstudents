<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\StudentPasswordController;

// Landing Pages
Route::get('/', [RoutingController::class, 'firstLevel'])->name('root');
Route::get('/{first}', [RoutingController::class, 'firstLevel'])->name('saas.first');
Route::get('/{first}/{second}', [RoutingController::class, 'secondLevel'])->name('saas.second');
Route::get('/{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('saas.third');

// Student Auth & Password Reset
Route::prefix('student')->group(function () {
    Route::get('login', [RoutingController::class, 'firstLevel'])->name('student.login');
    Route::get('register', [RoutingController::class, 'firstLevel'])->name('student.register');
    Route::get('verify', [RoutingController::class, 'firstLevel'])->name('student.verify');

    Route::get('forgot-password', [StudentPasswordController::class, 'showForgotForm'])->name('student.forgot');
    Route::post('send-otp', [StudentPasswordController::class, 'sendOtp'])->middleware('throttle:3,1')->name('student.send-otp');
    Route::get('verify-otp', [StudentPasswordController::class, 'showVerifyOtpForm'])->name('student.verify-otp');
    Route::post('verify-otp', [StudentPasswordController::class, 'verifyOtp'])->name('student.verify-otp.submit');
    Route::get('reset-password/{student}', [StudentPasswordController::class, 'showResetForm'])->name('student.reset-password');
    Route::post('reset-password/{student}', [StudentPasswordController::class, 'resetPassword'])->name('student.reset-password.submit');
});
