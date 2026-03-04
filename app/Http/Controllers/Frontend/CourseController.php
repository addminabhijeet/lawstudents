<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Course;

class CourseController extends Controller
{
    public function __invoke(): View
    {
        // Only fetch courses (no categories)
        $courses = Course::where('status', 1)
            ->where('is_free', 1)
            ->whereHas('notes', function ($query) {
                $query->where('visibility', 'free')
                    ->where('status', 1);
            })
            ->get();

        return view('course.course', compact('courses'));
    }
}