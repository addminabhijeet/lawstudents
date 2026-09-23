@extends('pages.layout')

@section('doc_description', 'When course fees paid to Law Students can be refunded and how to ask for a refund.')

@section('doc')
@php
    $docUser = \App\Models\User::first();
    $docEmail = !empty($docUser->webemail) ? $docUser->webemail : 'lawstudents.edu@gmail.com';
    $docMobile = !empty($docUser->mobile) ? $docUser->mobile : '+916624536320';
@endphp
<article class="doc-card">
    <p class="doc-note" role="note"><strong>Sample policy.</strong> The periods and percentages below are placeholders. Set them to match how Law Students actually handles refunds, and have the text reviewed before relying on it.</p>
    <p class="doc-meta">Last updated: 24 September 2026</p>

    <h2>1. Free material</h2>
    <p>Free notes, Bare Acts, Rules and other free resources involve no payment, so no refund applies.</p>

    <h2>2. Paid courses: when you can get a refund</h2>
    <ul>
        <li>You ask within <strong>7 days</strong> of payment, and</li>
        <li>you have used no more than <strong>20%</strong> of the course content (classes, notes or tests), and</li>
        <li>no certificate has been issued for the course.</li>
    </ul>

    <h2>3. When a refund is not available</h2>
    <ul>
        <li>After 7 days from payment, or once more than 20% of the content has been used.</li>
        <li>Fees for examinations or registrations paid to third parties on your behalf.</li>
        <li>Printed material that has already been dispatched.</li>
        <li>Accounts suspended for sharing paid material or breaking our <a href="{{ route('frontend.terms') }}">Terms &amp; Conditions</a>.</li>
    </ul>

    <h2>4. Batch changes and cancellations</h2>
    <p>If we cancel or postpone a batch, you can move to another batch at no extra cost or receive a full refund.</p>

    <h2>5. How to ask for a refund</h2>
    <p>Email <a href="mailto:{{ $docEmail }}">{{ $docEmail }}</a> or call <a href="tel:{{ $docMobile }}">{{ $docMobile }}</a> with your name, registered phone number, course name and payment reference.</p>

    <h2>6. Processing</h2>
    <p>Approved refunds are made to the original payment method within <strong>7–10 working days</strong>. Payment-gateway charges, if any, may be deducted.</p>
</article>
@endsection
