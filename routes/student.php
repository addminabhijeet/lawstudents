<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingControllerStu;
use App\Http\Controllers\StudentPasswordController;

Route::middleware(['student.auth', 'auth:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/', [RoutingControllerStu::class, 'student'])
            ->name('dashboard');

        Route::get('list-student-subject', [RoutingControllerStu::class, 'listsubject'])
            ->name('listsubject');

        Route::get('list-student-course', [RoutingControllerStu::class, 'listcourse'])
            ->name('listcourse');

        Route::get('add-student-student', [RoutingControllerStu::class, 'addstudent'])
            ->name('addstudent');

        Route::get('list-student-student', [RoutingControllerStu::class, 'liststudent'])
            ->name('liststudent');

        Route::get('add-student-admission', [RoutingControllerStu::class, 'addadmission'])
            ->name('addadmission');

        Route::get('list-student-admission', [RoutingControllerStu::class, 'listadmission'])
            ->name('listadmission');

        Route::get('add-student-payment', [RoutingControllerStu::class, 'addpayment'])
            ->name('addpayment');

        Route::get('view-student-payment', [RoutingControllerStu::class, 'viewpayment'])
            ->name('viewpayment');

        Route::get('list-student-payment', [RoutingControllerStu::class, 'listpayment'])
            ->name('listpayment');

        Route::get('list-student-notes', [RoutingControllerStu::class, 'listnotes'])
            ->name('listnotes');

        Route::get('list-student-subject', [RoutingControllerStu::class, 'listsubject'])
            ->name('listsubject');

        Route::get('list-student-course', [RoutingControllerStu::class, 'listcourse'])
            ->name('listcourse');
    });

Route::get('/legacy-student', [RoutingControllerStu::class, 'student'])
    ->name('student');
