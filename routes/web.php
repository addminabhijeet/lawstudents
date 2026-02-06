<?php

use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RoutingController::class, 'root'])->name('root');
Route::get('login', [RoutingController::class, 'login'])->name('login');
Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
Route::get('{any}', [RoutingController::class, 'firstLevel'])->name('any');
