<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['subdomain','auth']], function () {

    Route::get('admin-dashboard', function () {
        return "Admin Dashboard";
    });

});
