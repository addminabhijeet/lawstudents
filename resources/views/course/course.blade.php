@extends('layouts.landing', ['title' => 'Courses — Law Students'])

@section('meta_description', 'Browse law courses by category and search by keyword.')

@section('content')
@php
    // Flatten every course the controller eager-loaded (parents + child categories),
    // keeping the category id on each so the theme's filter can match it.
    $courseRows = collect();
    foreach ($categories as $category) {
        foreach ($category->courses as $course) {
            $courseRows->push(['course' => $course, 'category' => $category]);
        }
        foreach ($category->children as $child) {
            foreach ($child->courses as $course) {
                $courseRows->push(['course' => $course, 'category' => $child]);
            }
        }
    }
    $courseRows = $courseRows->unique(fn($row) => $row['course']->id)->values();
@endphp

<section class="page-hero">
    <div class="hero-frame" aria-hidden="true"></div>
    <div class="wrap">
        <h1>Courses</h1>
        <nav class="crumbs" aria-label="Breadcrumb">
            <a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true"><span class="site-icon icon-chevron-right" aria-hidden="true"></span></span><span
                aria-current="page">Courses</span>
        </nav>
    </div>
</section>

<section class="section courses-section" id="courses">
    <div class="wrap" data-filter="cards">
        <div class="section-head reveal">
            <span class="eyebrow">Courses</span>
            <h2 class="section-title">Find Your <span class="accent">Course</span></h2>
            <p class="section-sub">Filter by category or search by keywords</p>
            <div class="title-rule"></div>
        </div>

        <div class="filter-bar">
            <div class="filter-field">
                <label id="lbl-cat">Course Category</label>
                <div class="dd">
                    <button type="button" class="dd-btn" aria-haspopup="listbox" aria-expanded="false"
                        aria-labelledby="lbl-cat" data-all-label="All Categories">
                        <span class="dd-label">All Categories</span><span class="chev" aria-hidden="true"><span class="site-icon icon-chevron-down" aria-hidden="true"></span></span>
                    </button>
                    @php
                        // The controller returns parents and children in one flat collection, so a
                        // child that also matched on its own (e.g. Civil Procedure Code, parent 41)
                        // would otherwise be listed twice. Build the option list once, nesting each
                        // child under its parent and skipping any id already emitted.
                        $emitted = [];
                        $options = [];
                        foreach ($categories as $category) {
                            if (in_array($category->id, $emitted, true)) {
                                continue;
                            }
                            $emitted[] = $category->id;
                            $options[] = ['id' => $category->id, 'name' => $category->name, 'depth' => 0];
                            foreach ($category->children as $child) {
                                if (in_array($child->id, $emitted, true)) {
                                    continue;
                                }
                                $emitted[] = $child->id;
                                $options[] = ['id' => $child->id, 'name' => $child->name, 'depth' => 1];
                            }
                        }
                    @endphp
                    <ul class="dd-menu" role="listbox" aria-labelledby="lbl-cat">
                        <li role="option" data-value="all" aria-selected="true">All Courses</li>
                        @foreach ($options as $option)
                            <li role="option" data-value="{{ $option['id'] }}" data-depth="{{ $option['depth'] }}"
                                aria-selected="false">{{ $option['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="filter-field field">
                <label for="quick-search">Quick Search</label>
                <input type="search" id="quick-search" placeholder="Search Courses..." autocomplete="off">
            </div>
        </div>

        <div class="course-grid">
            @foreach ($courseRows as $row)
                @php
                    $course = $row['course'];
                    $category = $row['category'];
                    $noteCount = $course->notes->count();
                @endphp
                <article class="course-card" data-cat="{{ $category->id }}"
                    data-search="{{ Str::lower($course->title . ' ' . $category->name) }}">
                    <div class="course-thumb">
                        @if ($course->thumbnail)
                            <img src="{{ asset('storage/app/public/' . $course->thumbnail) }}"
                                alt="{{ $course->title }}" loading="lazy" decoding="async">
                        @endif
                    </div>
                    <div class="course-body">
                        <h3>{{ $course->title }}</h3>
                        <p class="course-note"><span class="site-icon icon-file-text" aria-hidden="true"></span> Notes: {{ $noteCount }}</p>
                        <div class="course-foot">
                            <span class="course-price"><small>Price</small>₹{{ number_format((float) $course->price, 2) }}</span>
                            @if ((float) $course->discount > 0)
                                <span class="course-disc">Discount<strong>₹{{ number_format((float) $course->discount, 2) }}</strong></span>
                            @endif
                        </div>
                        <div class="course-actions">
                            <a class="btn btn-gold" href="{{ route('frontend.contact', ['course' => $course->title]) }}#contact-form">Send Enquiry</a>
                            @if ($course->brochure)
                                <a class="btn btn-line" href="{{ asset('storage/app/public/' . $course->brochure) }}"
                                    target="_blank" rel="noopener">Brochure</a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <ul class="pager" hidden></ul>
        <p class="res-none" hidden>No courses match your search. Try another keyword or category.</p>
    </div>
</section>
@endsection
