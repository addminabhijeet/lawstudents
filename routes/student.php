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

        Route::get('list-student-subject', [RoutingControllerStu::class, 'listsubjectstu'])
            ->name('listsubjectstu');

        Route::get('list-student-course', [RoutingControllerStu::class, 'listcoursestu'])
            ->name('listcoursestu');

        Route::get('add-student-student', [RoutingControllerStu::class, 'addstudentstu'])
            ->name('addstudentstu');

        Route::get('list-student-student', [RoutingControllerStu::class, 'liststudentstu'])
            ->name('liststudentstu');

        Route::get('add-student-admission', [RoutingControllerStu::class, 'addadmissionstu'])
            ->name('addadmissionstu');

        Route::get('list-student-admission', [RoutingControllerStu::class, 'listadmissionstu'])
            ->name('listadmissionstu');

        Route::get('add-student-payment', [RoutingControllerStu::class, 'addpaymentstu'])
            ->name('addpaymentstu');

        Route::get('view-student-payment', [RoutingControllerStu::class, 'viewpaymentstu'])
            ->name('viewpaymentstu');

        Route::get('list-student-payment', [RoutingControllerStu::class, 'listpaymentstu'])
            ->name('listpaymentstu');

        Route::get('list-student-notes', [RoutingControllerStu::class, 'listnotesstu'])
            ->name('listnotesstu');

        Route::get('list-student-subject', [RoutingControllerStu::class, 'listsubjectstu'])
            ->name('listsubjectstu');

        Route::get('list-student-course', [RoutingControllerStu::class, 'listcoursestu'])
            ->name('listcoursestu');
    });

Route::get('/legacy-student', [RoutingControllerStu::class, 'student'])
    ->name('student');
