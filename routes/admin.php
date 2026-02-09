<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;

Route::middleware(['web','auth:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [RoutingController::class,'admin'])
            ->name('admin.dashboard');

});
