<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\StudentPasswordController;

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest:admin')->group(function () {

    Route::get('login',[RoutingController::class,'login'])->name('login');
    Route::post('loginsubmit',[LoginController::class,'loginsubmit'])->name('login.submit');

});

Route::middleware('auth:admin')->group(function () {

    Route::get('log',[RoutingController::class,'log'])->name('log');

});

/*
|--------------------------------------------------------------------------
| STUDENT OTP PASSWORD RESET
|--------------------------------------------------------------------------
*/

Route::get('/student/forgot-password',[StudentPasswordController::class,'showForgotForm'])->name('student.forgot');

Route::post('/student/send-otp',[StudentPasswordController::class,'sendOtp'])
->middleware('throttle:3,1')
->name('student.send-otp');

Route::get('/student/verify-otp',[StudentPasswordController::class,'showVerifyOtpForm'])->name('student.verify-otp');

Route::post('/student/verify-otp',[StudentPasswordController::class,'verifyOtp'])->name('student.verify-otp.submit');

Route::get('/student/reset-password/{student}',[StudentPasswordController::class,'showResetForm'])->name('student.reset-password');

Route::post('/student/reset-password/{student}',[StudentPasswordController::class,'resetPassword'])->name('student.reset-password.submit');
