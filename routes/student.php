<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware(['web', 'auth:student'])->prefix('student')->group(function () {
    Route::get('student', [RoutingController::class, 'student'])->name('student.dashboard');
    Route::get('registerstu', [RoutingController::class, 'registerstu'])->name('registerstu');
    Route::get('addstudent', [RoutingController::class, 'addstudent'])->name('addstudent');
    Route::post('registerstusubmit', [LoginController::class, 'registerstusubmit'])->name('admin.registerstusubmit');
    Route::get('admin', [RoutingController::class, 'admin'])->name('admin');
    Route::get('liststudent', [RoutingController::class, 'liststudent'])->name('liststudent');
    Route::get('student', [RoutingController::class, 'student'])->name('student');
    Route::get('admissioncreate', [RoutingController::class, 'admissioncreate'])->name('admin.admissioncreate');
    Route::post('studentregister', [LoginController::class, 'studentregister'])->name('student.register');
});
