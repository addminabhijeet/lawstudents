<?php

namespace App\Support;

use App\Models\Course;
use App\Models\CourseNote;
use App\Models\NoteProgress;
use App\Models\NoteWishlist;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Read-only description of the student panel for the views: the menu, the page title
 * bar, a status strip that says who the page is about, the bell, and the learning
 * summary on the dashboard. It works with the student's own records only and changes
 * nothing. The numbers come from StudentDashboard, so every panel says the same thing.
 */
class StudentPanel
{
    private ?array $summaryCache = null;
    private ?array $pageCache = null;

    public function __construct(private Request $request)
    {
    }

    public function student(): ?Student
    {
        return auth('student')->user();
    }

    /** What the dashboard works out (one call per request). */
    public function overview(): ?array
    {
        if ($this->summaryCache !== null) {
            return $this->summaryCache ?: null;
        }
        $student = $this->student();
        if (!$student) {
            $this->summaryCache = [];

            return null;
        }
        try {
            $this->summaryCache = StudentDashboard::for($student);
        } catch (\Throwable $e) {
            report($e);
            $this->summaryCache = [];
        }

        return $this->summaryCache ?: null;
    }

    public function routeName(): ?string
    {
        return $this->request->route()?->getName();
    }

    /* ------------------------------------------------------------------ */
    /*  Menu                                                               */
    /* ------------------------------------------------------------------ */

    public function nav(): array
    {
        $current = $this->routeName();
        $badges = $this->badges();
        $out = [];

        foreach (config('student_panel.nav', []) as $item) {
            if (isset($item['caption'])) {
                $out[] = ['caption' => $item['caption']];
                continue;
            }
            $badge = isset($item['badge']) ? ($badges[$item['badge']] ?? null) : null;
            $row = [
                'key' => $item['key'], 'label' => $item['label'], 'icon' => $item['icon'],
                'url' => isset($item['route']) ? $this->url($item['route']) : null,
                'active' => false, 'children' => [],
                'badge' => $badge['text'] ?? null, 'badge_tone' => $badge['tone'] ?? 'gold', 'badge_title' => $badge['title'] ?? '',
            ];
            if (isset($item['route'])) {
                $row['active'] = $current === $item['route'] || in_array($current, $item['also'] ?? [], true);
            }
            foreach ($item['children'] ?? [] as $child) {
                $on = $current === $child['route'];
                $row['children'][] = ['label' => $child['label'], 'url' => $this->url($child['route']), 'active' => $on];
                $row['active'] = $row['active'] || $on;
            }
            $out[] = $row;
        }

        return $out;
    }

    /** Short status words shown beside menu items. */
    public function badges(): array
    {
        $o = $this->overview();
        if (!$o) {
            return [];
        }
        $out = [];
        $pay = $o['cards']['payment'][1] ?? null;
        if ($pay === 'alert') {
            $out['fees'] = ['text' => 'Due', 'tone' => 'alert', 'title' => $o['cards']['payment'][2] ?? ''];
        } elseif ($pay === 'wait') {
            $out['fees'] = ['text' => 'Part', 'tone' => 'quiet', 'title' => $o['cards']['payment'][2] ?? ''];
        }
        if (($o['openCourses'] ?? 0) === 0) {
            $out['courses'] = ['text' => 'Locked', 'tone' => 'quiet', 'title' => 'Opens when this month\'s fee is paid'];
        }
        if ($o['idCardReady'] ?? false) {
            $out['idcard'] = ['text' => 'Ready', 'tone' => 'gold', 'title' => 'Your ID card is ready'];
        }

        return $out;
    }

