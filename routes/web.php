<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\FreeNotesController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\ContactController;

Route::middleware(['web'])
    ->as('frontend.')
    ->group(function () {

        Route::get('/', HomeController::class)->name('home');

        Route::prefix('pages')->group(function () {
            Route::get('/about-us', AboutController::class)->name('about');
            Route::get('/free-notes', FreeNotesController::class)->name('free.notes');
            Route::get('/gallery', GalleryController::class)->name('gallery');
            Route::get('/contact-us', ContactController::class)->name('contact');
        });
    });
