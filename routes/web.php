<?php

use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentPasswordController;

//Website
Route::get('/', [RoutingController::class, 'root'])->name('root');
Route::get('login', [RoutingController::class, 'login'])->name('login');
Route::get('verify', [RoutingController::class, 'verify'])->name('verify');
Route::get('register', [RoutingController::class, 'register'])->name('register');
Route::post('/student/send-otp', [StudentPasswordController::class, 'sendOtp'])->middleware('throttle:3,1');
Route::get('/student/forgot-password', [StudentPasswordController::class, 'showForgotForm'])->name('student.forgot');
Route::post('/student/send-otp', [StudentPasswordController::class, 'sendOtp'])->name('student.send-otp');
Route::get('/student/verify-otp', [StudentPasswordController::class, 'showVerifyOtpForm'])->name('student.verify-otp');
Route::post('/student/verify-otp', [StudentPasswordController::class, 'verifyOtp'])->name('student.verify-otp.submit');
Route::get('/student/reset-password/{student}', [StudentPasswordController::class, 'showResetForm'])->name('student.reset-password');
Route::post('/student/reset-password/{student}', [StudentPasswordController::class, 'resetPassword'])->name('student.reset-password.submit');

//admin
Route::middleware('auth:admin')->group(function () {

    Route::get('log', [RoutingController::class, 'log'])->name('log');
    Route::get('admin', [RoutingController::class, 'admin'])->name('admin');
});

Route::middleware('guest:admin')->group(function () {

    Route::get('login', [RoutingController::class, 'login'])->name('login');
    Route::post('loginsubmit', [LoginController::class, 'loginsubmit'])->name('login.submit');
    Route::post('registersubmit', [LoginController::class, 'registersubmit'])->name('admin.registersubmit');
});

//student
Route::middleware(['web', 'auth:student'])->prefix('student')->group(function () {
    Route::get('student', [RoutingController::class, 'student'])->name('student.dashboard');
    Route::get('registerstu', [RoutingController::class, 'registerstu'])->name('registerstu');
    Route::get('addstudent', [RoutingController::class, 'addstudent'])->name('addstudent');
    Route::post('registerstusubmit', [LoginController::class, 'registerstusubmit'])->name('admin.registerstusubmit');
    Route::get('liststudent', [RoutingController::class, 'liststudent'])->name('liststudent');
    Route::get('student', [RoutingController::class, 'student'])->name('student');
    Route::get('admissioncreate', [RoutingController::class, 'admissioncreate'])->name('admin.admissioncreate');
    Route::post('studentregister', [LoginController::class, 'studentregister'])->name('student.register');
});

Route::get('/{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])
    ->where('first', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('third');

Route::get('/{first}/{second}', [RoutingController::class, 'secondLevel'])
    ->where('first', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('second');

Route::get('/{any}', [RoutingController::class, 'firstLevel'])
    ->where('any', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('any');
