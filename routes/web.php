<?php

use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])
    ->where('first', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('third');

Route::get('/{first}/{second}', [RoutingController::class, 'secondLevel'])
    ->where('first', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('second');

Route::get('/{any}', [RoutingController::class, 'firstLevel'])
    ->where('any', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('any');

Route::get('liststudent', [RoutingController::class, 'liststudent'])->name('liststudent');
Route::get('admissioncreate', [RoutingController::class, 'admissioncreate'])->name('admin.admissioncreate');
