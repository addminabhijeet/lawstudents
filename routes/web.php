<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Landing Route
|--------------------------------------------------------------------------
*/

if (config('app.app_sync')) {
    Route::get('/', [App\Http\Controllers\LandingController::class,'index'])->name('/');
}

/*
|--------------------------------------------------------------------------
| SaaS Tenant Routing
|--------------------------------------------------------------------------
*/

if (function_exists('moduleStatusCheck') && moduleStatusCheck('Saas')) {

    Route::group([
        'middleware' => ['subdomain'],
        'domain' => '{subdomain}.' . config('app.short_url')
    ], function () {
        require base_path('routes/tenant.php');
    });

    Route::group([
        'middleware' => ['subdomain'],
        'domain' => '{subdomain}'
    ], function () {
        require base_path('routes/tenant.php');
    });
}

/*
|--------------------------------------------------------------------------
| Default Tenant Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['subdomain']], function () {
    require base_path('routes/tenant.php');
});

/*
|--------------------------------------------------------------------------
| Migration Route
|--------------------------------------------------------------------------
*/

Route::get('migrate', function () {

    if (Auth::check() && Auth::id() == 1) {

        Artisan::call('migrate', ['--force' => true]);

        return redirect('/admin-dashboard');
    }

    abort(404);
});

/*
|--------------------------------------------------------------------------
| Upload Route
|--------------------------------------------------------------------------
*/

Route::post('editor/upload-file',
    [App\Http\Controllers\UploadFileController::class,'upload_image']
);