    public function searchIndex(): array
    {
        $rows = [];
        foreach (config('student_panel.nav', []) as $item) {
            if (isset($item['caption'])) {
                continue;
            }
            if (isset($item['route']) && ($u = $this->url($item['route']))) {
                $rows[] = ['label' => $item['label'], 'group' => 'Pages', 'icon' => $item['icon'], 'url' => $u];
            }
            foreach ($item['children'] ?? [] as $child) {
                if ($u = $this->url($child['route'])) {
                    $rows[] = ['label' => $child['label'], 'group' => $item['label'], 'icon' => $item['icon'], 'url' => $u];
                }
            }
        }

        return $rows;
    }

    /* ------------------------------------------------------------------ */
    /*  Bell: what needs the student's attention                           */
    /* ------------------------------------------------------------------ */

    public function alerts(): array
    {
        $o = $this->overview();
        if (!$o) {
            return ['count' => 0, 'items' => []];
        }
        $map = [
            'admission' => ['file-text', 'Admission', route('student.viewadmission')],
            'payment' => ['credit-card', 'Fees', route('student.fees')],
            'idcard' => ['user-check', 'ID card', route('student.viewidcard')],
        ];
        $items = [];
        $count = 0;
        foreach ($map as $key => [$icon, $label, $url]) {
            [$text, $state, $detail] = $o['cards'][$key];
            if (in_array($state, ['done', 'info'], true)) {
                continue;
            }
            if (in_array($state, ['alert', 'todo'], true) && $key !== 'idcard') {
                $count++;
            }
            $items[] = ['icon' => $icon, 'label' => $label, 'text' => $text, 'detail' => $detail, 'state' => $state, 'url' => $url];
        }

        return ['count' => $count, 'items' => $items];
    }

    /* ------------------------------------------------------------------ */
    /*  Current page                                                       */
    /* ------------------------------------------------------------------ */

    public function page(): array
    {
        if ($this->pageCache !== null) {
            return $this->pageCache;
        }
        $name = $this->routeName();
        $def = config('student_panel.pages')[$name] ?? null;
        if (!$def) {
            return $this->pageCache = ['route' => $name, 'title' => null, 'kind' => 'other', 'crumbs' => [], 'actions' => [], 'related' => [], 'summary' => null];
        }

        // a course page is titled with the course (the controller has already checked access)
        if ($name === 'student.viewcourse') {
            try {
                $def['title'] = Course::where('id', (int) $this->request->route('id'))->value('title') ?: $def['title'];
            } catch (\Throwable $e) {
                // keep the generic title
            }
        }

        $crumbs = [['label' => 'Dashboard', 'url' => $this->url('student.dashboard')]];
        if (!empty($def['group'])) {
            $crumbs[] = ['label' => $def['group'], 'url' => null];
        }
        if (!empty($def['parent'])) {
            $crumbs[] = ['label' => config('student_panel.pages')[$def['parent']]['title'] ?? '', 'url' => $this->url($def['parent'])];
        }
        if ($name !== 'student.dashboard') {
            $crumbs[] = ['label' => $def['title'], 'url' => null];
        }

        $actions = [];
        foreach ($def['links'] ?? [] as [$label, $icon, $route]) {
            if ($u = $this->url($route)) {
                $actions[] = ['label' => $label, 'icon' => $icon, 'url' => $u];
            }
        }

        $related = [];
        $summary = null;
        if (($def['kind'] ?? '') !== 'dashboard') {
            foreach (config('student_panel.jump', []) as [$label, $icon, $route]) {
                if ($u = $this->url($route)) {
                    $related[] = ['label' => $label, 'icon' => $icon, 'url' => $u, 'current' => $name === $route || ($name === 'student.viewcourse' && $route === 'student.listcourse')];
                }
            }
            $summary = $this->summary();
        }

        return $this->pageCache = [
            'route' => $name, 'title' => $def['title'], 'kind' => $def['kind'] ?? 'other',
            'crumbs' => $crumbs, 'actions' => $actions, 'related' => $related, 'summary' => $summary,
            'related_label' => 'My records',
        ];
    }

