<?php

namespace App\Providers;

use App\Support\AdminDashboard;
use App\Support\AdminPanel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Feeds the admin panel's shared views (menu, breadcrumb, related buttons, dashboard
 * figures) through view composers, so no existing controller has to change.
 */
class AdminPanelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // the menu / header shell that every admin page includes
        View::composer('layouts.partials.admin.dashboard', function ($view) {
            $panel = app(AdminPanel::class);
            $view->with('ap', [
                'nav' => $panel->nav(),
                'page' => $panel->page(),
                'create' => $panel->quickCreate(),
                'index' => $panel->searchIndex(),
                'badges' => $panel->badges(),
            ]);
        });

        // extra dashboard figures around the counts the route already passes
        View::composer('dashboard.admin', function ($view) {
            $view->with('dash', app(AdminDashboard::class)->build());
        });
    }
}
