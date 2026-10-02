<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\FreeNotesController;
use App\Http\Controllers\Frontend\RuleController;
use App\Http\Controllers\Frontend\GovtExamController;
use App\Http\Controllers\Frontend\ActController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\ClienteleController;
use App\Http\Controllers\Frontend\LegalKnowledgeController;
use App\Http\Controllers\Frontend\LegalKnowledgeLibraryController;
use App\Http\Controllers\Frontend\SitePageController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::post('_activity/events', [\App\Http\Controllers\ActivityEventController::class, 'store'])
    ->middleware('throttle:120,1')->name('activity.events');
Route::get('admission-enquiry', [\App\Http\Controllers\Frontend\AdmissionEnquiryController::class, 'create'])->name('frontend.enquiry');
Route::post('admission-enquiry', [\App\Http\Controllers\Frontend\AdmissionEnquiryController::class, 'store'])
    ->middleware('throttle:5,10')->name('frontend.enquiry.store');

Route::middleware(['web'])
    ->as('frontend.')
    ->group(function () {
        Route::get('', HomeController::class)->name('home');
        Route::get('about-us', AboutController::class)->name('about');
        Route::get('rules', RuleController::class)->name('rules');
        Route::get('acts', ActController::class)->name('acts');
        Route::get('copys', FreeNotesController::class)->name('copys');
        Route::get('study-pdf/{type}/{id}/{index?}/file', [\App\Http\Controllers\PdfDocumentController::class, 'file'])
            ->whereNumber(['id', 'index'])->name('study-pdf.file');
        Route::get('study-pdf/{type}/{id}/{index?}', [\App\Http\Controllers\PdfDocumentController::class, 'viewer'])
            ->whereNumber(['id', 'index'])->name('study-pdf');
        Route::get('view-note/{id}', [FreeNotesController::class, 'viewnote'])->name('viewnote');
        Route::get('view-notes/{id}', [FreeNotesController::class, 'viewnotes'])->name('viewnotes');
        Route::get('clientele', ClienteleController::class)->name('clientele');
        Route::get('course', CourseController::class)->name('course');
        Route::get('gallery', GalleryController::class)->name('gallery');
        Route::get('contact-us', ContactController::class)->name('contact');
        Route::get('legal-knowledge', [LegalKnowledgeController::class, 'index'])->name('legal-knowledge');
        Route::post('legal-knowledge-store', [LegalKnowledgeController::class, 'store'])->name('legal-knowledge-store');
        Route::get('viewnote-watermark/{id}/{index?}', [FreeNotesController::class, 'viewnoteWatermarked'])->name('viewnoteWatermarked');
        Route::get('rules-search-notes', [RuleController::class, 'rulessearch'])->name('rulessearch');
        Route::get('govt-exams', GovtExamController::class)->name('govtexams');
        Route::get('govt-exams-search-notes', [GovtExamController::class, 'govtexamssearch'])->name('govtexamssearch');
        Route::get('legal-knowledge-library', LegalKnowledgeLibraryController::class)->name('legalknowledgelibrary');
        Route::get('legal-knowledge-library-search-notes', [LegalKnowledgeLibraryController::class, 'legalknowledgelibrarysearch'])->name('legalknowledgelibrarysearch');
        Route::get('acts-search-notes', [ActController::class, 'actssearch'])->name('actssearch');
        Route::get('copys-search-notes', [FreeNotesController::class, 'copyssearch'])->name('copyssearch');
        Route::get('course-search-notes', [CourseController::class, 'coursesearch'])->name('coursesearch');
        Route::post('contact-store', [ContactController::class, 'contactstore'])->name('contactstore');

        // Footer information pages — Dynamic from database
        Route::get('privacy-policy', [SitePageController::class, 'show'])->defaults('slug', 'privacy-policy')->name('privacy');
        Route::get('terms-and-conditions', [SitePageController::class, 'show'])->defaults('slug', 'terms-and-conditions')->name('terms');
        Route::get('disclaimer', [SitePageController::class, 'show'])->defaults('slug', 'disclaimer')->name('disclaimer');
        Route::get('refund-policy', [SitePageController::class, 'show'])->defaults('slug', 'refund-policy')->name('refund');
        Route::view('sitemap', 'pages.sitemap', ['pageTitle' => 'Sitemap'])->name('sitemap');
        Route::view('announcements', 'pages.announcements', ['pageTitle' => 'Announcements'])->name('announcements');
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
