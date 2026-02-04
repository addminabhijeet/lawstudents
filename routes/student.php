<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XSS','subdomain']], function () {

    Route::group(['middleware' => ['StudentMiddleware']], function () {

        Route::get('student-dashboard',
            [App\Http\Controllers\Student\SmStudentPanelController::class,'studentDashboard']
        )->name('student-dashboard');

        Route::post('student-logout',
            [App\Http\Controllers\Auth\LoginController::class,'logout']
        )->name('student-logout');

    });
});
