<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;

class SmParentPanelController extends Controller
{
    public function ParentDashboard()
    {
        return view('parent.dashboard');
    }

    public function myChildren($id)
    {
        return view('parent.children', compact('id'));
    }
}
