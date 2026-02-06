<?php

use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RoutingController::class, 'root'])->name('root');
Route::get('/log', [RoutingController::class, 'log'])->name('log');

Route::get('/{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->where('first', '^(?!build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')->name('third');
Route::get('/{first}/{second}', [RoutingController::class, 'secondLevel'])->where('first', '^(?!build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')->name('second');
Route::get('/{any}', [RoutingController::class, 'firstLevel'])->where('any', '^(?!build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')->name('any');

Route::get('/login', [RoutingController::class, 'login'])->name('login');


