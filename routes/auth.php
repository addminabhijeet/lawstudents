<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentPasswordController;

// shared auth pages
Route::controller(RoutingController::class)->group(function () {

    Route::get('login', 'login')->name('login');
    Route::get('register', 'register')->name('register');
    Route::get('verify', 'verify')->name('verify');

});

// login actions
Route::controller(LoginController::class)->group(function () {

    Route::post('loginsubmit', 'loginsubmit')->name('login.submit');

    Route::post('registersubmit', 'registersubmit')
        ->name('admin.registersubmit');

    Route::post('registerstusubmit', 'registerstusubmit')
        ->name('student.registersubmit');

});


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

// logout
Route::post('logout', [LoginController::class, 'logout'])
    ->middleware('auth:admin,student')
    ->name('logout');
