<?php

/*
 * Student panel structure, read by App\Support\StudentPanel: the menu, the search
 * palette, breadcrumbs and the buttons under each page title.
 *
 * Presentation only. Every entry points at a route that already exists (plus the two
 * read-only pages added with this layer: fees and help); no route, controller or query
 * lives here.
 */

return [

    'console' => 'Student Portal',

    /*
     * Menu. `caption` rows are headings; an item is a link (`route`) or a group
     * (`children`). `badge` names a status word from StudentPanel::badges().
     */
    'nav' => [
        ['caption' => 'Overview'],
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'home', 'route' => 'student.dashboard'],

        ['caption' => 'My Application'],
        ['key' => 'applications', 'label' => 'Applications', 'icon' => 'file-text', 'children' => [
            ['label' => 'Registration', 'route' => 'student.viewstudent'],
            ['label' => 'Admission', 'route' => 'student.viewadmission'],
        ]],
        ['key' => 'idcard', 'label' => 'ID Card', 'icon' => 'user-check', 'badge' => 'idcard', 'route' => 'student.viewidcard'],

        ['caption' => 'Fees'],
        ['key' => 'fees', 'label' => 'Fee Summary', 'icon' => 'credit-card', 'badge' => 'fees', 'route' => 'student.fees'],
        ['key' => 'slips', 'label' => 'Payment Slips', 'icon' => 'file', 'route' => 'student.viewpayment'],

        ['caption' => 'Learning'],
        ['key' => 'courses', 'label' => 'Courses', 'icon' => 'book-open', 'badge' => 'courses', 'route' => 'student.listcourse', 'also' => ['student.viewcourse']],
        ['key' => 'notes', 'label' => 'Favourite Notes', 'icon' => 'bookmark', 'route' => 'student.listnotes'],

        ['caption' => 'Support'],
        ['key' => 'changepassword', 'label' => 'Change Password', 'icon' => 'lock', 'route' => 'student.showchangepassword'],
        ['key' => 'help', 'label' => 'Help & Support', 'icon' => 'help-circle', 'route' => 'student.help'],
    ],

    /*
     * The row of shortcuts under a page title ("My records"): [label, icon, route].
     */
    'jump' => [
        ['Registration', 'user', 'student.viewstudent'],
        ['Admission', 'file-text', 'student.viewadmission'],
        ['Fee summary', 'credit-card', 'student.fees'],
        ['ID card', 'user-check', 'student.viewidcard'],
        ['Courses', 'book-open', 'student.listcourse'],
        ['Favourite notes', 'bookmark', 'student.listnotes'],
    ],

    /*
     * Pages: route name => title, kind (dashboard|view|list|doc|other), parent route,
     * links [[label, icon, route]] for the buttons beside the title.
     */
    'pages' => [
        'student.dashboard' => ['title' => 'Dashboard', 'kind' => 'dashboard'],
        'student.viewstudent' => ['title' => 'My Registration', 'kind' => 'view', 'group' => 'My Application',
            'links' => [['Admission', 'file-text', 'student.viewadmission']]],
        'student.viewadmission' => ['title' => 'My Admission', 'kind' => 'view', 'group' => 'My Application',
            'links' => [['Fee summary', 'credit-card', 'student.fees'], ['Need help?', 'help-circle', 'student.help']]],
        'student.viewidcard' => ['title' => 'My ID Card', 'kind' => 'doc', 'group' => 'My Application',
            'links' => [['Fee summary', 'credit-card', 'student.fees']]],
        'student.fees' => ['title' => 'Fee Summary', 'kind' => 'view', 'group' => 'Fees',
            'links' => [['Payment slips', 'file', 'student.viewpayment'], ['Courses', 'book-open', 'student.listcourse']]],
        'student.listcourse' => ['title' => 'My Courses', 'kind' => 'list', 'group' => 'Learning',
            'links' => [['Favourite notes', 'bookmark', 'student.listnotes'], ['Fee summary', 'credit-card', 'student.fees']]],
        'student.viewcourse' => ['title' => 'Course', 'kind' => 'view', 'group' => 'Learning', 'parent' => 'student.listcourse',
            'links' => [['Favourite notes', 'bookmark', 'student.listnotes']]],
        'student.listnotes' => ['title' => 'Favourite Notes', 'kind' => 'list', 'group' => 'Learning',
            'links' => [['Courses', 'book-open', 'student.listcourse']]],
        'student.showchangepassword' => ['title' => 'Change Password', 'kind' => 'view', 'group' => 'Support'],
        'student.help' => ['title' => 'Help & Support', 'kind' => 'other', 'group' => 'Support'],
    ],
];
