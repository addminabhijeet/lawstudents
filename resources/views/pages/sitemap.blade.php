@extends('pages.layout')

@section('doc_description', 'Every page on the Law Students website in one place.')

@section('doc')
@php
    $mapCategories = \App\Models\LegalKnowledgeCategory::where('delete', 1)->orderBy('name')->get();
    $mapGroups = [
        'Main pages' => [
            'Home' => route('frontend.home'),
            'About Us' => route('frontend.about'),
            'Client' => route('frontend.clientele'),
            'Gallery' => route('frontend.gallery'),
            'Contact Us' => route('frontend.contact'),
            'Announcements' => route('frontend.announcements'),
        ],
        'Study resources' => [
            'Courses' => route('frontend.course'),
            'Free Notes' => route('frontend.copys'),
            'Bare Acts' => route('frontend.acts'),
            'Rules' => route('frontend.rules'),
            'Centre & State Govt. Examination' => route('frontend.govtexams'),
            'Legal Knowledge Library' => route('frontend.legalknowledgelibrary'),
            'Legal Knowledge Inquiry' => route('frontend.legal-knowledge'),
        ],
        'Policies' => [
            'Privacy Policy' => route('frontend.privacy'),
            'Terms & Conditions' => route('frontend.terms'),
            'Disclaimer' => route('frontend.disclaimer'),
            'Refund Policy' => route('frontend.refund'),
        ],
        'Account' => [
            'Login / Register' => route('login'),
        ],
    ];
@endphp
<div class="sitemap-grid">
    @foreach ($mapGroups as $mapHeading => $mapLinks)
        <section class="doc-card sitemap-col reveal" data-d="{{ $loop->index % 3 + 1 }}">
            <h2>{{ $mapHeading }}</h2>
            <ul>
                @foreach ($mapLinks as $mapLabel => $mapUrl)
                    <li><a href="{{ $mapUrl }}">{{ $mapLabel }}</a></li>
                @endforeach
            </ul>
        </section>
    @endforeach
    @if ($mapCategories->isNotEmpty())
        <section class="doc-card sitemap-col sitemap-wide reveal">
            <h2>Legal Knowledge categories</h2>
            <ul>
                @foreach ($mapCategories as $mapCategory)
                    <li><a href="{{ route('frontend.legalknowledgelibrary') }}?cat={{ $mapCategory->id }}">{{ $mapCategory->name }}</a></li>
                @endforeach
            </ul>
        </section>
    @endif
</div>
@endsection
