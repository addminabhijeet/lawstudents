<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseNoteControllerStu;
use App\Http\Controllers\RoutingControllerStu;
use App\Http\Controllers\StudentPasswordController;
use App\Http\Controllers\CourseControllerStu;
use App\Http\Controllers\StudentAdmissinControllerStu;


Route::middleware(['student.auth', 'auth:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/', [RoutingControllerStu::class, 'student'])
            ->name('dashboard');

        Route::get('add-student', [RoutingControllerStu::class, 'addstudent'])
            ->name('addstudent');

        Route::get('edit-student/{id}', [RoutingControllerStu::class, 'editstudent'])
            ->name('editstudent');

        Route::get('show-student/{id}', [RoutingControllerStu::class, 'showstudent'])
            ->name('showstudent');

        Route::get('list-student', [RoutingControllerStu::class, 'liststudent'])
            ->name('liststudent');

        Route::get('add-admission', [RoutingControllerStu::class, 'addadmission'])
            ->name('addadmission');

        Route::get('list-admission', [StudentAdmissinControllerStu::class, 'index'])
            ->name('listadmission');

        Route::get('show-admission', [StudentAdmissinControllerStu::class, 'show'])
            ->name('showadmission');

        Route::get('edit-admission/{id}', [StudentAdmissinControllerStu::class, 'edit'])
            ->name('editadmission');

        Route::get('destroy-admission', [StudentAdmissinControllerStu::class, 'destroy'])
            ->name('destroyadmission');

        Route::get('add-payment', [RoutingControllerStu::class, 'addpayment'])
            ->name('addpayment');

        Route::get('edit-payment/{id}', [RoutingControllerStu::class, 'editpayment'])
            ->name('editpayment');

        Route::get('list-payment', [RoutingControllerStu::class, 'listpayment'])
            ->name('listpayment');

        Route::get('list-subject', [RoutingControllerStu::class, 'listsubject'])
            ->name('listsubject');

        Route::post('register-student', [RoutingControllerStu::class, 'registerstusubmit'])
            ->name('registerstusubmit');

        Route::post('update-student/{id}', [RoutingControllerStu::class, 'updatestusubmit'])
            ->name('updatestusubmit');

        Route::post('register-admission', [StudentAdmissinControllerStu::class, 'registeradmsubmit'])
            ->name('registeradmsubmit');

        Route::post('update-admission/{id}', [StudentAdmissinControllerStu::class, 'updateadmsubmit'])
            ->name('updateadmsubmit');

        Route::post('update-payment/{id}', [RoutingControllerStu::class, 'updatepayment'])
            ->name('updatepayment');

        Route::get('view-payment/{id}', [RoutingControllerStu::class, 'viewpayment'])
            ->name('viewpayment');

        Route::get('courses', [CourseControllerStu::class, 'listcourse'])
            ->name('listcourse');

        Route::post('category-store', [CourseControllerStu::class, 'storecategory'])
            ->name('storecategory');

        Route::post('course-store', [CourseControllerStu::class, 'storecourse'])
            ->name('storecourse');

        Route::get('course-notes', [CourseNoteControllerStu::class, 'listnotes'])
            ->name('listnotes');

        Route::post('store-notes', [CourseNoteControllerStu::class, 'storenotes'])
            ->name('storenotes');
    });

Route::get('/legacy-student', [RoutingControllerStu::class, 'student'])
    ->name('student');
