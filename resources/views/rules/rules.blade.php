@extends('layouts.landing', ['title' => 'Rules — Law Students'])

@section('meta_description', 'Browse Rules by category and search by keyword.')

@section('content')
<section class="page-hero">
    <div class="wrap">
        <h1>Rules</h1>
        <nav class="crumbs" aria-label="Breadcrumb">
            <a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true">›</span><span
                aria-current="page">Rules</span>
        </nav>
    </div>
</section>

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
                        <span class="dd-label">All Categories</span><span class="chev" aria-hidden="true">▾</span>
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
                        <span class="chev" aria-hidden="true">▾</span>
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
                                            <div class="list-icon" aria-hidden="true">⚖️</div>
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
@endsection
