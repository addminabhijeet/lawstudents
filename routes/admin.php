<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoutingController;
use App\Http\Controllers\Admin\StudentAdmissinController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseNoteController;

Route::middleware(['admin.auth'])->group(function () {

    Route::middleware(['auth:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/', [RoutingController::class, 'admin'])
                ->name('dashboard');

            Route::get('add-student', [RoutingController::class, 'addstudent'])
                ->name('addstudent');

            Route::get('edit-student/{id}', [RoutingController::class, 'editstudent'])
                ->name('editstudent');

            Route::get('view-student/{id}', [RoutingController::class, 'viewstudent'])
                ->name('viewstudent');

            Route::get('show-student/{id}', [RoutingController::class, 'showstudent'])
                ->name('showstudent');

            Route::get('list-student', [RoutingController::class, 'liststudent'])
                ->name('liststudent');

            Route::get('list-admission', [StudentAdmissinController::class, 'index'])
                ->name('listadmission');

            Route::get('whatsapp', [StudentAdmissinController::class, 'whatsapp'])
                ->name('whatsapp');

            Route::post('update-whatsapp/{id}', [RoutingController::class, 'updateWhatsapp'])
                ->name('updateWhatsapp');

            Route::get('show-admission/{id}', [StudentAdmissinController::class, 'showadmission'])
                ->name('showadmission');

            Route::get('edit-admission/{id}', [StudentAdmissinController::class, 'edit'])
                ->name('editadmission');

            Route::get('destroy-admission', [StudentAdmissinController::class, 'destroy'])
                ->name('destroyadmission');

            Route::delete('destroy-student/{id}', [RoutingController::class, 'destroystudent'])
                ->name('destroystudent');

            Route::get('add-payment', [RoutingController::class, 'addpayment'])
                ->name('addpayment');

            Route::get('edit-payment/{id}', [RoutingController::class, 'editpayment'])
                ->name('editpayment');

            Route::get('list-payment', [RoutingController::class, 'listpayment'])
                ->name('listpayment');

            Route::get('list-subject', [RoutingController::class, 'listsubject'])
                ->name('listsubject');

            Route::post('register-student', [RoutingController::class, 'registerstusubmit'])
                ->name('registerstusubmit');

            Route::post('update-student/{id}', [RoutingController::class, 'updatestusubmit'])
                ->name('updatestusubmit');

            Route::post('register-admission', [StudentAdmissinController::class, 'registeradmsubmit'])
                ->name('registeradmsubmit');

            Route::post('update-admission/{id}', [StudentAdmissinController::class, 'updateadmsubmit'])
                ->name('updateadmsubmit');

            Route::post('update-payment/{id}', [RoutingController::class, 'updatepayment'])
                ->name('updatepayment');

            Route::get('view-payment/{id}', [RoutingController::class, 'viewpayment'])
                ->name('viewpayment');

            Route::get('view-idcard/{id}', [RoutingController::class, 'viewidcard'])
                ->name('viewidcard');

            Route::get('list-idcard', [RoutingController::class, 'listidcard'])
                ->name('listidcard');

            Route::get('courses', [CourseController::class, 'listcourse'])
                ->name('listcourse');

            Route::get('list-clientele', [CourseController::class, 'listclientele'])
                ->name('listclientele');

            Route::get('add-clientele', [CourseController::class, 'addclientele'])
                ->name('addclientele');

            Route::post('store-clientele', [CourseController::class, 'storeclientele'])
                ->name('storeclientele');

            Route::get('edit-clientele/{id}', [CourseController::class, 'editclientele'])
                ->name('editclientele');

            Route::post('update-clientele/{id}', [CourseController::class, 'updateclientele'])
                ->name('updateclientele');

            Route::delete('delete-clientele', [CourseController::class, 'clientelefiledelete'])
                ->name('clientelefiledelete');

            Route::get('banner', [CourseController::class, 'listbanner'])
                ->name('listbanner');

            Route::post('store-banner', [CourseController::class, 'storebanner'])
                ->name('storebanner');

            Route::get('course-edit/{id}', [CourseController::class, 'editcourse'])
                ->name('editcourse');

            Route::post('course-update/{id}', [CourseController::class, 'updatecourse'])
                ->name('updatecourse');

            Route::get('course-delete/{id}', [CourseController::class, 'coursedelete'])
                ->name('coursedelete');

            Route::get('category-edit/{id}', [CourseController::class, 'editCategory'])
                ->name('editCategory');

            Route::post('category-update/{id}', [CourseController::class, 'updateCategory'])
                ->name('updateCategory');

            Route::get('gallery', [CourseController::class, 'listgallery'])
                ->name('listgallery');

            Route::get('admin-details', [CourseController::class, 'admindetails'])
                ->name('admindetails');

            Route::post('update-details/{id}', [CourseController::class, 'updatedetails'])
                ->name('updatedetails');

            Route::post('store-gallery', [CourseController::class, 'storegallery'])
                ->name('storegallery');

            Route::post('category-store', [CourseController::class, 'storecategory'])
                ->name('storecategory');

            Route::post('course-store', [CourseController::class, 'storecourse'])
                ->name('storecourse');

            Route::get('course-notes', [CourseNoteController::class, 'listnotes'])
                ->name('listnotes');

            Route::get('course-free-notes', [CourseNoteController::class, 'listfreenotes'])
                ->name('listfreenotes');

            Route::put('course-notes/{id}', [CourseNoteController::class, 'updatenotes'])
                ->name('updatenotes');

            Route::get('course-notes/view/{id}', [CourseNoteController::class, 'viewNote'])
                ->name('viewnote');

            Route::post('store-notes', [CourseNoteController::class, 'storenotes'])
                ->name('storenotes');

            Route::post('send-email-otp', [StudentAdmissinController::class, 'sendEmailOtp'])->name('sendemailotp');
            Route::post('verify-email-otp', [StudentAdmissinController::class, 'verifyEmailOtp'])->name('verifyemailotp');

            Route::post('send-phone-otp', [StudentAdmissinController::class, 'sendPhoneOtp'])->name('sendphoneotp');
            Route::post('verify-phone-otp', [StudentAdmissinController::class, 'verifyPhoneOtp'])->name('verifyphoneotp');
        });

    Route::get('/legacy-admin', [RoutingController::class, 'admin'])
        ->name('admin');
});
