<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientele;
use Illuminate\View\View;

class ClienteleController extends Controller
{
    public function __invoke(): View
    {
        $clienteles = Clientele::all();

        return view('clientele.clientele', compact('clienteles'));
    }
}
