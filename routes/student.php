<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\CourseNoteControllerStu;
use App\Http\Controllers\Student\RoutingControllerStu;
use App\Http\Controllers\Auth\StudentPasswordController;
use App\Http\Controllers\Student\CourseControllerStu;
use App\Http\Controllers\Student\StudentAdmissinControllerStu;


Route::middleware(['auth:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/', [RoutingControllerStu::class, 'student'])
            ->name('dashboard');

        Route::get('add-student', [RoutingControllerStu::class, 'addstudent'])
            ->name('addstudent');

        Route::get('edit-student/{id}', [RoutingControllerStu::class, 'editstudent'])
            ->name('editstudent');

        Route::get('view-student', [RoutingControllerStu::class, 'viewstudent'])
            ->name('viewstudent');

        Route::get('list-student', [RoutingControllerStu::class, 'liststudent'])
            ->name('liststudent');

        Route::get('add-admission', [RoutingControllerStu::class, 'addadmission'])
            ->name('addadmission');

        Route::get('list-admission', [StudentAdmissinControllerStu::class, 'index'])
            ->name('listadmission');

        Route::get('view-admission', [StudentAdmissinControllerStu::class, 'viewadmission'])
            ->name('viewadmission');

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

        Route::get('view-payment', [RoutingControllerStu::class, 'viewpayment'])
            ->name('viewpayment');

        Route::get('courses', [CourseControllerStu::class, 'listcourse'])
            ->name('listcourse');

        Route::get('view-courses', [CourseControllerStu::class, 'viewcourse'])
            ->name('viewcourse');

        Route::get('view-idcard', [RoutingControllerStu::class, 'viewidcard'])
            ->name('viewidcard');

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
