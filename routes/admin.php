<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;

Route::middleware(['auth:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [RoutingController::class, 'admin'])
            ->name('dashboard');

        Route::get('addstudent', [RoutingController::class, 'addstudent'])
            ->name('addstudent');

        Route::get('admissioncreate', [RoutingController::class, 'admissioncreate'])
            ->name('admissioncreate');

        Route::get('liststudent', [RoutingController::class, 'liststudent'])
            ->name('liststudent');

    });
Route::get('/legacy-admin', [RoutingController::class, 'admin'])
    ->name('admin');
