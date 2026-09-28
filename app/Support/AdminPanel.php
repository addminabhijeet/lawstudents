<?php

namespace App\Support;

use App\Models\AdmissionLead;
use App\Models\ContactForm;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentAdmission;
use App\Support\FeeDues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/**
 * Read-only description of the admin panel for the views: the sidebar menu, the
 * breadcrumb and "related actions" for the page being shown, and the quick links
 * between a student, their admission, payments and ID card.
 *
 * It only reads (routes, config/admin_panel.php and a few counts). It changes no
 * request, form or stored data, and nothing here replaces existing controller logic.
 */
class AdminPanel
{
    private ?array $pageCache = null;

    public function __construct(private Request $request)
    {
    }

    /* ------------------------------------------------------------------ */
    /*  Menu                                                               */
    /* ------------------------------------------------------------------ */

    /** Sidebar entries with URLs and the current page marked. */
    public function nav(): array
    {
        $current = $this->routeName();
        $page = $this->page();
        $active = array_values(array_filter([$current, $page['parent'] ?? null]));
        $badges = $this->badges();
        $out = [];

        foreach (config('admin_panel.nav', []) as $item) {
            if (isset($item['caption'])) {
                $out[] = ['caption' => $item['caption']];
                continue;
            }

            $row = [
                'key' => $item['key'],
                'label' => $item['label'],
                'icon' => $item['icon'],
                'badge' => isset($item['badge']) ? (int) ($badges[$item['badge']] ?? 0) : 0,
                'badge_tone' => $item['badge_tone'] ?? 'gold',
                'badge_title' => $item['title'] ?? 'New',
                'url' => null,
                'active' => false,
                'children' => [],
            ];

            if (isset($item['route'])) {
                $row['url'] = $this->url($item['route']);
                $row['active'] = $this->matches($item, $active);
            }

            foreach ($item['children'] ?? [] as $child) {
                $isActive = $this->matches($child, $active);
                $row['children'][] = [
                    'label' => $child['label'],
                    'url' => $this->url($child['route']),
                    'route' => $child['route'],
                    'active' => $isActive,
                ];
                $row['active'] = $row['active'] || $isActive;
            }

            $out[] = $row;
        }

        return $out;
    }

    /** Every reachable page as a flat list, for the search palette. */
    public function searchIndex(): array
    {
        $rows = [];
        foreach (config('admin_panel.nav', []) as $item) {
            if (isset($item['caption'])) {
                continue;
            }
            if (isset($item['route'])) {
                $rows[] = ['label' => $item['label'], 'group' => 'Pages', 'icon' => $item['icon'], 'url' => $this->url($item['route'])];
            }
            foreach ($item['children'] ?? [] as $child) {
                $rows[] = [
                    'label' => $child['label'] === 'All Students' ? 'Students' : $child['label'],
                    'group' => $item['label'],
                    'icon' => $item['icon'],
                    'url' => $this->url($child['route']),
                ];
            }
        }
        foreach (config('admin_panel.quick_create', []) as $item) {
            $rows[] = ['label' => 'Add '.strtolower($item['label']), 'group' => 'Create', 'icon' => 'plus', 'url' => $this->url($item['route'])];
        }

        return array_values(array_filter($rows, fn ($r) => $r['url']));
    }

    public function quickCreate(): array
    {
        $out = [];
        foreach (config('admin_panel.quick_create', []) as $item) {
            $url = $this->url($item['route']);
            if ($url) {
                $out[] = ['label' => $item['label'], 'icon' => $item['icon'], 'url' => $url, 'hint' => $item['hint'] ?? null];
            }
        }

        return $out;
    }

    /** Live counts shown as small badges (cached for a minute). */
    public function badges(): array
    {
        return Cache::remember('admin_panel.badges', 60, function () {
            $out = ['enquiries' => 0, 'messages' => 0, 'leads' => 0, 'pending_payments' => 0, 'approvals' => 0];
            try {
                $out['messages'] = (int) ContactForm::where('delete', 1)->where('created_at', '>=', now()->subDays(7))->count();
                $out['leads'] = (int) AdmissionLead::where('status', 'new')->count();
                $out['enquiries'] = $out['messages'] + $out['leads'];
                $out['pending_payments'] = (int) FeeDues::overdue()->count();
                $out['approvals'] = (int) StudentAdmission::where('deleted', 0)
                    ->where(fn ($q) => $q->whereNull('admission_status')->orWhere('admission_status', 'pending'))
                    ->count();
            } catch (\Throwable $e) {
                // a badge is never worth breaking a page for
            }

            return $out;
        });
    }

