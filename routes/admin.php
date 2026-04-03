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

            Route::delete('destroy-admission/{id}', [StudentAdmissinController::class, 'destroy'])
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

            Route::post('toggle-viewid', [RoutingController::class, 'toggleViewId'])
                ->name('toggleviewid');

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

            Route::get('list-acts', [CourseController::class, 'listacts'])
                ->name('listacts');

            Route::get('add-acts', [CourseController::class, 'addacts'])
                ->name('addacts');

            Route::post('store-acts', [CourseController::class, 'storeacts'])
                ->name('storeacts');

            Route::get('edit-acts/{id}', [CourseController::class, 'editacts'])
                ->name('editacts');

            Route::post('update-acts/{id}', [CourseController::class, 'updateacts'])
                ->name('updateacts');

            Route::delete('delete-acts', [CourseController::class, 'actsfiledelete'])
                ->name('actsfiledelete');

            Route::get('list-rules', [CourseController::class, 'listrules'])
                ->name('listrules');

            Route::get('add-rules', [CourseController::class, 'addrules'])
                ->name('addrules');

            Route::post('store-rules', [CourseController::class, 'storerules'])
                ->name('storerules');

            Route::get('edit-rules/{id}', [CourseController::class, 'editrules'])
                ->name('editrules');

            Route::post('update-rules/{id}', [CourseController::class, 'updaterules'])
                ->name('updaterules');

            Route::delete('delete-rules', [CourseController::class, 'rulesfiledelete'])
                ->name('rulesfiledelete');

            Route::get('banner', [CourseController::class, 'listbanner'])
                ->name('listbanner');

            Route::get('mailsetting', [CourseController::class, 'mailsetting'])
                ->name('mailsetting');

            Route::post('updatemailsetting/{id}', [CourseController::class, 'updatemailsetting'])
                ->name('updatemailsetting');

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

            Route::delete('category-delete/{id}', [CourseController::class, 'deleteCategory'])
                ->name('deleteCategory');

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

            Route::get('gallery-edit/{id}', [CourseController::class, 'editgallery'])
                ->name('editgallery');

            Route::post('gallery-update/{id}', [CourseController::class, 'updategallery'])
                ->name('updategallery');

            Route::delete('gallery-delete/{id}', [CourseController::class, 'deletegallery'])
                ->name('deletegallery');

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

            Route::post('send-email-otp', [StudentAdmissinController::class, 'sendEmailOtp'])
                ->name('sendemailotp');
            Route::post('verify-email-otp', [StudentAdmissinController::class, 'verifyEmailOtp'])
                ->name('verifyemailotp');

            Route::post('send-phone-otp', [StudentAdmissinController::class, 'sendPhoneOtp'])
                ->name('sendphoneotp');
            Route::post('verify-phone-otp', [StudentAdmissinController::class, 'verifyPhoneOtp'])
                ->name('verifyphoneotp');


            Route::get('subcategories/list', [CourseController::class, 'listactsubcategories'])
                ->name('listactsubcategories');
            Route::get('subcategories/add', [CourseController::class, 'addactsubcategory'])
                ->name('addactsubcategory');
            Route::post('subcategories/store', [CourseController::class, 'storeactsubcategory'])
                ->name('storeactsubcategory');
            Route::get('subcategories/edit/{id}', [CourseController::class, 'editactsubcategory'])
                ->name('editactsubcategory');
            Route::post('subcategories/update/{id}', [CourseController::class, 'updateactsubcategory'])
                ->name('updateactsubcategory');
            Route::post('subcategories/filedelete/{id}', [CourseController::class, 'actsubcategoryfiledelete'])
                ->name('deleteactsubcategoryfile');

            Route::get('subcategories/list', [CourseController::class, 'listrulessubcategories'])
                ->name('listrulessubcategories');
            Route::get('subcategories/add', [CourseController::class, 'addrulessubcategory'])
                ->name('addrulessubcategory');
            Route::post('subcategories/store', [CourseController::class, 'storerulessubcategory'])
                ->name('storerulessubcategory');
            Route::get('subcategories/edit/{id}', [CourseController::class, 'editrulessubcategory'])
                ->name('editrulessubcategory');
            Route::post('subcategories/update/{id}', [CourseController::class, 'updaterulessubcategory'])
                ->name('updaterulessubcategory');
            Route::post('subcategories/filedelete/{id}', [CourseController::class, 'rulessubcategoryfiledelete'])
                ->name('deleterulessubcategoryfile');

            Route::get('categorieslist', [CourseController::class, 'listactcategories'])
                ->name('listactcategories');
            Route::get('categories/add', [CourseController::class, 'addcategory'])
                ->name('addactcategory');
            Route::post('categories/store', [CourseController::class, 'storecategory'])
                ->name('storeactcategory');
            Route::get('categories/edit/{id}', [CourseController::class, 'editcategory'])
                ->name('editactcategory');
            Route::post('categories/update/{id}', [CourseController::class, 'updatecategory'])
                ->name('updateactcategory');
            Route::post('categories/filedelete/{id}', [CourseController::class, 'categoryfiledelete'])
                ->name('deleteactcategoryfile');

            Route::get('categories/list', [CourseController::class, 'listrulescategories'])
                ->name('listrulescategories');
            Route::get('categories/add', [CourseController::class, 'addrulescategory'])
                ->name('addrulescategory');
            Route::post('categories/store', [CourseController::class, 'storerulescategory'])
                ->name('storerulescategory');
            Route::get('categories/edit/{id}', [CourseController::class, 'editrulescategory'])
                ->name('editrulescategory');
            Route::post('categories/update/{id}', [CourseController::class, 'updaterulescategory'])
                ->name('updaterulescategory');
            Route::post('categories/filedelete/{id}', [CourseController::class, 'rulescategoryfiledelete'])
                ->name('deleterulescategoryfile');
        });

    Route::get('/legacy-admin', [RoutingController::class, 'admin'])
        ->name('admin');
});
