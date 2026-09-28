@props(['page'])
@php
    $section = config('page_sections')[$page] ?? null;
    $imageDescriptions = [
        'community' => 'Students discussing law in a library.',
        'inquiry' => 'A student speaking with an educator.',
        'notes' => 'A revision notebook beside an open reference book.',
        'acts' => 'An open legal text and brass scales on a library desk.',
        'exams' => 'A study desk with a practice sheet, clock and reference books.',
        'library' => 'A sunlit library with legal reference books.',
        'courses' => 'Students reading a textbook together.',
    ];
@endphp
@if ($section)
<div class="academic-page academic-page--{{ $page }}">
    <section class="academic-section academic-pathways" id="explore-pathways" aria-labelledby="pathways-title">
        <div class="wrap">
            <header class="academic-heading">
                <span class="academic-kicker">{{ $section['label'] }}</span>
                <h2 id="pathways-title">{{ $section['title'] }}</h2>
                <p>{{ $section['lead'] }}</p>
            </header>
            <div class="academic-card-grid">
                @foreach ($section['cards'] as $card)
                    <article class="academic-card">
                        <span class="academic-card-number" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $card['title'] }}</h3>
                        <p>{{ $card['body'] }}</p>
                        @if (!empty($card['route']))
                            <a class="academic-link" href="{{ route('frontend.' . $card['route'], !empty($card['query']) ? ['q' => $card['query']] : []) }}">{{ $card['link'] }} <span aria-hidden="true">&rarr;</span></a>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @if (!empty($section['story']))
        <section class="academic-section academic-story" id="study-approach" aria-labelledby="study-approach-title">
            <div class="wrap academic-story-grid">
                <figure class="academic-photo">
                    <picture>
                        <source type="image/webp"
                            srcset="{{ asset('assets/theme/images/page-intros/' . $section['story']['image'] . '-768.webp') }} 768w, {{ asset('assets/theme/images/page-intros/' . $section['story']['image'] . '.webp') }} 1536w"
                            sizes="(max-width: 900px) calc(100vw - 40px), 45vw">
                        <img src="{{ asset('assets/theme/images/page-intros/' . $section['story']['image'] . '.jpg') }}"
                            alt="{{ $imageDescriptions[$section['story']['image']] }}"
                            width="1536" height="1024" loading="lazy" decoding="async">
                    </picture>
                    <figcaption>A thoughtful approach to legal learning</figcaption>
                </figure>
                <div>
                    <span class="academic-kicker">Your Learning, In Focus</span>
                    <h2 id="study-approach-title">{{ $section['story']['title'] }}</h2>
                    @foreach ($section['story']['paragraphs'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                    <ul class="academic-checklist">
                        @foreach ($section['story']['points'] as $point)
                            <li><span aria-hidden="true">&#10003;</span>{{ $point }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    @endif

    @if (!empty($section['steps']))
        <section class="academic-section academic-process" id="learning-steps" aria-labelledby="learning-steps-title">
            <div class="wrap">
                <header class="academic-heading">
                    <span class="academic-kicker">A Practical Next Step</span>
                    <h2 id="learning-steps-title">Make progress, one step at a time.</h2>
                </header>
                <ol class="academic-step-grid">
                    @foreach ($section['steps'] as $step)
                        <li>
                            <span class="academic-step-number" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['body'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>
    @endif

    <section class="academic-section academic-faq" id="common-questions" aria-labelledby="common-questions-title">
        <div class="wrap academic-faq-grid">
            <header class="academic-heading">
                <span class="academic-kicker">Helpful Answers</span>
                <h2 id="common-questions-title">Before you take the next step.</h2>
                <p>Find a starting point here, then ask the team about anything specific to your learning needs.</p>
                <a class="academic-link" href="{{ route('frontend.contact') }}#contact-form">Ask another question <span aria-hidden="true">&rarr;</span></a>
            </header>
            <div class="academic-questions">
                @foreach ($section['faqs'] as $faq)
                    <details class="academic-question">
                        <summary>{{ $faq['question'] }}</summary>
                        <div class="academic-answer"><p>{{ $faq['answer'] }}</p></div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="academic-section academic-next" id="next-step" aria-labelledby="next-step-title">
        <div class="wrap academic-next-inner">
            <div>
                <span class="academic-kicker">Your Next Step</span>
                <h2 id="next-step-title">{{ $section['cta']['title'] }}</h2>
                <p>{{ $section['cta']['body'] }}</p>
            </div>
            <a class="btn btn-gold" href="{{ route('frontend.' . $section['cta']['route']) }}">{{ $section['cta']['label'] }} <span aria-hidden="true">&rarr;</span></a>
        </div>
    </section>
</div>
@endif