    /* ------------------------------------------------------------------ */
    /*  Current page                                                       */
    /* ------------------------------------------------------------------ */

    public function routeName(): ?string
    {
        return $this->request->route()?->getName();
    }

    /**
     * Title, kind, breadcrumb and buttons for the page being shown.
     * Unknown pages get a plain entry, so nothing breaks when a route is added later.
     */
    public function page(): array
    {
        if ($this->pageCache !== null) {
            return $this->pageCache;
        }

        $name = $this->routeName();
        $def = $this->definitions()[$name] ?? null;

        if (!$def) {
            return $this->pageCache = ['route' => $name, 'title' => null, 'kind' => 'other', 'crumbs' => [], 'actions' => [], 'related' => [], 'summary' => null];
        }

        $parent = $def['parent'] ?? null;
        $crumbs = [['label' => 'Dashboard', 'url' => $this->url('admin.dashboard')]];
        $group = $this->groupFor($parent ?: $name);
        $listTitle = $this->definitions()[$parent ?: $name]['title'] ?? '';
        if ($group && strcasecmp($group, $listTitle) !== 0 && strcasecmp($group, $def['title']) !== 0) {
            $crumbs[] = ['label' => $group, 'url' => null];
        }
        if ($parent && ($this->definitions()[$parent]['title'] ?? null)) {
            $crumbs[] = ['label' => $this->definitions()[$parent]['title'], 'url' => $this->url($parent)];
        }
        if ($name !== 'admin.dashboard') {
            $crumbs[] = ['label' => $def['title'], 'url' => null];
        }

        $actions = [];
        if (!empty($def['add'])) {
            $add = $this->url($def['add'][1]);
            if ($add) {
                $actions[] = ['label' => $def['add'][0], 'icon' => 'plus', 'url' => $add, 'primary' => true];
            }
        }
        foreach ($def['links'] ?? [] as $link) {
            $url = $this->url($link[2]);
            if ($url) {
                $actions[] = ['label' => $link[0], 'icon' => $link[1], 'url' => $url];
            }
        }
        if ($parent && ($def['back'] ?? true)) {
            $url = $this->url($parent);
            if ($url) {
                array_unshift($actions, ['label' => 'Back to '.strtolower($this->definitions()[$parent]['title'] ?? 'list'), 'icon' => 'arrow-left', 'url' => $url, 'back' => true]);
            }
        }

        $related = [];
        $summary = null;
        if (!empty($def['related']) && $this->request->route()?->parameter('id')) {
            $id = (int) $this->request->route()->parameter('id');
            $related = $this->related($def['related'], $id, $name);
            $summary = $this->summary($def['related'], $id);
        }

        return $this->pageCache = [
            'route' => $name,
            'title' => $def['title'],
            'subtitle' => $def['subtitle'] ?? null,
            'kind' => $def['kind'] ?? 'other',
            'crumbs' => $crumbs,
            'actions' => $actions,
            'related' => $related,
            'summary' => $summary,
        ];
    }

    /* ------------------------------------------------------------------ */
    /*  Related records: student <-> admission <-> payment <-> ID card     */
    /* ------------------------------------------------------------------ */

