<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class BaseApiController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        // Middleware can be applied here
    }
}
