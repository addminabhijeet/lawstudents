<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Banner;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $banner = Banner::active()->get();
        return view('home.home', compact('banner'));
    }
}
