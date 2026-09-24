<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SitePage;
use Illuminate\Http\Request;

class SitePageController extends Controller
{
    /**
     * Display a site page (Privacy Policy, Terms, Disclaimer, Refund Policy)
     */
    public function show($slug)
    {
        $page = SitePage::where('slug', $slug)->firstOrFail();

        // Build page title
        $pageTitle = $page->title;

        return view('pages.site-page', [
            'pageTitle' => $pageTitle,
            'page' => $page,
        ]);
    }
}
