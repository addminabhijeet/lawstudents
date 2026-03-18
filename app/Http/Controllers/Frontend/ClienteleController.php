<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClienteleController extends Controller
{
    public function __invoke(): View
    {
        return view('clientele.clientele');
    }
}