    /** Who this is and where they stand: name, numbers, admission status, current invoice. */
    public function summary(): ?array
    {
        $o = $this->overview();
        if (!$o) {
            return null;
        }
        $admission = $o['cards']['admission'];
        $tone = ['done' => 'good', 'alert' => 'bad'][$admission[1]] ?? 'warn';
        $fee = null;
        try {
            $latest = Payment::where('student_id', $this->student()->id)->latest()->first();
            if ($latest && (float) $latest->grand_total > 0) {
                $total = (float) $latest->grand_total;
                $paid = min($total, (float) ($latest->paid_amount ?? 0));
                $fee = [
                    'label' => 'Latest invoice', 'paid' => AdminPanel::inr($paid), 'total' => AdminPanel::inr($total),
                    'due' => $total - $paid > 0.009 ? AdminPanel::inr($total - $paid) : null, 'percent' => (int) round($paid / $total * 100),
                ];
            }
        } catch (\Throwable $e) {
            report($e);
        }

        return [
            'name' => $o['name'], 'username' => $o['registrationNo'], 'admno' => $o['admissionNo'],
            'status' => $admission[0], 'status_tone' => $tone, 'fee' => $fee,
        ];
    }

    /* ------------------------------------------------------------------ */
    /*  Learning summary for the dashboard                                 */
    /* ------------------------------------------------------------------ */

    public function learning(): array
    {
        $empty = ['favourites' => 0, 'started' => 0, 'average' => 0, 'recent' => []];
        $student = $this->student();
        if (!$student) {
            return $empty;
        }
        try {
            $progress = NoteProgress::where('student_id', $student->id)->where('total_pages', '>', 0)->latest('updated_at')->get();
            $unlocked = Payment::where('student_id', $student->id)->where('payment_status', 'paid')->pluck('course_id')
                ->flatMap(fn ($ids) => explode(',', (string) $ids))->map(fn ($i) => (int) $i)->filter()->unique()->all();

            $notes = CourseNote::whereIn('id', $progress->take(12)->pluck('note_id'))->pluck('title', 'id');
            $courses = Course::whereIn('id', $progress->pluck('course_id')->filter()->unique())->pluck('title', 'id');

            $recent = $progress->filter(fn ($p) => isset($notes[$p->note_id]))->take(3)->map(fn ($p) => [
                'title' => $notes[$p->note_id],
                'course' => $courses[$p->course_id] ?? '',
                'percent' => (int) min(100, round($p->progress_percent)),
                'url' => in_array((int) $p->course_id, $unlocked, true) ? route('student.viewcourse', $p->course_id) : null,
            ])->values()->all();

            return [
                'favourites' => NoteWishlist::where('student_id', $student->id)->count(),
                'started' => $progress->count(),
                'average' => $progress->count() ? (int) round($progress->avg('progress_percent')) : 0,
                'recent' => $recent,
            ];
        } catch (\Throwable $e) {
            report($e);

            return $empty;
        }
    }

    /* ------------------------------------------------------------------ */

    /** The office's contact details, from the same settings the website footer uses. */
    public static function office(): array
    {
        $u = \App\Models\User::first();
        $wa = null;
        try {
            $wa = \App\Models\WhatsappSetting::first();
        } catch (\Throwable $e) {
            // optional
        }
        $digits = preg_replace('/\D+/', '', (string) ($wa->whatsapp_number ?? ''));

        return [
            'email' => !empty($u->webemail) ? $u->webemail : 'lawstudents.edu@gmail.com',
            'phone' => !empty($u->mobile) ? $u->mobile : '+916624536320',
            'address' => $u->webaddress ?? null,
            'centres' => array_values(array_filter([$u->centerone ?? null, $u->centertwo ?? null])),
            'whatsapp' => strlen($digits) >= 10 ? (strlen($digits) === 10 ? '91'.$digits : $digits) : null,
        ];
    }

    private function url(string $route): ?string
    {
        if (!Route::has($route)) {
            return null;
        }
        try {
            return route($route);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
