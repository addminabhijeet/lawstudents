<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\StudentAdmissinController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\CourseNoteController;

Route::middleware(['admin.auth'])->group(function () {

    Route::middleware(['auth:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/', [RoutingController::class, 'admin'])
                ->name('dashboard');

            Route::get('add-student', [RoutingController::class, 'addstudent'])
                ->name('addstudent');

            Route::get('edit-student/{id}', [RoutingController::class, 'editstudent'])
                ->name('editstudent');

            Route::get('show-student/{id}', [RoutingController::class, 'showstudent'])
                ->name('showstudent');

            Route::get('list-student', [RoutingController::class, 'liststudent'])
                ->name('liststudent');

            Route::get('add-admission', [RoutingController::class, 'addadmission'])
                ->name('addadmission');

            Route::get('list-admission', [StudentAdmissinController::class, 'index'])
                ->name('listadmission');

            Route::get('show-admission', [StudentAdmissinController::class, 'show'])
                ->name('showadmission');

            Route::get('edit-admission/{id}', [StudentAdmissinController::class, 'edit'])
                ->name('editadmission');

            Route::get('destroy-admission', [StudentAdmissinController::class, 'destroy'])
                ->name('destroyadmission');

            Route::get('add-payment', [RoutingController::class, 'addpayment'])
                ->name('addpayment');

            Route::get('edit-payment/{id}', [RoutingController::class, 'editpayment'])
                ->name('editpayment');

            Route::get('list-payment', [RoutingController::class, 'listpayment'])
                ->name('listpayment');

            Route::get('list-subject', [RoutingController::class, 'listsubject'])
                ->name('listsubject');

            Route::post('register-student', [RoutingController::class, 'registerstusubmit'])
                ->name('registerstusubmit');

            Route::post('update-student/{id}', [RoutingController::class, 'updatestusubmit'])
                ->name('updatestusubmit');

            Route::post('register-admission', [StudentAdmissinController::class, 'registeradmsubmit'])
                ->name('registeradmsubmit');

            Route::post('update-admission/{id}', [StudentAdmissinController::class, 'updateadmsubmit'])
                ->name('updateadmsubmit');

            Route::post('update-payment/{id}', [RoutingController::class, 'updatepayment'])
                ->name('updatepayment');

            Route::get('view-payment/{id}', [RoutingController::class, 'viewpayment'])
                ->name('viewpayment');

            Route::get('courses', [CourseController::class, 'listcourse'])
                ->name('listcourse');

            Route::post('category-store', [CourseController::class, 'storecategory'])
                ->name('storecategory');

            Route::post('course-store', [CourseController::class, 'storecourse'])
                ->name('storecourse');

            Route::get('course-notes', [CourseNoteController::class, 'listnotes'])
                ->name('listnotes');

            Route::put('course-notes/{id}', [CourseNoteController::class, 'updatenotes'])
                ->name('updatenotes');

            Route::post('store-notes', [CourseNoteController::class, 'storenotes'])
                ->name('storenotes');
        });

    Route::get('/legacy-admin', [RoutingController::class, 'admin'])
        ->name('admin');
});
