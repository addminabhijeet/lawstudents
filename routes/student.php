<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;

Route::middleware(['web','auth:student'])
    ->prefix('student')
    ->group(function () {

        Route::get('student', [RoutingController::class,'student'])
            ->name('student.dashboard');

});
