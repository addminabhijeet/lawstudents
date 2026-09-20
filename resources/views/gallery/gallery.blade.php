@extends('layouts.landing', ['title' => 'Gallery — Law Students'])

@section('meta_description', 'Glimpses of our campus, events, and learning environment.')

@section('content')
<section class="page-hero">
    <div class="wrap">
        <h1>Gallery</h1>
        <nav class="crumbs" aria-label="Breadcrumb">
            <a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true">›</span><span
                aria-current="page">Gallery</span>
        </nav>
    </div>
</section>

<section class="section gallery-section" id="gallery">
    <div class="wrap">
        <div class="section-head reveal">
            <span class="eyebrow">Gallery</span>
            <h2 class="section-title">Our <span class="accent">Gallery</span></h2>
            <p class="section-sub">Glimpses of our campus, events, and learning environment</p>
            <div class="title-rule"></div>
        </div>

        @php
            // One album per group_name, in the order the controller returned them.
            $albums = $gallery->groupBy('group_name');
        @endphp

        <div class="gallery-grid">
            @foreach ($albums as $groupName => $photos)
                @php
                    $urls = $photos
                        ->pluck('image')
                        ->filter()
                        ->map(fn($img) => asset('storage/app/public/' . $img))
                        ->values();
                @endphp
                @continue($urls->isEmpty())
                <a href="{{ $urls->first() }}" class="album reveal" data-d="{{ $loop->iteration }}"
                    data-title="{{ $groupName }}" data-imgs="{{ $urls->implode('|') }}">
                    <div class="album-imgs {{ $urls->count() === 1 ? 'single' : '' }}">
                        @foreach ($urls->take(2) as $url)
                            <img src="{{ $url }}" alt="{{ $groupName }}" loading="lazy" decoding="async">
                        @endforeach
                    </div>
                    <div class="album-body">
                        <h4>{{ $groupName }}</h4>
                        <span>{{ $urls->count() }} {{ Str::plural('Photo', $urls->count()) }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Photo viewer" aria-hidden="true">
    <button type="button" class="lb-btn lb-close" aria-label="Close">×</button>
    <button type="button" class="lb-btn lb-prev" aria-label="Previous photo">‹</button>
    <img alt="">
    <button type="button" class="lb-btn lb-next" aria-label="Next photo">›</button>
    <p class="lb-cap"></p>
</div>
@endsection
