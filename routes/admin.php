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

            Route::get('addstudent', [RoutingController::class, 'addstudent'])
                ->name('addstudent');

            Route::get('liststudent', [RoutingController::class, 'liststudent'])
                ->name('liststudent');

            Route::get('addadmission', [RoutingController::class, 'addadmission'])
                ->name('addadmission');

            Route::get('listadmission', [RoutingController::class, 'listadmission'])
                ->name('listadmission');

        });

    Route::get('/legacy-admin', [RoutingController::class, 'admin'])
        ->name('admin');

});
