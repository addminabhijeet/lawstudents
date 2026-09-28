@extends('layouts.landing', ['title' => 'Admission Enquiry - Law Students'])
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/admission-enquiry.css') }}?v=1">
@endsection
@section('content')
<section class="admission-enquiry wrap">
    <h1>Admission Enquiry</h1>
    @if(session('enquiry_received'))
        <div role="status" class="enquiry-success"><h2>We have received your enquiry.</h2><p>Your reference is #{{ session('enquiry_received') }}. The admissions team will contact you using the details you provided.</p><a class="btn btn-gold" href="{{ route('frontend.course') }}">Explore courses</a></div>
    @else
        <p>Share your contact details and the admissions team will help you choose your next step.</p>
        @if($errors->any())<div class="enquiry-errors" role="alert"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <form action="{{ route('frontend.enquiry.store') }}" method="POST" id="admission-enquiry" class="enquiry-form">
            @csrf
            <label>Full name<input name="name" autocomplete="name" maxlength="150" value="{{ old('name', auth('student')->user()?->name) }}" required></label>
            <label>Phone<input name="phone" type="tel" autocomplete="tel" maxlength="30" value="{{ old('phone') }}"></label>
            <label>Email<input name="email" type="email" autocomplete="email" maxlength="150" value="{{ old('email', auth('student')->user()?->email) }}"></label>
            <p class="enquiry-hint">Please provide a phone number or email address.</p>
            <label>Course interest (optional)<select name="course_interest"><option value="">I need help choosing</option>@foreach($courses as $course)<option value="{{ $course }}" @selected(old('course_interest', request('course')) === $course)>{{ $course }}</option>@endforeach</select></label>
            <div hidden aria-hidden="true"><label>Company website<input name="company_website" tabindex="-1" autocomplete="off"></label></div>
            <label class="enquiry-consent"><input type="checkbox" name="consent" value="1" required @checked(old('consent'))><span>I agree to be contacted about my admission enquiry. <a href="{{ route('frontend.privacy') }}">Privacy policy</a></span></label>
            <p class="enquiry-hint">We record visits and form progress to improve admissions. Contact details are saved when you submit; passwords and OTPs are excluded from activity tracking.</p>
            <button class="btn btn-gold" type="submit" data-track="submit-enquiry">Request admission help</button>
        </form>
    @endif
</section>
@endsection
