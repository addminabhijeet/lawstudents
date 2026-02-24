<?php

use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [RoutingController::class, 'root'])->name('root');

Route::get('/{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])
    ->where('first', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('third');

Route::get('/{first}/{second}', [RoutingController::class, 'secondLevel'])
    ->where('first', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('second');

Route::get('/{any}', [RoutingController::class, 'firstLevel'])
    ->where('any', '^(?!admin|student|build|assets|img|css|js|storage|vendor|favicon\.ico|robots\.txt|\.well-known).*$')
    ->name('any');


// <?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Frontend\HomeController;
// use App\Http\Controllers\Frontend\AboutController;
// use App\Http\Controllers\Frontend\FreeNotesController;
// use App\Http\Controllers\Frontend\GalleryController;
// use App\Http\Controllers\Frontend\ContactController;

// Route::middleware(['web'])
//     ->as('frontend.')
//     ->group(function () {

//         Route::get('/', HomeController::class)->name('home');

//         Route::prefix('pages')->group(function () {
//             Route::get('/about-us', AboutController::class)->name('about');
//             Route::get('/free-notes', FreeNotesController::class)->name('notes');
//             Route::get('/gallery', GalleryController::class)->name('gallery');
//             Route::get('/contact-us', ContactController::class)->name('contact');
//         });
//     });
