<?php

use Illuminate\Support\Facades\Route;

if (function_exists('moduleStatusCheck') && moduleStatusCheck('Saas')) {

    Route::group([
        'middleware' => ['subdomain'],
        'domain' => '{subdomain}.' . config('app.short_url')
    ], function () {

        require base_path('routes/admin_tenant.php');
    });
}

Route::group(['middleware' => ['subdomain']], function () {

    require base_path('routes/admin_tenant.php');
    require base_path('routes/parent.php');
    require base_path('routes/student.php');
});
