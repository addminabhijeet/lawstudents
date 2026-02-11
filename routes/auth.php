<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\Auth\LoginController;

// shared auth pages
Route::controller(RoutingController::class)->group(function () {

    Route::get('login', 'login')->name('login');
    Route::get('register', 'register')->name('register');
    Route::get('verify', 'verify')->name('verify');

});

// login actions
Route::controller(LoginController::class)->group(function () {

    Route::post('loginsubmit', 'loginsubmit')->name('login.submit');

    Route::post('registersubmit', 'registersubmit')
        ->name('admin.registersubmit');

    Route::post('registerstusubmit', 'registerstusubmit')
        ->name('student.registersubmit');

});

// logout
Route::post('logout', [LoginController::class, 'logout'])
    ->middleware('auth:admin,student')
    ->name('logout');
