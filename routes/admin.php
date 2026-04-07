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

            Route::get('listcoursesubcategory', [CourseController::class, 'listcoursesubcategory'])
                ->name('listcoursesubcategory');

            Route::get('listcoursecategory', [CourseController::class, 'listcoursecategory'])
                ->name('listcoursecategory');

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

            Route::delete('delete-clientele/{id}', [CourseController::class, 'clientelefiledelete'])
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

            Route::post('delete-acts/{id}', [CourseController::class, 'actsfiledelete'])
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

            Route::post('delete-rules/{id}', [CourseController::class, 'rulesfiledelete'])
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
            Route::put('course-notes/{id}', [CourseNoteController::class, 'deletenotes'])
                ->name('deletenotes');
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
            Route::delete('addacts/{id}/file/{key}', [CourseController::class, 'deleteaddfile'])
                ->name('deleteaddfile');

            Route::get('actsubcategories-list', [CourseController::class, 'listactsubcategories'])
                ->name('listactsubcategories');
            Route::get('actsubcategories-add', [CourseController::class, 'addactsubcategory'])
                ->name('addactsubcategory');
            Route::post('actsubcategories-store', [CourseController::class, 'storeactsubcategory'])
                ->name('storeactsubcategory');
            Route::get('actsubcategories-edit/{id}', [CourseController::class, 'editactsubcategory'])
                ->name('editactsubcategory');
            Route::post('actsubcategories-update/{id}', [CourseController::class, 'updateactsubcategory'])
                ->name('updateactsubcategory');
            Route::post('actsubcategories-filedelete/{id}', [CourseController::class, 'deleteactsubcategoryfile'])
                ->name('deleteactsubcategoryfile');

            Route::get('rulessubcategories-list', [CourseController::class, 'listrulessubcategories'])
                ->name('listrulessubcategories');
            Route::get('rulessubcategories-add', [CourseController::class, 'addrulessubcategory'])
                ->name('addrulessubcategory');
            Route::post('rulessubcategories-store', [CourseController::class, 'storerulessubcategory'])
                ->name('storerulessubcategory');
            Route::get('rulessubcategories-edit/{id}', [CourseController::class, 'editrulessubcategory'])
                ->name('editrulessubcategory');
            Route::post('rulessubcategories-update/{id}', [CourseController::class, 'updaterulessubcategory'])
                ->name('updaterulessubcategory');
            Route::post('rulessubcategories-filedelete/{id}', [CourseController::class, 'deleterulessubcategoryfile'])
                ->name('deleterulessubcategoryfile');

            Route::get('actcategories-list', [CourseController::class, 'listactcategories'])
                ->name('listactcategories');
            Route::get('actcategories-add', [CourseController::class, 'addactcategory'])
                ->name('addactcategory');
            Route::post('actcategories-store', [CourseController::class, 'storeactcategory'])
                ->name('storeactcategory');
            Route::get('actcategories-edit/{id}', [CourseController::class, 'editactcategory'])
                ->name('editactcategory');
            Route::post('actcategories-update/{id}', [CourseController::class, 'updateactcategory'])
                ->name('updateactcategory');
            Route::post('actcategories-filedelete/{id}', [CourseController::class, 'deleteactcategoryfile'])
                ->name('deleteactcategoryfile');

            Route::get('rulescategories-list', [CourseController::class, 'listrulescategories'])
                ->name('listrulescategories');
            Route::get('rulescategories-add', [CourseController::class, 'addrulescategory'])
                ->name('addrulescategory');
            Route::post('rulescategories-store', [CourseController::class, 'storerulescategory'])
                ->name('storerulescategory');
            Route::get('rulescategories-edit/{id}', [CourseController::class, 'editrulescategory'])
                ->name('editrulescategory');
            Route::post('rulescategories-update/{id}', [CourseController::class, 'updaterulescategory'])
                ->name('updaterulescategory');
            Route::post('rulescategories-filedelete/{id}', [CourseController::class, 'deleterulescategoryfile'])
                ->name('deleterulescategoryfile');

            //copy

            Route::get('list-copys', [CourseController::class, 'listcopys'])
                ->name('listcopys');
            Route::get('add-copys', [CourseController::class, 'addcopys'])
                ->name('addcopys');
            Route::post('store-copys', [CourseController::class, 'storecopys'])
                ->name('storecopys');
            Route::get('edit-copys/{id}', [CourseController::class, 'editcopys'])
                ->name('editcopys');
            Route::post('update-copys/{id}', [CourseController::class, 'updatecopys'])
                ->name('updatecopys');
            Route::post('delete-copys/{id}', [CourseController::class, 'copysfiledelete'])
                ->name('copysfiledelete');

            Route::get('copyssubcategories-list', [CourseController::class, 'listcopyssubcategories'])
                ->name('listcopyssubcategories');
            Route::get('copyssubcategories-add', [CourseController::class, 'addcopyssubcategory'])
                ->name('addcopyssubcategory');
            Route::post('copyssubcategories-store', [CourseController::class, 'storecopyssubcategory'])
                ->name('storecopyssubcategory');
            Route::get('copyssubcategories-edit/{id}', [CourseController::class, 'editcopyssubcategory'])
                ->name('editcopyssubcategory');
            Route::post('copyssubcategories-update/{id}', [CourseController::class, 'updatecopyssubcategory'])
                ->name('updatecopyssubcategory');
            Route::post('copyssubcategories-filedelete/{id}', [CourseController::class, 'deletecopyssubcategoryfile'])
                ->name('deletecopyssubcategoryfile');

            Route::get('copyscategories-list', [CourseController::class, 'listcopyscategories'])
                ->name('listcopyscategories');
            Route::get('copyscategories-add', [CourseController::class, 'addcopyscategory'])
                ->name('addcopyscategory');
            Route::post('copyscategories-store', [CourseController::class, 'storecopyscategory'])
                ->name('storecopyscategory');
            Route::get('copyscategories-edit/{id}', [CourseController::class, 'editcopyscategory'])
                ->name('editcopyscategory');
            Route::post('copyscategories-update/{id}', [CourseController::class, 'updatecopyscategory'])
                ->name('updatecopyscategory');
            Route::post('copyscategories-filedelete/{id}', [CourseController::class, 'deletecopyscategoryfile'])
                ->name('deletecopyscategoryfile');
        });

    Route::get('/legacy-admin', [RoutingController::class, 'admin'])
        ->name('admin');
});
