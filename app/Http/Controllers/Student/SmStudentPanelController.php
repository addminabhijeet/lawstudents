<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class SmStudentPanelController extends Controller
{
    public function studentDashboard()
    {
        return view('student.dashboard');
    }
}
