<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XSS','subdomain','fees_due_check']], function () {

    Route::group(['middleware' => ['ParentMiddleware']], function () {

        Route::get('parent-dashboard',
            [App\Http\Controllers\Parent\SmParentPanelController::class,'ParentDashboard']
        )->name('parent-dashboard');

        Route::get('my-children/{id}',
            [App\Http\Controllers\Parent\SmParentPanelController::class,'myChildren']
        )->name('my_children');

    });
});
