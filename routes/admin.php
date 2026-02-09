<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;

Route::middleware(['web', 'auth:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [RoutingController::class, 'admin'])
            ->name('admin.dashboard');
        Route::get('/admission', [RoutingController::class, 'admission'])
            ->name('admin.admission');
        Route::get('/admissioncreate', [RoutingController::class, 'admissioncreate'])
            ->name('admin.admissioncreate');
    });
