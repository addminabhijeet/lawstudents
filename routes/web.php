<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\FreeNotesController;
use App\Http\Controllers\Frontend\RuleController;
use App\Http\Controllers\Frontend\ActController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\ClienteleController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::middleware(['web'])
    ->as('frontend.')
    ->group(function () {
        Route::get('', HomeController::class)->name('home');
        Route::get('about-us', AboutController::class)->name('about');
        Route::get('rules', RuleController::class)->name('rules');
        Route::get('acts', ActController::class)->name('acts');
        Route::get('copys', FreeNotesController::class)->name('copys');
        Route::get('view-note/{id}', [FreeNotesController::class, 'viewnote'])->name('viewnote');
        Route::get('view-notes/{id}', [FreeNotesController::class, 'viewnotes'])->name('viewnotes');
        Route::get('clientele', ClienteleController::class)->name('clientele');
        Route::get('course', CourseController::class)->name('course');
        Route::get('gallery', GalleryController::class)->name('gallery');
        Route::get('contact-us', ContactController::class)->name('contact');
        Route::get('viewnote-watermark/{id}/{index?}', [FreeNotesController::class, 'viewnoteWatermarked'])->name('viewnoteWatermarked');
        Route::get('rules-search-notes', [RuleController::class, 'rulessearch'])->name('rulessearch');
        Route::get('acts-search-notes', [ActController::class, 'actssearch'])->name('actssearch');
        Route::get('copys-search-notes', [FreeNotesController::class, 'copyssearch'])->name('copyssearch');
        Route::get('course-search-notes', [FreeNotesController::class, 'coursesearch'])->name('coursesearch');
        Route::post('contact-store', [ContactController::class, 'contactstore'])->name('contactstore');
    });

Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('auth/google/callback', function () {

    try {
        $googleUser = Socialite::driver('google')->user();
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Google login failed.');
    }

    $user = User::updateOrCreate(
        ['email' => $googleUser->getEmail()],
        ['name' => $googleUser->getName()]
    );

    Auth::login($user);

    return redirect()->intended('/');
});
