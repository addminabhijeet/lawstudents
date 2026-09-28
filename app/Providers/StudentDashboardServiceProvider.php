<?php

namespace App\Providers;

use App\Support\StudentDashboard;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Student dashboard layer. The dashboard's cards said Yes / No, and three of them
 * disagreed with the pages they open (Admission "Yes" while under review, Payment
 * "Yes" while My Courses asks for this month's fee, ID Card "No" while the ID Card
 * page shows a card). The cards now read from App\Support\StudentDashboard, which
 * uses those pages' own rules, and the overview above them (dashboard-extras) gets
 * its data here. The controller, the rules and the Blade files are unchanged: a
 * composer runs after the controller and replaces only the values it displays.
 */
class StudentDashboardServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('dashboard.student', function ($view) {
            $student = auth('student')->user();
            if (! $student) {
                return;
            }

            $summary = StudentDashboard::for($student);
            foreach ($summary['cards'] as $key => $card) {
                $view->with($key, $card[0]);
            }
            $view->with('studentDashboard', $summary);
        });
    }
}
