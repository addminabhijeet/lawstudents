@include('layouts.partials.admin.dashboard')
@php
    $tasks = [
        ['user-plus', 'Register a new student', [
            'Open <b>Students → Add Student</b> (or press <kbd class="ls-kbd">N</kbd>).',
            'Enter the name, email and a password, then press <b>Create Account</b>.',
            'You are taken straight to the admission form. Fill it in and save.',
        ], route('admin.addstudent'), 'Add a student'],
        ['file-text', 'Approve or reject an admission', [
            'Open <b>Admissions</b>. The number beside the menu item is how many are waiting.',
            'Press the pencil to open the admission, change <b>Admission Status</b>, then save.',
            'Use the <b>⋯</b> button on any row to jump to the student\'s payment, ID card or activity.',
        ], route('admin.listadmission'), 'Open admissions'],
        ['credit-card', 'Record a payment received', [
            'Open <b>Payments</b> and press the pencil on the student.',
            'Enter the <b>Paid Amount</b> on their newest invoice and save. The status updates by itself.',
            'The row\'s <b>⋯</b> button opens the payment slip, which you can print or download.',
        ], route('admin.listpayment'), 'Open payments'],
        ['alert-circle', 'Chase fees that are late', [
            'Open <b>Fees Due</b> and choose the <b>Overdue</b> tab.',
            'Press the WhatsApp or mail icon on a row. A polite reminder is written for you to check and send.',
            'Download the whole list as a spreadsheet with <b>Download all as CSV</b>.',
        ], route('admin.reports.dues', ['filter' => 'overdue']), 'Open fees due'],
        ['user-check', 'Issue an ID card', [
            'Open <b>ID Cards</b> and press <b>ID card</b> on a student to view it.',
            'The visibility button on the same row decides whether the student can open the card in their own panel.',
        ], route('admin.listidcard'), 'Open ID cards'],
        ['file', 'Add study notes to a course', [
            'Open <b>Courses → Course Notes</b> and press <b>Add Notes</b>.',
            'Pick the course and subject, upload the PDF and save.',
            'Subjects are managed under <b>Courses → Subjects</b>.',
        ], route('admin.listnotes'), 'Open course notes'],
        ['inbox', 'Answer an enquiry', [
            'New website messages are under <b>Enquiries → Contact Messages</b>; admission form enquiries under <b>Admission Enquiries</b>.',
            'Open a message and use <b>Reply by email</b>, <b>Call</b> or <b>WhatsApp</b> in the bar above it.',
            'If the person wants to join, press <b>Register as student</b>.',
        ], route('admin.listcontactform'), 'Open messages'],
        ['layout', 'Change what the website shows', [
            'Open <b>Website Content</b> for the banner, gallery, clients, WhatsApp number and legal pages.',
            'Acts, Rules, Govt. Examination, Legal Knowledge and Free Notes each have <b>Categories</b>, <b>Sub Categories</b> and the items themselves.',
        ], route('admin.listbanner'), 'Open website content'],
    ];
@endphp
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Help &amp; Guide</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Help &amp; Guide</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <p class="ls-lead">Short answers to "how do I…?". Every page also has buttons for the next likely task, so you rarely need to go back to the menu.</p>

            <div class="ls-tips-bar">
                <div><i class="feather-search" aria-hidden="true"></i><span>Press <kbd class="ls-kbd" data-ls-kbd="K">Ctrl K</kbd> to find any student, payment, course or page.</span></div>
                <div><i class="feather-more-horizontal" aria-hidden="true"></i><span>The <b>⋯</b> button on a list row opens that student's other records.</span></div>
                <div><i class="feather-star" aria-hidden="true"></i><span>Press the ☆ beside a page title to pin it to the top of the menu.</span></div>
                <div><i class="feather-download" aria-hidden="true"></i><span><b>Export</b> above a list saves it as a spreadsheet, prints it or copies it.</span></div>
            </div>

            <div class="ls-help">
                @foreach ($tasks as [$ico, $title, $steps, $url, $label])
                    <section class="card ls-help__card" aria-labelledby="help-{{ $loop->index }}">
                        <div class="card-body">
                            <div class="ls-report__head">
                                <span class="ls-report__icon"><i class="feather-{{ $ico }}" aria-hidden="true"></i></span>
                                <h2 class="ls-report__title" id="help-{{ $loop->index }}">{{ $title }}</h2>
                            </div>
                            <ol class="ls-steps">
                                @foreach ($steps as $step)<li>{!! $step !!}</li>@endforeach
                            </ol>
                            <a href="{{ $url }}" class="btn btn-light-brand btn-sm">{{ $label }} <i class="feather-arrow-right ms-1"></i></a>
                        </div>
                    </section>
                @endforeach
            </div>

            <p class="ls-lead mt-4"><button type="button" class="ls-linkbtn" data-ls-open="shortcuts"><i class="feather-help-circle"></i><span>See all keyboard shortcuts</span></button></p>
        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')