    /**
     * Links between the records of one student. `$type` is what `$id` identifies:
     * student, admission, payment or contact.
     */
    public function related(string $type, int $id, ?string $current = null): array
    {
        $student = null;
        $admission = null;
        $payment = null;
        $contact = null;

        try {
            if ($type === 'contact') {
                $contact = ContactForm::find($id);
            } elseif ($type === 'student') {
                $student = Student::find($id);
            } elseif ($type === 'admission') {
                $admission = StudentAdmission::find($id);
                $student = $admission ? Student::find($admission->student_id) : null;
            } elseif ($type === 'payment') {
                $payment = Payment::find($id);
                $student = $payment ? Student::find($payment->student_id) : null;
            }

            if ($contact) {
                return $this->contactLinks($contact);
            }
            if (!$student) {
                return [];
            }

            $admission ??= StudentAdmission::where('student_id', $student->id)->where('deleted', 0)->latest('id')->first();
            $payment ??= Payment::where('student_id', $student->id)->where('deleted', 0)->latest('id')->first();
            $latest = Payment::where('student_id', $student->id)->where('deleted', 0)->latest('id')->first() ?: $payment;
        } catch (\Throwable $e) {
            return [];
        }

        $items = [];
        $add = function (string $label, string $icon, ?string $route, $param, array $extra = []) use (&$items, $current) {
            if (!$route || $param === null) {
                return;
            }
            $url = $this->url($route, $param);
            if ($url) {
                $items[] = ['label' => $label, 'icon' => $icon, 'url' => $url, 'current' => $current === $route] + $extra;
            }
        };

        $add('Profile', 'user', 'admin.viewstudent', $student->id);
        $add('Edit student', 'edit-2', 'admin.editstudent', $student->id);
        $add('Admission', 'file-text', 'admin.showadmission', $admission?->id);
        $add('Edit admission', 'edit', 'admin.editadmission', $admission?->id);
        $add('Payment slip', 'credit-card', 'admin.viewpayment', $latest?->id, ['external' => true]);
        $add('Edit payment', 'dollar-sign', 'admin.editpayment', $latest?->id);
        if ($admission && $admission->admno) {
            $add('ID card', 'user-check', 'admin.viewidcard', $latest?->id);
        }
        $add('Learning activity', 'activity', 'admin.viewstudentactivity', $student->id);

        $email = $admission->email ?? $student->email ?? null;
        $phone = preg_replace('/\D+/', '', (string) ($admission->phone ?? ''));
        if ($email) {
            $items[] = ['label' => 'Email', 'icon' => 'mail', 'url' => 'mailto:'.$email, 'current' => false, 'contact' => true];
        }
        if (strlen($phone) === 10) {
            $items[] = ['label' => 'Call', 'icon' => 'phone', 'url' => 'tel:+91'.$phone, 'current' => false, 'contact' => true];
            $items[] = ['label' => 'WhatsApp', 'icon' => 'message-circle', 'url' => 'https://wa.me/91'.$phone, 'current' => false, 'contact' => true, 'external' => true];
        }
        if ($latest && $email) {
            $items[] = [
                'label' => 'Email payment slip', 'icon' => 'send', 'url' => $this->url('admin.sendpaymentmail', $latest->id), 'current' => false,
                'confirm' => 'Email the payment slip to '.$email.'?',
            ];
        }

        return $items;
    }

