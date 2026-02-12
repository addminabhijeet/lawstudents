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

        Route::get('list-student-subject', [RoutingController::class, 'listsubject'])
            ->name('listsubject');

        Route::get('list-student-course', [RoutingController::class, 'listcourse'])
            ->name('listcourse');

        Route::get('add-student-student', [RoutingController::class, 'addstudent'])
            ->name('addstudent');

        Route::get('list-student-student', [RoutingController::class, 'liststudent'])
            ->name('liststudent');

        Route::get('add-student-admission', [RoutingController::class, 'addadmission'])
            ->name('addadmission');

        Route::get('list-student-admission', [RoutingController::class, 'listadmission'])
            ->name('listadmission');

        Route::get('add-student-payment', [RoutingController::class, 'addpayment'])
            ->name('addpayment');

        Route::get('view-student-payment', [RoutingController::class, 'viewpayment'])
            ->name('viewpayment');

        Route::get('list-student-payment', [RoutingController::class, 'listpayment'])
            ->name('listpayment');

        Route::get('list-student-notes', [RoutingController::class, 'listnotes'])
            ->name('listnotes');

        Route::get('list-student-subject', [RoutingController::class, 'listsubject'])
            ->name('listsubject');

        Route::get('list-student-course', [RoutingController::class, 'listcourse'])
            ->name('listcourse');
    });

Route::get('/legacy-student', [RoutingController::class, 'student'])
    ->name('student');
