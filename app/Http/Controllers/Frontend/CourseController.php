<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function __invoke(): View
    {
        return view('course.course');
    }
}
