<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoutingController;
use App\Http\Controllers\Admin\StudentAdmissinController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseNoteController;
use App\Http\Controllers\Admin\CourseSubjectController;
use App\Http\Controllers\Admin\GovtExamController;
use App\Http\Controllers\Admin\LegalKnowledgeLibraryController;
use App\Http\Controllers\Admin\SitePageController;
use App\Http\Controllers\Admin\ActController;
use App\Http\Controllers\Admin\RulesController;
use App\Http\Controllers\Admin\CopyController;
use App\Http\Controllers\Admin\ContactFormController;
use App\Http\Controllers\Admin\StudentActivityController;

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

            Route::post('update-whatsapp/{id}', [StudentAdmissinController::class, 'updateWhatsapp'])
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

            Route::post('payment-mail/{id}', [RoutingController::class, 'sendpaymentmail'])
                ->name('sendpaymentmail');

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

            Route::get('list-acts', [ActController::class, 'listacts'])
                ->name('listacts');

            Route::get('add-acts', [ActController::class, 'addacts'])
                ->name('addacts');

            Route::post('store-acts', [ActController::class, 'storeacts'])
                ->name('storeacts');

            Route::get('edit-acts/{id}', [ActController::class, 'editacts'])
                ->name('editacts');

            Route::post('update-acts/{id}', [ActController::class, 'updateacts'])
                ->name('updateacts');

            Route::post('delete-acts/{id}', [ActController::class, 'actsfiledelete'])
                ->name('actsfiledelete');

            Route::get('list-rules', [RulesController::class, 'listrules'])
                ->name('listrules');

            Route::get('add-rules', [RulesController::class, 'addrules'])
                ->name('addrules');

            Route::post('store-rules', [RulesController::class, 'storerules'])
                ->name('storerules');

            Route::get('edit-rules/{id}', [RulesController::class, 'editrules'])
                ->name('editrules');

            Route::post('update-rules/{id}', [RulesController::class, 'updaterules'])
                ->name('updaterules');

            Route::post('delete-rules/{id}', [RulesController::class, 'rulesfiledelete'])
                ->name('rulesfiledelete');

            // ===== Centre & State Govt. Examination (new, standalone feature) =====

            Route::get('list-govt-exams', [GovtExamController::class, 'listexams'])
                ->name('listgovtexams');

            Route::get('add-govt-exams', [GovtExamController::class, 'addexam'])
                ->name('addgovtexams');

            Route::post('store-govt-exams', [GovtExamController::class, 'storeexam'])
                ->name('storegovtexams');

            Route::get('edit-govt-exams/{id}', [GovtExamController::class, 'editexam'])
                ->name('editgovtexams');

            Route::post('update-govt-exams/{id}', [GovtExamController::class, 'updateexam'])
                ->name('updategovtexams');

            Route::post('delete-govt-exams/{id}', [GovtExamController::class, 'examfiledelete'])
                ->name('govtexamsfiledelete');

            Route::get('govtexamcategories-list', [GovtExamController::class, 'listcategories'])
                ->name('listgovtexamcategories');
            Route::get('govtexamcategories-add', [GovtExamController::class, 'addcategory'])
                ->name('addgovtexamcategory');
            Route::post('govtexamcategories-store', [GovtExamController::class, 'storecategory'])
                ->name('storegovtexamcategory');
            Route::get('govtexamcategories-edit/{id}', [GovtExamController::class, 'editcategory'])
                ->name('editgovtexamcategory');
            Route::post('govtexamcategories-update/{id}', [GovtExamController::class, 'updatecategory'])
                ->name('updategovtexamcategory');
            Route::post('govtexamcategories-filedelete/{id}', [GovtExamController::class, 'deletecategoryfile'])
                ->name('deletegovtexamcategoryfile');

            Route::get('govtexamsubcategories-list', [GovtExamController::class, 'listsubcategories'])
                ->name('listgovtexamsubcategories');
            Route::get('govtexamsubcategories-add', [GovtExamController::class, 'addsubcategory'])
                ->name('addgovtexamsubcategory');
            Route::post('govtexamsubcategories-store', [GovtExamController::class, 'storesubcategory'])
                ->name('storegovtexamsubcategory');
            Route::get('govtexamsubcategories-edit/{id}', [GovtExamController::class, 'editsubcategory'])
                ->name('editgovtexamsubcategory');
            Route::post('govtexamsubcategories-update/{id}', [GovtExamController::class, 'updatesubcategory'])
                ->name('updategovtexamsubcategory');
            Route::post('govtexamsubcategories-filedelete/{id}', [GovtExamController::class, 'deletesubcategoryfile'])
                ->name('deletegovtexamsubcategoryfile');

            // ===== end Centre & State Govt. Examination =====

            // ===== Legal Knowledge (new, standalone library feature) =====

            Route::get('list-legal-knowledge-library', [LegalKnowledgeLibraryController::class, 'listnotes'])
                ->name('listlegalknowledgelibrary');

            Route::get('add-legal-knowledge-library', [LegalKnowledgeLibraryController::class, 'addnote'])
                ->name('addlegalknowledgelibrary');

            Route::post('store-legal-knowledge-library', [LegalKnowledgeLibraryController::class, 'storenote'])
                ->name('storelegalknowledgelibrary');

            Route::get('edit-legal-knowledge-library/{id}', [LegalKnowledgeLibraryController::class, 'editnote'])
                ->name('editlegalknowledgelibrary');

            Route::post('update-legal-knowledge-library/{id}', [LegalKnowledgeLibraryController::class, 'updatenote'])
                ->name('updatelegalknowledgelibrary');

            Route::post('delete-legal-knowledge-library/{id}', [LegalKnowledgeLibraryController::class, 'notefiledelete'])
                ->name('legalknowledgelibraryfiledelete');

            Route::get('legalknowledgelibrarycategories-list', [LegalKnowledgeLibraryController::class, 'listcategories'])
                ->name('listlegalknowledgelibrarycategories');
            Route::get('legalknowledgelibrarycategories-add', [LegalKnowledgeLibraryController::class, 'addcategory'])
                ->name('addlegalknowledgelibrarycategory');
            Route::post('legalknowledgelibrarycategories-store', [LegalKnowledgeLibraryController::class, 'storecategory'])
                ->name('storelegalknowledgelibrarycategory');
            Route::get('legalknowledgelibrarycategories-edit/{id}', [LegalKnowledgeLibraryController::class, 'editcategory'])
                ->name('editlegalknowledgelibrarycategory');
            Route::post('legalknowledgelibrarycategories-update/{id}', [LegalKnowledgeLibraryController::class, 'updatecategory'])
                ->name('updatelegalknowledgelibrarycategory');
            Route::post('legalknowledgelibrarycategories-filedelete/{id}', [LegalKnowledgeLibraryController::class, 'deletecategoryfile'])
                ->name('deletelegalknowledgelibrarycategoryfile');

            Route::get('legalknowledgelibrarysubcategories-list', [LegalKnowledgeLibraryController::class, 'listsubcategories'])
                ->name('listlegalknowledgelibrarysubcategories');
            Route::get('legalknowledgelibrarysubcategories-add', [LegalKnowledgeLibraryController::class, 'addsubcategory'])
                ->name('addlegalknowledgelibrarysubcategory');
            Route::post('legalknowledgelibrarysubcategories-store', [LegalKnowledgeLibraryController::class, 'storesubcategory'])
                ->name('storelegalknowledgelibrarysubcategory');
            Route::get('legalknowledgelibrarysubcategories-edit/{id}', [LegalKnowledgeLibraryController::class, 'editsubcategory'])
                ->name('editlegalknowledgelibrarysubcategory');
            Route::post('legalknowledgelibrarysubcategories-update/{id}', [LegalKnowledgeLibraryController::class, 'updatesubcategory'])
                ->name('updatelegalknowledgelibrarysubcategory');
            Route::post('legalknowledgelibrarysubcategories-filedelete/{id}', [LegalKnowledgeLibraryController::class, 'deletesubcategoryfile'])
                ->name('deletelegalknowledgelibrarysubcategoryfile');

            // ===== end Legal Knowledge =====

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

            Route::delete('course-delete/{id}', [CourseController::class, 'coursedelete'])
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
            Route::delete('course-notes/{id}', [CourseNoteController::class, 'deletenotes'])
                ->name('deletenotes');
            Route::get('course-notes/view/{id}', [CourseNoteController::class, 'viewNote'])
                ->name('viewnote');
            Route::post('store-notes', [CourseNoteController::class, 'storenotes'])
                ->name('storenotes');

            // Course Subjects — additive "Subject" grouping level (Course → Subject → Chapter/PDF Notes)
            Route::get('course-subjects', [CourseSubjectController::class, 'listsubjects'])
                ->name('listsubjects');
            Route::get('course-subjects-add', [CourseSubjectController::class, 'addsubject'])
                ->name('addsubject');
            Route::post('course-subjects-store', [CourseSubjectController::class, 'storesubject'])
                ->name('storesubject');
            Route::get('course-subjects-edit/{id}', [CourseSubjectController::class, 'editsubject'])
                ->name('editsubject');
            Route::post('course-subjects-update/{id}', [CourseSubjectController::class, 'updatesubject'])
                ->name('updatesubject');
            Route::post('course-subjects-delete/{id}', [CourseSubjectController::class, 'deletesubject'])
                ->name('deletesubject');
            Route::post('send-email-otp', [StudentAdmissinController::class, 'sendEmailOtp'])
                ->name('sendemailotp');
            Route::post('verify-email-otp', [StudentAdmissinController::class, 'verifyEmailOtp'])
                ->name('verifyemailotp');
            Route::post('send-phone-otp', [StudentAdmissinController::class, 'sendPhoneOtp'])
                ->name('sendphoneotp');
            Route::post('verify-phone-otp', [StudentAdmissinController::class, 'verifyPhoneOtp'])
                ->name('verifyphoneotp');
            Route::delete('addacts/{id}/file/{key}', [ActController::class, 'deleteaddfile'])
                ->name('deleteaddfile');

            Route::get('actsubcategories-list', [ActController::class, 'listactsubcategories'])
                ->name('listactsubcategories');
            Route::get('actsubcategories-add', [ActController::class, 'addactsubcategory'])
                ->name('addactsubcategory');
            Route::post('actsubcategories-store', [ActController::class, 'storeactsubcategory'])
                ->name('storeactsubcategory');
            Route::get('actsubcategories-edit/{id}', [ActController::class, 'editactsubcategory'])
                ->name('editactsubcategory');
            Route::post('actsubcategories-update/{id}', [ActController::class, 'updateactsubcategory'])
                ->name('updateactsubcategory');
            Route::post('actsubcategories-filedelete/{id}', [ActController::class, 'deleteactsubcategoryfile'])
                ->name('deleteactsubcategoryfile');

            Route::get('rulessubcategories-list', [RulesController::class, 'listrulessubcategories'])
                ->name('listrulessubcategories');
            Route::get('rulessubcategories-add', [RulesController::class, 'addrulessubcategory'])
                ->name('addrulessubcategory');
            Route::post('rulessubcategories-store', [RulesController::class, 'storerulessubcategory'])
                ->name('storerulessubcategory');
            Route::get('rulessubcategories-edit/{id}', [RulesController::class, 'editrulessubcategory'])
                ->name('editrulessubcategory');
            Route::post('rulessubcategories-update/{id}', [RulesController::class, 'updaterulessubcategory'])
                ->name('updaterulessubcategory');
            Route::post('rulessubcategories-filedelete/{id}', [RulesController::class, 'deleterulessubcategoryfile'])
                ->name('deleterulessubcategoryfile');

            Route::get('actcategories-list', [ActController::class, 'listactcategories'])
                ->name('listactcategories');
            Route::get('actcategories-add', [ActController::class, 'addactcategory'])
                ->name('addactcategory');
            Route::post('actcategories-store', [ActController::class, 'storeactcategory'])
                ->name('storeactcategory');
            Route::get('actcategories-edit/{id}', [ActController::class, 'editactcategory'])
                ->name('editactcategory');
            Route::post('actcategories-update/{id}', [ActController::class, 'updateactcategory'])
                ->name('updateactcategory');
            Route::post('actcategories-filedelete/{id}', [ActController::class, 'deleteactcategoryfile'])
                ->name('deleteactcategoryfile');

            Route::get('rulescategories-list', [RulesController::class, 'listrulescategories'])
                ->name('listrulescategories');
            Route::get('rulescategories-add', [RulesController::class, 'addrulescategory'])
                ->name('addrulescategory');
            Route::post('rulescategories-store', [RulesController::class, 'storerulescategory'])
                ->name('storerulescategory');
            Route::get('rulescategories-edit/{id}', [RulesController::class, 'editrulescategory'])
                ->name('editrulescategory');
            Route::post('rulescategories-update/{id}', [RulesController::class, 'updaterulescategory'])
                ->name('updaterulescategory');
            Route::post('rulescategories-filedelete/{id}', [RulesController::class, 'deleterulescategoryfile'])
                ->name('deleterulescategoryfile');

            //copy

            Route::get('list-copys', [CopyController::class, 'listcopys'])
                ->name('listcopys');
            Route::get('add-copys', [CopyController::class, 'addcopys'])
                ->name('addcopys');
            Route::post('store-copys', [CopyController::class, 'storecopys'])
                ->name('storecopys');
            Route::get('edit-copys/{id}', [CopyController::class, 'editcopys'])
                ->name('editcopys');
            Route::post('update-copys/{id}', [CopyController::class, 'updatecopys'])
                ->name('updatecopys');
            Route::post('delete-copys/{id}', [CopyController::class, 'copysfiledelete'])
                ->name('copysfiledelete');

            Route::get('copyssubcategories-list', [CopyController::class, 'listcopyssubcategories'])
                ->name('listcopyssubcategories');
            Route::get('copyssubcategories-add', [CopyController::class, 'addcopyssubcategory'])
                ->name('addcopyssubcategory');
            Route::post('copyssubcategories-store', [CopyController::class, 'storecopyssubcategory'])
                ->name('storecopyssubcategory');
            Route::get('copyssubcategories-edit/{id}', [CopyController::class, 'editcopyssubcategory'])
                ->name('editcopyssubcategory');
            Route::post('copyssubcategories-update/{id}', [CopyController::class, 'updatecopyssubcategory'])
                ->name('updatecopyssubcategory');
            Route::post('copyssubcategories-filedelete/{id}', [CopyController::class, 'deletecopyssubcategoryfile'])
                ->name('deletecopyssubcategoryfile');

            Route::get('copyscategories-list', [CopyController::class, 'listcopyscategories'])
                ->name('listcopyscategories');
            Route::get('copyscategories-add', [CopyController::class, 'addcopyscategory'])
                ->name('addcopyscategory');
            Route::post('copyscategories-store', [CopyController::class, 'storecopyscategory'])
                ->name('storecopyscategory');
            Route::get('copyscategories-edit/{id}', [CopyController::class, 'editcopyscategory'])
                ->name('editcopyscategory');
            Route::post('copyscategories-update/{id}', [CopyController::class, 'updatecopyscategory'])
                ->name('updatecopyscategory');
            Route::post('copyscategories-filedelete/{id}', [CopyController::class, 'deletecopyscategoryfile'])
                ->name('deletecopyscategoryfile');
            Route::get('view-student-activity/{id}', [StudentActivityController::class, 'viewstudentactivity'])
                ->name('viewstudentactivity');
            Route::get('list-student-activity', [StudentActivityController::class, 'liststudentactivity'])
                ->name('liststudentactivity');
            Route::get('list-contactform', [ContactFormController::class, 'listcontactform'])
                ->name('listcontactform');
            Route::post('send-contactmail/{id}', [ContactFormController::class, 'sendcontactmail'])
                ->name('sendcontactmail');
            Route::post('delete-contact/{id}', [ContactFormController::class, 'deletecontact'])
                ->name('deletecontact');

            Route::get('contact-view/{id}', [ContactFormController::class, 'viewcontactform'])
                ->name('viewcontactform');

            // ===== Site Pages (Privacy Policy, Terms, Disclaimer, Refund Policy) =====

            Route::get('site-pages', [SitePageController::class, 'index'])
                ->name('listsitepages');
            Route::get('site-pages-edit/{id}', [SitePageController::class, 'edit'])
                ->name('editsitepage');
            Route::post('site-pages-update/{id}', [SitePageController::class, 'update'])
                ->name('updatesitepage');
            Route::post('site-pages-reset/{id}', [SitePageController::class, 'reset'])
                ->name('resetsitepage');
        });

    Route::get('/legacy-admin', [RoutingController::class, 'admin'])
        ->name('admin');
});
