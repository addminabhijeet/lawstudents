@extends('pages.layout')

@section('doc_description', 'How Law Students collects, uses and protects the personal information you share with us.')

@section('doc')
@php
    $docUser = \App\Models\User::first();
    $docEmail = !empty($docUser->webemail) ? $docUser->webemail : 'lawstudents.edu@gmail.com';
    $docMobile = !empty($docUser->mobile) ? $docUser->mobile : '+916624536320';
@endphp
<article class="doc-card">
    <p class="doc-note" role="note"><strong>Sample policy.</strong> This is template text written for Law Students. Have it reviewed by a qualified legal professional and adjust it to your actual practices before relying on it.</p>
    <p class="doc-meta">Last updated: 24 September 2026</p>

    <p>Law Students (“we”, “us”, “our”) runs this website to provide legal education, study materials, Bare Acts, Rules and examination guidance. This policy explains what personal information we collect, why we collect it and the choices you have. It is intended to be read with the Information Technology Act, 2000 and the Digital Personal Data Protection Act, 2023.</p>

    <h2>1. Information we collect</h2>
    <ul>
        <li><strong>Enquiry and contact forms:</strong> your name, email address, phone number, city, the course or subject you are interested in, and your message.</li>
        <li><strong>Legal knowledge inquiries:</strong> the details above plus any document you choose to upload with your question.</li>
        <li><strong>Student accounts:</strong> registration details, admission information and course enrolment records.</li>
        <li><strong>Payments:</strong> transaction references and amounts. Card, UPI and bank details are handled by our payment partner and are not stored on this website.</li>
        <li><strong>Technical data:</strong> session cookies needed to keep you signed in and to protect forms, and basic server logs (IP address, browser, pages visited).</li>
    </ul>

    <h2>2. How we use your information</h2>
    <ul>
        <li>To reply to your enquiries and send the course or study information you ask for.</li>
        <li>To enrol you in courses, give you access to study material and issue receipts.</li>
        <li>To improve our courses, notes and website.</li>
        <li>To meet legal, tax and accounting obligations.</li>
    </ul>
    <p>We do not sell your personal information.</p>

    <h2>3. Sharing</h2>
    <p>We share information only with service providers who help us run the platform (hosting, email delivery, payment processing), under confidentiality obligations, or when required by law or a lawful request from a government authority.</p>

    <h2>4. Retention</h2>
    <p>Enquiries are kept for as long as needed to respond and follow up, and student records for as long as your account is active and as required by law. Documents uploaded with inquiries are deleted once they are no longer needed.</p>

    <h2>5. Security</h2>
    <p>We use reasonable technical and organisational safeguards, including encrypted connections and restricted staff access. No method of transmission over the internet is completely secure, so please avoid sending sensitive documents unless necessary.</p>

    <h2>6. Your rights</h2>
    <p>Subject to applicable law, you may ask to access, correct or erase your personal information, withdraw consent, or raise a grievance. Students under 18 should use the platform with the consent of a parent or guardian.</p>

    <h2>7. Cookies</h2>
    <p>We use essential cookies for sign-in and form security. You can block cookies in your browser, but some features, such as the student dashboard, may stop working.</p>

    <h2>8. Changes to this policy</h2>
    <p>We may update this policy from time to time. The “Last updated” date above shows when it last changed.</p>

    <h2>9. Contact and grievances</h2>
    <p>Email <a href="mailto:{{ $docEmail }}">{{ $docEmail }}</a> or call <a href="tel:{{ $docMobile }}">{{ $docMobile }}</a>. Address: 224 Legal District, Delhi High Court Marg, New Delhi 110001.</p>
</article>
@endsection
