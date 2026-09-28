<?php

namespace App\Providers;

use App\Support\StudentPanel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Feeds the student panel's shared views (menu, page bar, bell, learning summary)
 * through view composers, so no existing controller has to change.
 */
class StudentPanelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // the menu / header shell every student page includes
        View::composer('layouts.partials.student.dashboard', function ($view) {
            $panel = app(StudentPanel::class);
            $view->with('sp', [
                'nav' => $panel->nav(),
                'page' => $panel->page(),
                'index' => $panel->searchIndex(),
                'alerts' => $panel->alerts(),
                'office' => StudentPanel::office(),
            ]);
        });

        // the dashboard's learning summary sits beside the overview the earlier layer adds
        View::composer('dashboard.student', function ($view) {
            $view->with('studentLearning', app(StudentPanel::class)->learning());
        });

        // The Courses page, while this month's fee is unpaid, is only a notice. Name the
        // courses the student is enrolled in (titles only, no material) and the way forward.
        View::composer('coursestu.list', function ($view) {
            if (!($view->getData()['notFound'] ?? false) || !auth('student')->check()) {
                return;
            }
            try {
                $admission = \App\Models\StudentAdmission::where('deleted', 0)
                    ->where('student_id', auth('student')->id())->first();
                $titles = $admission ? $admission->courses->pluck('title')->filter()->values()->all() : [];
            } catch (\Throwable $e) {
                $titles = [];
            }
            $view->with('lockedInfo', ['titles' => $titles, 'month' => now()->format('F Y')]);
        });

        // A blank admission status is shown as "Rejected" by the admission page's own
        // if / else, while the dashboard says "Under review". Show the same word on both:
        // the value is filled in for display only and is never saved.
        View::composer('admissionstu.view', function ($view) {
            $admission = $view->getData()['admission'] ?? null;
            if ($admission && blank($admission->admission_status)) {
                $admission->admission_status = 'pending';
            }
        });
    }
}
