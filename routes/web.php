<?php

use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentPasswordController;

Route::get('/', [RoutingController::class, 'root'])->name('root');
Route::get('log', [RoutingController::class, 'log'])->name('log');
Route::post('loginsubmit', [LoginController::class, 'loginsubmit'])->name('login.submit');
Route::post('registersubmit', [LoginController::class, 'registersubmit'])->name('admin.registersubmit');
Route::get('login', [RoutingController::class, 'login'])->name('login');
Route::get('verify', [RoutingController::class, 'verify'])->name('verify');
Route::get('register', [RoutingController::class, 'register'])->name('register');
Route::get('student', [RoutingController::class, 'student'])->name('student');
Route::get('addstudent', [RoutingController::class, 'addstudent'])->name('addstudent');
Route::get('admin', [RoutingController::class, 'admin'])->name('admin');
Route::get('liststudent', [RoutingController::class, 'liststudent'])->name('liststudent');
Route::get('admissioncreate', [RoutingController::class, 'admissioncreate'])->name('admin.admissioncreate');
Route::post('studentregister', [LoginController::class, 'studentregister'])->name('student.register');


// Show request OTP form
Route::get('/student/forgot-password', [StudentPasswordController::class, 'showForgotForm'])->name('student.forgot');

// Send OTP
Route::post('/student/send-otp', [StudentPasswordController::class, 'sendOtp'])->name('student.send-otp');

// Show OTP verification form
Route::get('/student/verify-otp', [StudentPasswordController::class, 'showVerifyOtpForm'])->name('student.verify-otp');

// Verify OTP
Route::post('/student/verify-otp', [StudentPasswordController::class, 'verifyOtp'])->name('student.verify-otp.submit');

// Show reset password form
Route::get('/student/reset-password/{student}', [StudentPasswordController::class, 'showResetForm'])->name('student.reset-password');

// Update password
Route::post('/student/reset-password/{student}', [StudentPasswordController::class, 'resetPassword'])->name('student.reset-password.submit');

Route::get('/{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])
    ->where('first', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('third');

Route::get('/{first}/{second}', [RoutingController::class, 'secondLevel'])
    ->where('first', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('second');

Route::get('/{any}', [RoutingController::class, 'firstLevel'])
    ->where('any', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('any');



