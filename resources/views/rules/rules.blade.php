@extends('layouts.landing', ['title' => 'Rules — Law Students'])

@section('meta_description', 'Browse Rules by category and search by keyword.')
{{-- Rules page layer, loaded after every other sheet. --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/theme/css/rules.css') }}?v={{ filemtime(public_path('assets/theme/css/rules.css')) }}">
@endsection

@section('content')
{{-- Only what the admin panel lists as active (delete = 1), as the site's own search does. --}}
@php $categories = $categories->where('delete', 1)->each(fn($cat) => $cat->setRelation('subcategories', $cat->subcategories->where('delete', 1)->each(fn($sub) => $sub->setRelation('rules', $sub->rules->where('delete', 1)->values()))->values()))->values(); @endphp
{{-- Page count and size of every file listed (App\Support\PdfInfo); rules.js labels them. --}}
@php $rulePdfInfo = []; foreach ($categories as $pdfCat) { foreach ($pdfCat->subcategories as $pdfSub) { foreach ($pdfSub->rules as $pdfRule) { foreach (($pdfRule->pdfs ?? []) as $pdfPath) { $rulePdfInfo[$pdfPath] = \App\Support\PdfInfo::describe($pdfPath); } } } } $ruleHasSummaries = collect($rulePdfInfo)->contains(fn($i) => $i && $i['pages'] !== null && $i['pages'] <= 2); @endphp
<section class="page-hero">
    <div class="hero-frame" aria-hidden="true"></div>
    <div class="wrap">
        <h1>Rules</h1>
        <nav class="crumbs" aria-label="Breadcrumb">
            <a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true"><span class="site-icon icon-chevron-right" aria-hidden="true"></span></span><span
                aria-current="page">Rules</span>
        </nav>
    </div>
</section>

<x-page-intro page="rules" />

<section class="section rules-section" id="rules">
    <div class="wrap" data-filter="list">
        <div class="section-head reveal">
            <span class="eyebrow">Rules</span>
            <h2 class="section-title">Find Your <span class="accent">Rule</span></h2>
            <p class="section-sub">Filter by category or search by keywords</p>
            <div class="title-rule"></div>
        </div>

        <div class="filter-bar">
            <div class="filter-field">
                <label id="lbl-cat">Rule Category</label>
                <div class="dd">
                    <button type="button" class="dd-btn" aria-haspopup="listbox" aria-expanded="false"
                        aria-labelledby="lbl-cat" data-all-label="All Categories">
                        <span class="dd-label">All Categories</span><span class="chev" aria-hidden="true"><span class="site-icon icon-chevron-down" aria-hidden="true"></span></span>
                    </button>
                    <ul class="dd-menu" role="listbox" aria-labelledby="lbl-cat">
                        <li role="option" data-value="all" aria-selected="true">All Rules</li>
                        @foreach ($categories as $category)
                            <li role="option" data-value="{{ $category->id }}" aria-selected="false">
                                {{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="filter-field field">
                <label for="quick-search">Quick Search</label>
                <input type="search" id="quick-search" placeholder="Search Rules..." autocomplete="off">
            </div>
        </div>
        @if ($ruleHasSummaries)
            <p class="rules-note">Files marked “Summary” are 1–2 page study notes, not official texts. Official Acts and rules: <a href="https://www.indiacode.nic.in/" target="_blank" rel="noopener">India Code</a>.</p>
        @endif

        <div class="res-list">
            @foreach ($categories as $category)
                @php
                    $catCount = $category->subcategories->sum(fn($s) => $s->rules->count());
                @endphp
                <article class="res-cat" data-cat="{{ $category->id }}">
                    <button type="button" class="res-cat-head" aria-expanded="true"
                        aria-controls="cat-rules-{{ $category->id }}">
                        <span>{{ $category->name }}</span>
                        <span class="count">{{ $catCount }} {{ Str::plural('item', $catCount) }}</span>
                        <span class="chev" aria-hidden="true"><span class="site-icon icon-chevron-down" aria-hidden="true"></span></span>
                    </button>
                    <div class="res-cat-body" id="cat-rules-{{ $category->id }}">
                        @foreach ($category->subcategories as $sub)
                            @continue($sub->rules->isEmpty())
                            <div class="res-sub">
                                <h3>{{ $sub->name }}</h3>
                                <div class="res-grid">
                                    @foreach ($sub->rules as $item)
                                        <div class="list-card"
                                            data-search="{{ Str::lower($item->description . ' ' . $category->name . ' ' . $sub->name) }}">
                                            <div class="list-icon" aria-hidden="true"><span class="site-icon icon-scale" aria-hidden="true"></span></div>
                                            <div class="list-body">
                                                <h4>{{ $item->description }}</h4>
                                                @forelse ($item->pdfs ?? [] as $index => $pdf)
                                                    <div class="list-meta">
                                                        <span class="pdf">PDF {{ $index + 1 }}</span>
                                                        <span class="res-actions">
                                                            <a class="primary"
                                                                href="{{ asset('storage/app/public/' . $pdf) }}"
                                                                target="_blank" rel="noopener">View</a>
                                                            @auth
                                                                <a href="{{ asset('storage/app/public/' . $pdf) }}"
                                                                    download>Download</a>
                                                            @else
                                                                <a href="{{ route('google.login') }}">Download</a>
                                                            @endauth
                                                        </span>
                                                    </div>
                                                @empty
                                                    <div class="list-meta"><span class="pdf">No file attached</span>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        @if ($catCount === 0)
                            <p class="res-empty">No rules available in this category yet.</p>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        <p class="res-none" hidden>No rules match your search. Try another keyword or category.</p>
    </div>
</section>
<script type="application/json" id="rule-pdf-info">@json($rulePdfInfo)</script>
<script src="{{ asset('assets/theme/js/rules.js') }}?v={{ filemtime(public_path('assets/theme/js/rules.js')) }}"></script>
@endsection
