<?php

/*
 * Admin panel structure: the single list the sidebar menu, the quick-create menu,
 * the search palette, the breadcrumbs and the "related actions" bars are built from.
 *
 * Presentation only. Every entry points at a route that already exists; no route,
 * controller or query lives here. Read by App\Support\AdminPanel.
 */

return [

    'brand' => [
        'name' => 'Law Students',
        'console' => 'Admin Console',
        'site_url' => '/',
    ],

    /*
     * Sidebar. `caption` rows are section headings. An item is either a link
     * (`route`) or a group (`children`). `badge` names a live count from
     * AdminPanel::badges(). `also` lists extra routes that keep the item highlighted.
     */
    'nav' => [
        ['caption' => 'Overview'],
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'home', 'route' => 'admin.dashboard'],

        ['caption' => 'Admissions'],
        ['key' => 'students', 'label' => 'Students', 'icon' => 'users', 'children' => [
            ['label' => 'All Students', 'route' => 'admin.liststudent'],
            ['label' => 'Add Student', 'route' => 'admin.addstudent'],
        ]],
        ['key' => 'admissions', 'label' => 'Admissions', 'icon' => 'file-text', 'badge' => 'approvals', 'badge_tone' => 'quiet', 'title' => 'Waiting for approval', 'route' => 'admin.listadmission'],
        ['key' => 'idcards', 'label' => 'ID Cards', 'icon' => 'user-check', 'route' => 'admin.listidcard'],
        ['key' => 'studentactivity', 'label' => 'Student Activity', 'icon' => 'activity', 'route' => 'admin.liststudentactivity'],

        ['caption' => 'Enquiries'],
        ['key' => 'enquiries', 'label' => 'Enquiries', 'icon' => 'inbox', 'badge' => 'enquiries', 'children' => [
            ['label' => 'Admission Enquiries', 'route' => 'admin.activity.leads', 'also' => ['admin.activity.lead']],
            ['label' => 'Contact Messages', 'route' => 'admin.listcontactform'],
            ['label' => 'Renewals', 'route' => 'admin.activity.renewals'],
        ]],

        ['caption' => 'Finance'],
        ['key' => 'payments', 'label' => 'Payments', 'icon' => 'credit-card', 'route' => 'admin.listpayment'],
        ['key' => 'dues', 'label' => 'Fees Due', 'icon' => 'alert-circle', 'badge' => 'pending_payments', 'badge_tone' => 'alert', 'title' => 'Overdue', 'route' => 'admin.reports.dues'],

        ['caption' => 'Insights'],
        ['key' => 'analytics', 'label' => 'Analytics', 'icon' => 'bar-chart-2', 'children' => [
            ['label' => 'Admission Analytics', 'route' => 'admin.activity.index'],
            ['label' => 'Website Activity', 'route' => 'admin.activity.events'],
        ]],
        ['key' => 'reports', 'label' => 'Reports & Exports', 'icon' => 'download', 'route' => 'admin.reports'],

        ['caption' => 'Academics'],
        ['key' => 'courses', 'label' => 'Courses', 'icon' => 'book-open', 'children' => [
            ['label' => 'Courses', 'route' => 'admin.listcourse'],
            ['label' => 'Categories', 'route' => 'admin.listcoursecategory'],
            ['label' => 'Sub Categories', 'route' => 'admin.listcoursesubcategory'],
            ['label' => 'Subjects', 'route' => 'admin.listsubjects', 'also' => ['admin.listsubject']],
            ['label' => 'Course Notes', 'route' => 'admin.listnotes', 'also' => ['admin.listfreenotes']],
        ]],

        ['caption' => 'Library'],
        ['key' => 'acts', 'label' => 'Acts', 'icon' => 'book', 'children' => [
            ['label' => 'Acts', 'route' => 'admin.listacts'],
            ['label' => 'Categories', 'route' => 'admin.listactcategories'],
            ['label' => 'Sub Categories', 'route' => 'admin.listactsubcategories'],
        ]],
        ['key' => 'rules', 'label' => 'Rules', 'icon' => 'shield', 'children' => [
            ['label' => 'Rules', 'route' => 'admin.listrules'],
            ['label' => 'Categories', 'route' => 'admin.listrulescategories'],
            ['label' => 'Sub Categories', 'route' => 'admin.listrulessubcategories'],
        ]],
        ['key' => 'govt', 'label' => 'Govt. Examination', 'icon' => 'award', 'children' => [
            ['label' => 'Examinations', 'route' => 'admin.listgovtexams'],
            ['label' => 'Categories', 'route' => 'admin.listgovtexamcategories'],
            ['label' => 'Sub Categories', 'route' => 'admin.listgovtexamsubcategories'],
        ]],
        ['key' => 'legal', 'label' => 'Legal Knowledge', 'icon' => 'layers', 'children' => [
            ['label' => 'Library', 'route' => 'admin.listlegalknowledgelibrary'],
            ['label' => 'Categories', 'route' => 'admin.listlegalknowledgelibrarycategories'],
            ['label' => 'Sub Categories', 'route' => 'admin.listlegalknowledgelibrarysubcategories'],
        ]],
        ['key' => 'copys', 'label' => 'Free Notes', 'icon' => 'edit', 'children' => [
            ['label' => 'Free Notes', 'route' => 'admin.listcopys'],
            ['label' => 'Categories', 'route' => 'admin.listcopyscategories'],
            ['label' => 'Sub Categories', 'route' => 'admin.listcopyssubcategories'],
        ]],

        ['caption' => 'Website'],
        ['key' => 'website', 'label' => 'Website Content', 'icon' => 'layout', 'children' => [
            ['label' => 'Banner', 'route' => 'admin.listbanner'],
            ['label' => 'Gallery', 'route' => 'admin.listgallery'],
            ['label' => 'Clients', 'route' => 'admin.listclientele'],
            ['label' => 'WhatsApp', 'route' => 'admin.whatsapp'],
            ['label' => 'Site Pages', 'route' => 'admin.listsitepages'],
        ]],

        ['caption' => 'Settings'],
        ['key' => 'settings', 'label' => 'Settings', 'icon' => 'settings', 'children' => [
            ['label' => 'Mail', 'route' => 'admin.mailsetting'],
            ['label' => 'Admin Profile', 'route' => 'admin.admindetails'],
            ['label' => 'Help & Guide', 'route' => 'admin.help'],
        ]],
    ],

    /*
     * "+ New" menu in the top bar: the things staff create most often.
     */
    'quick_create' => [
        ['label' => 'Student', 'icon' => 'user-plus', 'route' => 'admin.addstudent', 'hint' => 'Register + admission'],
        ['label' => 'Course subject', 'icon' => 'book-open', 'route' => 'admin.addsubject'],
        ['label' => 'Act', 'icon' => 'book', 'route' => 'admin.addacts'],
        ['label' => 'Rule', 'icon' => 'shield', 'route' => 'admin.addrules'],
        ['label' => 'Govt. examination', 'icon' => 'award', 'route' => 'admin.addgovtexams'],
        ['label' => 'Legal knowledge', 'icon' => 'layers', 'route' => 'admin.addlegalknowledgelibrary'],
        ['label' => 'Free note', 'icon' => 'edit', 'route' => 'admin.addcopys'],
        ['label' => 'Client', 'icon' => 'briefcase', 'route' => 'admin.addclientele'],
    ],

    /*
     * Content families that share the same list / add / edit shape. AdminPanel
     * expands each into page entries (title, breadcrumb, related buttons).
     *   [label, list route, add route, edit route]
     */
    'families' => [
        'acts' => [
            'label' => 'Acts',
            'levels' => [
                'item' => ['Acts', 'admin.listacts', 'admin.addacts', 'admin.editacts'],
                'category' => ['Act Categories', 'admin.listactcategories', 'admin.addactcategory', 'admin.editactcategory'],
                'sub' => ['Act Sub Categories', 'admin.listactsubcategories', 'admin.addactsubcategory', 'admin.editactsubcategory'],
            ],
        ],
        'rules' => [
            'label' => 'Rules',
            'levels' => [
                'item' => ['Rules', 'admin.listrules', 'admin.addrules', 'admin.editrules'],
                'category' => ['Rule Categories', 'admin.listrulescategories', 'admin.addrulescategory', 'admin.editrulescategory'],
                'sub' => ['Rule Sub Categories', 'admin.listrulessubcategories', 'admin.addrulessubcategory', 'admin.editrulessubcategory'],
            ],
        ],
        'govt' => [
            'label' => 'Govt. Examination',
            'levels' => [
                'item' => ['Examinations', 'admin.listgovtexams', 'admin.addgovtexams', 'admin.editgovtexams'],
                'category' => ['Examination Categories', 'admin.listgovtexamcategories', 'admin.addgovtexamcategory', 'admin.editgovtexamcategory'],
                'sub' => ['Examination Sub Categories', 'admin.listgovtexamsubcategories', 'admin.addgovtexamsubcategory', 'admin.editgovtexamsubcategory'],
            ],
        ],
        'legal' => [
            'label' => 'Legal Knowledge',
            'levels' => [
                'item' => ['Legal Knowledge Library', 'admin.listlegalknowledgelibrary', 'admin.addlegalknowledgelibrary', 'admin.editlegalknowledgelibrary'],
                'category' => ['Legal Knowledge Categories', 'admin.listlegalknowledgelibrarycategories', 'admin.addlegalknowledgelibrarycategory', 'admin.editlegalknowledgelibrarycategory'],
                'sub' => ['Legal Knowledge Sub Categories', 'admin.listlegalknowledgelibrarysubcategories', 'admin.addlegalknowledgelibrarysubcategory', 'admin.editlegalknowledgelibrarysubcategory'],
            ],
        ],
        'copys' => [
            'label' => 'Free Notes',
            'levels' => [
                'item' => ['Free Notes', 'admin.listcopys', 'admin.addcopys', 'admin.editcopys'],
                'category' => ['Free Note Categories', 'admin.listcopyscategories', 'admin.addcopyscategory', 'admin.editcopyscategory'],
                'sub' => ['Free Note Sub Categories', 'admin.listcopyssubcategories', 'admin.addcopyssubcategory', 'admin.editcopyssubcategory'],
            ],
        ],
    ],
];
