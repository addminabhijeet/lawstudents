@props(['page'])
@php($intro = config('page_intros')[$page] ?? null)
@if ($intro)
<section class="section page-intro page-intro--{{ $page }}" aria-labelledby="page-intro-title">
    <div class="wrap page-intro__grid">
        <div class="page-intro__copy">
            <span class="eyebrow">{{ $intro['label'] }}</span>
            <h2 id="page-intro-title">{{ $intro['title'] }}</h2>
            <p>{{ $intro['body'] }}</p>
            <p>{{ $intro['detail'] }}</p>
            @if ($intro['points'])
                <ul class="page-intro__points">
                    @foreach ($intro['points'] as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            @endif
            <a class="btn btn-gold" href="{{ $intro['target'] }}">{{ $intro['action'] }} <span aria-hidden="true">&rarr;</span></a>
        </div>
        <figure class="page-intro__media">
            <picture>
                <source type="image/webp"
                    srcset="{{ asset('assets/theme/images/page-intros/' . $intro['image'] . '-768.webp') }} 768w, {{ asset('assets/theme/images/page-intros/' . $intro['image'] . '.webp') }} 1536w"
                    sizes="(max-width: 900px) calc(100vw - 40px), (max-width: 1400px) 45vw, 640px">
                <img src="{{ asset('assets/theme/images/page-intros/' . $intro['image'] . '.jpg') }}"
                    alt="{{ $intro['alt'] }}" width="1536" height="1024" loading="lazy" decoding="async">
            </picture>
            @if (in_array($page, ['home', 'course', 'clientele', 'legal-knowledge', 'gallery'], true))
                <figcaption>Learning scene</figcaption>
            @endif
        </figure>
    </div>
    @if (isset(config('page_sections')[$page]))
        <nav class="wrap academic-guide-nav" aria-label="More on this page">
            <a href="#explore-pathways">Explore your options</a>
            @if (!empty(config('page_sections')[$page]['story']))
                <a href="#study-approach">Learning guide</a>
            @endif
            <a href="#common-questions">Common questions</a>
            <a href="#next-step">Your next step</a>
        </nav>
    @endif
</section>
@endif
