@extends('pages.layout')

@section('doc_description', 'The latest Bare Acts, Rules, notes, examination guides and legal knowledge added to Law Students.')

@section('doc')
@php
    // Built from what was actually added to the site, newest first.
    $newsSources = [
        [\App\Models\Act::class, 'New Bare Act', 'script', 'frontend.acts'],
        [\App\Models\Rule::class, 'New Rule', 'scale', 'frontend.rules'],
        [\App\Models\Copy::class, 'New Free Note', 'books', 'frontend.copys'],
        [\App\Models\GovtExam::class, 'Exam Update', 'clipboard', 'frontend.govtexams'],
        [\App\Models\LegalKnowledgeNote::class, 'Legal Knowledge', 'books', 'frontend.legalknowledgelibrary'],
    ];
    $newsItems = collect($newsSources)->flatMap(function ($source) {
        [$model, $label, $icon, $route] = $source;
        return $model::where('delete', 1)->latest()->limit(6)->get()
            ->map(fn($row) => (object) ['label' => $label, 'icon' => $icon, 'url' => route($route), 'title' => $row->description, 'date' => $row->created_at]);
    })->sortByDesc('date')->take(12)->values();
@endphp
<div class="section-head reveal">
    <span class="eyebrow">What's New</span>
    <h2 class="section-title">Latest <span class="accent">Additions</span></h2>
    <p class="section-sub">New Bare Acts, Rules, free notes, examination guides and legal knowledge, newest first</p>
    <div class="title-rule"></div>
</div>
@if ($newsItems->isEmpty())
    <div class="doc-card reveal">
        <div class="list-card" style="box-shadow:none;margin:0">
            <div class="list-icon"><span class="site-icon icon-clipboard" aria-hidden="true"></span></div>
            <div class="list-body">
                <h4>No announcements are published yet</h4>
                <div class="list-meta">
                    <span class="pdf">New acts, rules, notes and examination updates will appear here once added by the team.</span>
                    <span class="go"><a href="{{ route('frontend.course') }}">Explore Courses <span class="site-icon icon-arrow-right" aria-hidden="true"></span></a></span>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="list-grid">
        @foreach ($newsItems as $newsItem)
            <a href="{{ $newsItem->url }}" class="list-card reveal" data-d="{{ $loop->index % 2 + 1 }}"><div class="list-icon"><span class="site-icon icon-{{ $newsItem->icon }}" aria-hidden="true"></span></div><div class="list-body"><h4>{{ Str::limit($newsItem->title, 90, '…', true) }}</h4><div class="list-meta"><span class="pdf">{{ $newsItem->label }}@if ($newsItem->date) · <time datetime="{{ $newsItem->date->toDateString() }}">{{ $newsItem->date->format('j M Y') }}</time>@endif</span><span class="go">View <span class="site-icon icon-arrow-right" aria-hidden="true"></span></span></div></div></a>
        @endforeach
    </div>
@endif
@endsection
