@extends('layouts.landing', ['title' => $pageTitle . ' — Law Students'])

@section('meta_description', trim($__env->yieldContent('doc_description')) ?: $pageTitle . ' — Law Students.')

@section('content')
<section class="page-hero">
    <div class="hero-frame" aria-hidden="true"></div>
    <div class="wrap">
        <h1>{{ $pageTitle }}</h1>
        <nav class="crumbs" aria-label="Breadcrumb">
            <a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true"><span class="site-icon icon-chevron-right" aria-hidden="true"></span></span><span
                aria-current="page">{{ $pageTitle }}</span>
        </nav>
    </div>
</section>

<section class="section" id="site-info">
    <div class="wrap">
        @yield('doc')
    </div>
</section>
@endsection
