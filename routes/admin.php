<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;

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

            Route::get('list-admission', [RoutingController::class, 'listadmission'])
                ->name('listadmission');

            Route::get('create-payment', [RoutingController::class, 'createpayment'])
                ->name('createpayment');

            Route::get('view-payment', [RoutingController::class, 'viewpayment'])
                ->name('viewpayment');

            Route::get('list-payment', [RoutingController::class, 'listpayment'])
                ->name('listpayment');
        });

    Route::get('/legacy-admin', [RoutingController::class, 'admin'])
        ->name('admin');
});
