{{-- Shown for any address that doesn't exist, in the site's own layout (Laravel
     uses errors/404 automatically). Nothing here needs a matched route. --}}
@extends('layouts.landing', ['title' => 'Page not found — Law Students'])

@section('meta_description', 'This page could not be found on the Law Students website.')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/theme/css/not-found.css') }}?v={{ @filemtime(public_path('assets/theme/css/not-found.css')) }}">
@endsection

@section('content')
@php
    $nfLinks = [
        'Courses' => route('frontend.course'),
        'Free Notes' => route('frontend.copys'),
        'Bare Acts' => route('frontend.acts'),
        'Rules' => route('frontend.rules'),
        'Govt. Exams' => route('frontend.govtexams'),
        'Legal Knowledge Library' => route('frontend.legalknowledgelibrary'),
        'About Us' => route('frontend.about'),
        'Contact Us' => route('frontend.contact'),
    ];
@endphp
<section class="page-hero">
    <div class="hero-frame" aria-hidden="true"></div>
    <div class="wrap">
        <h1>Page not found</h1>
        <nav class="crumbs" aria-label="Breadcrumb">
            <a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true"><span class="site-icon icon-chevron-right" aria-hidden="true"></span></span><span
                aria-current="page">Page not found</span>
        </nav>
    </div>
</section>

<section class="section" id="not-found">
    <div class="wrap">
        <div class="nf-card">
            <p class="nf-code" aria-hidden="true">404</p>
            <h2>We couldn’t find that page</h2>
            <p class="nf-text">The address may be mistyped, or the page may have moved or been removed.</p>
            <div class="nf-actions">
                <a class="btn btn-gold" href="{{ route('frontend.home') }}">Go to the home page</a>
                <a class="btn btn-line" href="{{ route('frontend.sitemap') }}">See every page</a>
            </div>
        </div>

        <h2 class="nf-more">Or go straight to</h2>
        <ul class="nf-links">
            @foreach ($nfLinks as $nfLabel => $nfUrl)
                <li><a href="{{ $nfUrl }}">{{ $nfLabel }}<span class="site-icon icon-chevron-right" aria-hidden="true"></span></a></li>
            @endforeach
        </ul>
    </div>
</section>
@endsection
