@extends('pages.layout')

@section('doc_description', 'The terms that apply when you use the Law Students website, courses and study materials.')

@section('doc')
@php
    $docUser = \App\Models\User::first();
    $docEmail = !empty($docUser->webemail) ? $docUser->webemail : 'lawstudents.edu@gmail.com';
@endphp
<article class="doc-card">
    <p class="doc-note" role="note"><strong>Sample terms.</strong> This is template text written for Law Students. Have it reviewed by a qualified legal professional before relying on it.</p>
    <p class="doc-meta">Last updated: 24 September 2026</p>

    <p>By using the Law Students website, enrolling in a course or downloading study material, you agree to these Terms &amp; Conditions. If you do not agree, please do not use the platform.</p>

    <h2>1. Who can use the platform</h2>
    <p>The platform is meant for law students, examination aspirants, professionals and anyone interested in learning about law. Users under 18 should use it with the consent of a parent or guardian.</p>

    <h2>2. Accounts</h2>
    <p>You are responsible for keeping your login details confidential and for activity under your account. Tell us promptly if you think your account has been misused.</p>

    <h2>3. Courses and study material</h2>
    <ul>
        <li>Course access is personal and non-transferable, and lasts for the period stated for that course.</li>
        <li>Notes, PDFs, videos and tests are for your own study. You may not copy, sell, share or republish them without our written permission.</li>
        <li>Bare Acts and Rules are provided for convenience. For official purposes, rely on the text published in the Gazette of India or on India Code.</li>
    </ul>

    <h2>4. Fees and payments</h2>
    <p>Course fees are shown on the course page and are payable in advance. Refunds are governed by our <a href="{{ route('frontend.refund') }}">Refund Policy</a>.</p>

    <h2>5. Acceptable use</h2>
    <p>Do not misuse the platform: no unlawful, abusive or misleading content, no attempts to break security, and no automated scraping of study material.</p>

    <h2>6. No legal advice</h2>
    <p>Content on this platform is educational and is not legal advice. Please read our <a href="{{ route('frontend.disclaimer') }}">Disclaimer</a>.</p>

    <h2>7. Limitation of liability</h2>
    <p>We work to keep content accurate and the platform available, but we do not guarantee that it will be error-free or uninterrupted. To the extent permitted by law, we are not liable for indirect losses arising from use of the platform.</p>

    <h2>8. Suspension and termination</h2>
    <p>We may suspend or close accounts that break these terms, including accounts that share paid material.</p>

    <h2>9. Governing law</h2>
    <p>These terms are governed by the laws of India. Courts at New Delhi have jurisdiction over any dispute.</p>

    <h2>10. Changes and contact</h2>
    <p>We may update these terms; the date above shows the latest version. Questions: <a href="mailto:{{ $docEmail }}">{{ $docEmail }}</a>.</p>
</article>
@endsection