    /**
     * Who a student-related page is about: name, admission number and status, and the
     * latest invoice's paid / total. Null when the record cannot be found.
     */
    public function summary(string $type, int $id): ?array
    {
        try {
            $student = null;
            $admission = null;
            $payment = null;

            if ($type === 'student') {
                $student = Student::find($id);
            } elseif ($type === 'admission') {
                $admission = StudentAdmission::find($id);
                $student = $admission ? Student::find($admission->student_id) : null;
            } elseif ($type === 'payment') {
                $payment = Payment::find($id);
                $student = $payment ? Student::find($payment->student_id) : null;
            } elseif ($type === 'contact') {
                $contact = ContactForm::find($id);

                return $contact ? [
                    'name' => trim($contact->first_name.' '.$contact->last_name),
                    'username' => $contact->service_type ?: null,
                    'admno' => null,
                    'status' => null,
                    'fee' => null,
                ] : null;
            }
            if (!$student) {
                return null;
            }

            $admission ??= StudentAdmission::where('student_id', $student->id)->where('deleted', 0)->latest('id')->first();
            $latest = $payment ?: Payment::where('student_id', $student->id)->where('deleted', 0)->latest('id')->first();

            $status = $admission?->admission_status ?: 'pending';
            $tone = ['approved' => 'good', 'rejected' => 'bad'][$status] ?? 'warn';
            $fee = null;
            if ($latest && (float) $latest->grand_total > 0) {
                $total = (float) $latest->grand_total;
                $paid = min($total, (float) ($latest->paid_amount ?? 0));
                $fee = [
                    'label' => $type === 'payment' ? 'This invoice' : 'Latest invoice',
                    'paid' => self::inr($paid),
                    'total' => self::inr($total),
                    'due' => $total - $paid > 0.009 ? self::inr($total - $paid) : null,
                    'percent' => (int) round($paid / $total * 100),
                ];
            }

            return [
                'name' => $admission?->full_name ?: $student->name,
                'username' => $student->username,
                'admno' => $admission?->admno,
                'status' => ucfirst($status),
                'status_tone' => $tone,
                'fee' => $fee,
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }

    /** Rupees with Indian digit grouping: ₹12,66,395 */
    public static function inr(float $n): string
    {
        $n = round($n);
        $int = (string) abs((int) $n);
        $tail = substr($int, -3);
        $head = substr($int, 0, -3);
        $head = $head === '' ? '' : preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $head).',';

        return ($n < 0 ? '-' : '').'₹'.$head.$tail;
    }

    private function contactLinks(ContactForm $contact): array
    {
        $items = [];
        if ($contact->email) {
            $items[] = ['label' => 'Reply by email', 'icon' => 'mail', 'url' => 'mailto:'.$contact->email, 'current' => false, 'contact' => true];
        }
        $phone = preg_replace('/\D+/', '', (string) $contact->phone);
        if (strlen($phone) >= 10) {
            $ten = substr($phone, -10);
            $items[] = ['label' => 'Call', 'icon' => 'phone', 'url' => 'tel:+91'.$ten, 'current' => false, 'contact' => true];
            $items[] = ['label' => 'WhatsApp', 'icon' => 'message-circle', 'url' => 'https://wa.me/91'.$ten, 'current' => false, 'contact' => true, 'external' => true];
        }
        // a person who wrote in and is not yet a student: start their registration
        $items[] = ['label' => 'Register as student', 'icon' => 'user-plus', 'url' => $this->url('admin.addstudent'), 'current' => false];

        return $items;
    }

    /* ------------------------------------------------------------------ */
    /*  Internals                                                          */
    /* ------------------------------------------------------------------ */

    private function url(string $route, $param = null): ?string
    {
        if (!Route::has($route)) {
            return null;
        }
        try {
            return route($route, $param === null ? [] : [$param]);
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function matches(array $item, array $active): bool
    {
        if (isset($item['route']) && in_array($item['route'], $active, true)) {
            return true;
        }
        foreach ($item['also'] ?? [] as $route) {
            if (in_array($route, $active, true)) {
                return true;
            }
        }

        return false;
    }

    /** Menu group a route belongs to, for the breadcrumb ("Library", "Students"...). */
    private function groupFor(string $route): ?string
    {
        $caption = null;
        foreach (config('admin_panel.nav', []) as $item) {
            if (isset($item['caption'])) {
                $caption = $item['caption'];
                continue;
            }
            $routes = array_filter(array_merge(
                [$item['route'] ?? null],
                $item['also'] ?? [],
                array_map(fn ($c) => $c['route'], $item['children'] ?? []),
                array_merge(...array_map(fn ($c) => $c['also'] ?? [], $item['children'] ?? [[]]))
            ));
            if (in_array($route, $routes, true)) {
                return $caption === 'Overview' ? null : $caption;
            }
        }

        return null;
    }

    /**
     * Page definitions, keyed by route name.
     *   title, kind (dashboard|list|form|view|doc|other), parent (list route),
     *   add [label, route], links [[label, icon, route]], related (record type)
     */
    private function definitions(): array
    {
        static $defs = null;
        if ($defs !== null) {
            return $defs;
        }

        $defs = [
            'admin.dashboard' => ['title' => 'Dashboard', 'kind' => 'dashboard'],

            // students and admissions
            'admin.liststudent' => ['title' => 'Students', 'kind' => 'list', 'add' => ['Add Student', 'admin.addstudent'],
                'links' => [['Admissions', 'file-text', 'admin.listadmission'], ['ID Cards', 'user-check', 'admin.listidcard']]],
            'admin.addstudent' => ['title' => 'Add Student', 'kind' => 'form', 'parent' => 'admin.liststudent'],
            'admin.editstudent' => ['title' => 'Edit Student', 'kind' => 'form', 'parent' => 'admin.liststudent', 'related' => 'student'],
            'admin.viewstudent' => ['title' => 'Student Profile', 'kind' => 'view', 'parent' => 'admin.liststudent', 'related' => 'student'],
            'admin.listadmission' => ['title' => 'Admissions', 'kind' => 'list', 'add' => ['New Admission', 'admin.addstudent'],
                'links' => [['Payments', 'credit-card', 'admin.listpayment'], ['ID Cards', 'user-check', 'admin.listidcard']]],
            'admin.showadmission' => ['title' => 'Admission Details', 'kind' => 'view', 'parent' => 'admin.listadmission', 'related' => 'admission'],
            'admin.editadmission' => ['title' => 'Edit Admission', 'kind' => 'form', 'parent' => 'admin.listadmission', 'related' => 'admission'],
            'admin.listidcard' => ['title' => 'ID Cards', 'kind' => 'list',
                'links' => [['Admissions', 'file-text', 'admin.listadmission'], ['Students', 'users', 'admin.liststudent']]],
            'admin.viewidcard' => ['title' => 'ID Card', 'kind' => 'doc', 'parent' => 'admin.listidcard', 'related' => 'payment'],
            'admin.liststudentactivity' => ['title' => 'Student Activity', 'kind' => 'list',
                'links' => [['Students', 'users', 'admin.liststudent']]],
            'admin.viewstudentactivity' => ['title' => 'Learning Activity', 'kind' => 'view', 'parent' => 'admin.liststudentactivity', 'related' => 'student'],

            // finance
            'admin.listpayment' => ['title' => 'Payments', 'kind' => 'list',
                'links' => [['Students', 'users', 'admin.liststudent'], ['Admissions', 'file-text', 'admin.listadmission'], ['ID Cards', 'user-check', 'admin.listidcard']]],
            'admin.addpayment' => ['title' => 'Add Payment', 'kind' => 'other', 'parent' => 'admin.listpayment'],
            'admin.reports.dues' => ['title' => 'Fees Due', 'kind' => 'list',
                'links' => [['Payments', 'credit-card', 'admin.listpayment'], ['Reports & exports', 'download', 'admin.reports']]],
            'admin.reports' => ['title' => 'Reports & Exports', 'kind' => 'other',
                'links' => [['Fees due', 'alert-circle', 'admin.reports.dues']]],
            'admin.editpayment' => ['title' => 'Edit Payment', 'kind' => 'form', 'parent' => 'admin.listpayment', 'related' => 'payment'],

            // enquiries
            'admin.listcontactform' => ['title' => 'Contact Messages', 'kind' => 'list',
                'links' => [['Admission enquiries', 'phone-call', 'admin.activity.leads']]],
            'admin.viewcontactform' => ['title' => 'Message', 'kind' => 'view', 'parent' => 'admin.listcontactform', 'related' => 'contact'],

            // courses
            'admin.listcourse' => ['title' => 'Courses', 'kind' => 'list',
                'links' => [['Categories', 'folder', 'admin.listcoursecategory'], ['Sub categories', 'folder-plus', 'admin.listcoursesubcategory'], ['Subjects', 'book-open', 'admin.listsubjects'], ['Notes', 'file', 'admin.listnotes']]],
            'admin.listcoursecategory' => ['title' => 'Course Categories', 'kind' => 'list',
                'links' => [['Courses', 'book-open', 'admin.listcourse'], ['Sub categories', 'folder-plus', 'admin.listcoursesubcategory']]],
            'admin.listcoursesubcategory' => ['title' => 'Course Sub Categories', 'kind' => 'list',
                'links' => [['Courses', 'book-open', 'admin.listcourse'], ['Categories', 'folder', 'admin.listcoursecategory']]],
            'admin.listsubjects' => ['title' => 'Course Subjects', 'kind' => 'list', 'add' => ['Add Subject', 'admin.addsubject'],
                'links' => [['Courses', 'book-open', 'admin.listcourse'], ['Notes', 'file', 'admin.listnotes']]],
            'admin.addsubject' => ['title' => 'Add Subject', 'kind' => 'form', 'parent' => 'admin.listsubjects'],
            'admin.editsubject' => ['title' => 'Edit Subject', 'kind' => 'form', 'parent' => 'admin.listsubjects'],
            'admin.listsubject' => ['title' => 'Subjects', 'kind' => 'list',
                'links' => [['Courses', 'book-open', 'admin.listcourse'], ['Notes', 'file', 'admin.listnotes']]],
            'admin.listnotes' => ['title' => 'Course Notes', 'kind' => 'list',
                'links' => [['Courses', 'book-open', 'admin.listcourse'], ['Subjects', 'layers', 'admin.listsubjects']]],
            'admin.listfreenotes' => ['title' => 'Free Course Notes', 'kind' => 'list', 'parent' => 'admin.listnotes', 'back' => false,
                'links' => [['Course notes', 'file', 'admin.listnotes']]],
            'admin.viewnote' => ['title' => 'Note', 'kind' => 'view', 'parent' => 'admin.listnotes'],
            'admin.editcourse' => ['title' => 'Edit Course', 'kind' => 'form', 'parent' => 'admin.listcourse'],
            'admin.editCategory' => ['title' => 'Edit Category', 'kind' => 'form', 'parent' => 'admin.listcoursecategory'],

            // website
            'admin.listbanner' => ['title' => 'Banner', 'kind' => 'other'],
            'admin.listgallery' => ['title' => 'Gallery', 'kind' => 'list'],
            'admin.editgallery' => ['title' => 'Edit Gallery Item', 'kind' => 'form', 'parent' => 'admin.listgallery'],
            'admin.listclientele' => ['title' => 'Clients', 'kind' => 'list', 'add' => ['Add Client', 'admin.addclientele']],
            'admin.addclientele' => ['title' => 'Add Client', 'kind' => 'form', 'parent' => 'admin.listclientele'],
            'admin.editclientele' => ['title' => 'Edit Client', 'kind' => 'form', 'parent' => 'admin.listclientele'],
            'admin.whatsapp' => ['title' => 'WhatsApp Number', 'kind' => 'form'],
            'admin.listsitepages' => ['title' => 'Site Pages', 'kind' => 'list'],
            'admin.editsitepage' => ['title' => 'Edit Site Page', 'kind' => 'form', 'parent' => 'admin.listsitepages'],

            // settings
            'admin.help' => ['title' => 'Help & Guide', 'kind' => 'other'],
            'admin.mailsetting' => ['title' => 'Mail Settings', 'kind' => 'form'],
            'admin.admindetails' => ['title' => 'Admin Profile', 'kind' => 'form'],

            // analytics (these pages draw their own heading; only the breadcrumb is used)
            'admin.activity.index' => ['title' => 'Admission Analytics', 'kind' => 'custom'],
            'admin.activity.events' => ['title' => 'Website Activity', 'kind' => 'custom'],
            'admin.activity.leads' => ['title' => 'Admission Enquiries', 'kind' => 'custom'],
            'admin.activity.lead' => ['title' => 'Enquiry', 'kind' => 'custom', 'parent' => 'admin.activity.leads'],
            'admin.activity.renewals' => ['title' => 'Renewals', 'kind' => 'custom'],
        ];

        // library families: acts, rules, govt exams, legal knowledge, free notes
        foreach (config('admin_panel.families', []) as $family) {
            $levels = $family['levels'];
            foreach ($levels as $key => [$label, $list, $add, $edit]) {
                $siblings = [];
                foreach ($levels as $otherKey => [$otherLabel, $otherList]) {
                    if ($otherKey !== $key) {
                        $siblings[] = [$otherLabel, $otherKey === 'item' ? 'file-text' : 'folder', $otherList];
                    }
                }
                $singular = match ($key) {
                    'item' => 'Item',
                    'category' => 'Category',
                    default => 'Sub Category',
                };
                $defs[$list] = ['title' => $label, 'kind' => 'list', 'add' => ['Add '.$singular, $add], 'links' => $siblings];
                $defs[$add] = ['title' => 'Add '.$singular.' · '.$family['label'], 'kind' => 'form', 'parent' => $list];
                $defs[$edit] = ['title' => 'Edit '.$singular.' · '.$family['label'], 'kind' => 'form', 'parent' => $list];
            }
        }

        return $defs;
    }
}
