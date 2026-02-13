<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\StudentAdmissinController;

Route::middleware(['admin.auth'])->group(function () {

    Route::middleware(['auth:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/', [RoutingController::class, 'admin'])
                ->name('dashboard');

            Route::get('add-student', [RoutingController::class, 'addstudent'])
                ->name('addstudent');

            Route::get('list-student', [RoutingController::class, 'liststudent'])
                ->name('liststudent');

            Route::get('add-admission', [RoutingController::class, 'addadmission'])
                ->name('addadmission');

            Route::get('list-admission', [StudentAdmissinController::class, 'index'])
                ->name('listadmission');

            Route::get('add-payment', [RoutingController::class, 'addpayment'])
                ->name('addpayment');

            Route::get('view-payment', [RoutingController::class, 'viewpayment'])
                ->name('viewpayment');

            Route::get('list-payment', [RoutingController::class, 'listpayment'])
                ->name('listpayment');

            Route::get('list-notes', [RoutingController::class, 'listnotes'])
                ->name('listnotes');

            Route::get('list-subject', [RoutingController::class, 'listsubject'])
                ->name('listsubject');

            Route::get('list-course', [RoutingController::class, 'listcourse'])
                ->name('listcourse');

            Route::post('register-student', [RoutingController::class, 'registerstusubmit'])
                ->name('registerstusubmit');
        });

    Route::get('/legacy-admin', [RoutingController::class, 'admin'])
        ->name('admin');
});
