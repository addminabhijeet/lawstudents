@extends('layouts.landing', ['title' => 'Law Students — Learn Law. Understand Law. Build Your Future.'])

@section('body_class', '')
@section('skip_inner_css', '1')

@section('meta_description', 'A comprehensive platform for Legal Education, Examination Preparation, Legal Knowledge, Bare Acts, Rules, Notifications and Study Materials.')

@section('content')
@php
    // Same queries the previous home page ran inline, unchanged.
    $homeCourses = \App\Models\Course::limit(9)->get();
    $homeNotes = \App\Models\Copy::limit(9)->get();
    $homeActs = \App\Models\Act::limit(9)->get();
    $homeRules = \App\Models\Rule::limit(9)->get();
    $homeKnowledgeCategories = \App\Models\LegalKnowledgeCategory::where('delete', 1)->get();
    $homeExams = \App\Models\GovtExam::where('delete', 1)->latest()->limit(9)->get();
    $homeKnowledgeNotes = \App\Models\LegalKnowledgeNote::where('delete', 1)->latest()->limit(9)->get();
    $homeGallery = \App\Models\Gallery::active()->get()->groupBy('group_name');

    // Contact details from the same record (and fallbacks) as the header and footer.
    $homeContactUser = \App\Models\User::first();
    $homeEmail = !empty($homeContactUser->webemail) ? $homeContactUser->webemail : 'lawstudents.edu@gmail.com';
    $homeMobile = !empty($homeContactUser->mobile) ? $homeContactUser->mobile : '+916624536320';
    $homeWhatsapp = preg_replace('/[^0-9]/', '', $homeMobile);

    // pdfs is cast to an array on these models; also accept a legacy plain-string path.
    $homePdfCount = fn($item) => is_array($item->pdfs) ? count($item->pdfs) : (is_string($item->pdfs) && $item->pdfs !== '' ? count(json_decode($item->pdfs, true) ?: [$item->pdfs]) : 0);

    // Icon mapping for legal knowledge categories
    $iconMap = [
        'constitutional' => 'script',
        'cyber law' => 'lock',
        'consumer' => 'user',
        'cheque' => 'credit-card',
        'civil' => 'scale',
        'criminal' => 'urgent',
        'writs' => 'clipboard',
        'company' => 'building',
        'hindu' => 'om',
        'muslim' => 'moon-stars',
        'labour' => 'helmet',
        'cyber security' => 'shield',
        'cyber crime' => 'device-laptop',
        'compliance' => 'circle-check',
    ];

    $getCategoryIcon = function($categoryName) use ($iconMap) {
        $lowerName = strtolower($categoryName);
        foreach ($iconMap as $key => $icon) {
            if (strpos($lowerName, $key) !== false) {
                return $icon;
            }
        }
        return 'scale'; // Default icon
    };
@endphp

@if (session('success'))
  <p class="form-toast" role="status">{{ session('success') }}</p>
@endif

<!--===== HERO SECTION STARTS =======-->
<section class="hero" id="home">
  <div class="wrap hero-inner">
    <img src="{{ asset('assets/theme/images/logo11.png') }}" alt="Law Students" class="hero-logo" loading="eager">
    <h1>Law Students</h1>
    <p class="hero-tag">Learn Law. Understand Law. Build Your Future.</p>
    <p class="hero-desc">A comprehensive platform for Legal Education, Examination Preparation, Legal Knowledge, Bare Acts, Rules, Notifications and Study Materials.</p>
    <div class="hero-btns">
      <a href="#courses" class="btn btn-gold">Explore Courses</a>
      <a href="#notes" class="btn btn-ghost">Free Notes</a>
      <a href="#knowledge" class="btn btn-ghost">Legal Knowledge</a>
    </div>
  </div>
</section>
<!--===== HERO SECTION ENDS =======-->

<!--===== ABOUT SECTION STARTS =======-->
<section class="section about-section" id="about">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">About Platform</span>
      <h2 class="section-title">Welcome to <span class="accent">Law Students</span></h2>
      <div class="title-rule"></div>
    </div>
    <div class="about-card reveal">
      <p>Law Students is an educational and knowledge platform dedicated to students, aspirants and professionals pursuing legal and professional education. The platform provides structured courses, study materials, Bare Acts, Rules, Notifications, legal knowledge resources and examination-oriented preparation.</p>
    </div>
  </div>
</section>
<!--===== ABOUT SECTION ENDS =======-->

<!--===== COURSES SECTION STARTS =======-->
<section class="section courses-section" id="courses">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Courses</span>
      <h2 class="section-title">Explore Our <span class="accent">Courses</span></h2>
      <p class="section-sub">Comprehensive learning programs designed by legal experts</p>
      <div class="title-rule"></div>
    </div>
    <div class="course-grid">
@foreach ($homeCourses as $homeCourse)
        <article class="course-card reveal" data-d="{{ ($loop->index % 3) + 1 }}">
          <div class="course-thumb">@if ($homeCourse->thumbnail)<img src="{{ asset('storage/app/public/' . $homeCourse->thumbnail) }}" alt="{{ $homeCourse->title }}" loading="lazy" decoding="async">@endif</div>
          <div class="course-body">
            <h3>{{ $homeCourse->title }}</h3>
            <p>{{ Str::limit(strip_tags($homeCourse->short_description ?? $homeCourse->description ?? ''), 70) }}</p>
            <div class="course-foot"><span class="course-price">₹{{ number_format((float) $homeCourse->price, 2) }}</span><a class="course-link" href="{{ route('frontend.course') }}">Explore Course <span class="site-icon icon-arrow-right cl-arrow" aria-hidden="true"></span></a></div>
          </div>
        </article>
      @endforeach
    </div>
    <div class="section-cta reveal"><a href="{{ route('frontend.course') }}" class="btn btn-gold">View All Courses</a></div>
  </div>
</section>
<!--===== COURSES SECTION ENDS =======-->

<!--===== FREE NOTES SECTION STARTS =======-->
<section class="section notes-section" id="notes">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Free Notes</span>
      <h2 class="section-title">Free <span class="accent">Study Notes</span></h2>
      <p class="section-sub">Access valuable study materials and notes for your legal education</p>
      <div class="title-rule"></div>
    </div>
    <div class="list-grid">
@foreach ($homeNotes->where('delete', 1) as $homeNote)
        <a href="{{ route('frontend.copys') }}" class="list-card reveal" data-d="{{ $loop->index % 2 + 1 }}"><div class="list-icon"><span class="site-icon icon-books" aria-hidden="true"></span></div><div class="list-body"><h4>{{ Str::limit($homeNote->description, 70, '…', true) }}</h4><div class="list-meta"><span class="pdf">{{ $homePdfCount($homeNote) }} PDF available</span><span class="go">View All <span class="site-icon icon-arrow-right" aria-hidden="true"></span></span></div></div></a>
      @endforeach
    </div>
    <div class="section-cta reveal"><a href="{{ route('frontend.copys') }}" class="btn btn-gold">View All Notes</a></div>
  </div>
</section>
<!--===== FREE NOTES SECTION ENDS =======-->

<!--===== ACTS SECTION STARTS =======-->
<section class="section acts-section" id="acts">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Bare Acts</span>
      <h2 class="section-title">Bare <span class="accent">Acts</span></h2>
      <p class="section-sub">Access comprehensive Bare Acts and legal documents</p>
      <div class="title-rule"></div>
    </div>
    <div class="list-grid">
@foreach ($homeActs->where('delete', 1) as $homeAct)
        <a href="{{ route('frontend.acts') }}" class="list-card reveal" data-d="{{ $loop->index % 2 + 1 }}"><div class="list-icon"><span class="site-icon icon-script" aria-hidden="true"></span></div><div class="list-body"><h4>{{ Str::limit($homeAct->description, 70, '…', true) }}</h4><div class="list-meta"><span class="pdf">{{ $homePdfCount($homeAct) }} PDF available</span><span class="go">View All <span class="site-icon icon-arrow-right" aria-hidden="true"></span></span></div></div></a>
      @endforeach
    </div>
    <div class="section-cta reveal"><a href="{{ route('frontend.acts') }}" class="btn btn-gold">View All Acts</a></div>
  </div>
</section>
<!--===== ACTS SECTION ENDS =======-->

<!--===== RULES SECTION STARTS =======-->
<section class="section rules-section" id="rules">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Legal Rules</span>
      <h2 class="section-title">Legal <span class="accent">Rules</span></h2>
      <p class="section-sub">Access comprehensive Rules and regulatory frameworks</p>
      <div class="title-rule"></div>
    </div>
    <div class="list-grid">
@foreach ($homeRules->where('delete', 1) as $homeRule)
        <a href="{{ route('frontend.rules') }}" class="list-card reveal" data-d="{{ $loop->index % 2 + 1 }}"><div class="list-icon"><span class="site-icon icon-scale" aria-hidden="true"></span></div><div class="list-body"><h4>{{ Str::limit($homeRule->description, 70, '…', true) }}</h4><div class="list-meta"><span class="pdf">{{ $homePdfCount($homeRule) }} PDF available</span><span class="go">View All <span class="site-icon icon-arrow-right" aria-hidden="true"></span></span></div></div></a>
      @endforeach
    </div>
    <div class="section-cta reveal"><a href="{{ route('frontend.rules') }}" class="btn btn-gold">View All Rules</a></div>
  </div>
</section>
<!--===== RULES SECTION ENDS =======-->

<!--===== LEGAL KNOWLEDGE CATEGORIES SECTION STARTS =======-->
<section class="section kn-section" id="knowledge">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Legal Knowledge</span>
      <h2 class="section-title">Legal <span class="accent">Knowledge</span></h2>
      <p class="section-sub">Explore legal concepts, cases and compliance-oriented resources by category</p>
      <div class="title-rule"></div>
    </div>
    <div class="kn-grid">
@foreach ($homeKnowledgeCategories as $homeKnCat)
        <a href="{{ route('frontend.legalknowledgelibrary') }}?cat={{ $homeKnCat->id }}" class="kn-card reveal" data-d="{{ $loop->index % 4 + 1 }}"><span class="kn-ico"><span class="site-icon icon-{{ $getCategoryIcon($homeKnCat->name) }}" aria-hidden="true"></span></span><h5>{{ $homeKnCat->name }}</h5><span>Explore</span></a>
      @endforeach
    </div>
  </div>
</section>
<!--===== LEGAL KNOWLEDGE CATEGORIES SECTION ENDS =======-->

<!--===== KNOWLEDGE INQUIRY FORM SECTION STARTS =======-->
<section class="section form-section">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Knowledge Inquiry</span>
      <h2 class="section-title">Interested in Specific <span class="accent">Legal Knowledge?</span></h2>
      <p class="section-sub">Submit your inquiry about any legal topic you'd like to explore deeper. Our legal experts will provide guidance and resources tailored to your learning needs.</p>
      <div class="title-rule"></div>
    </div>
    <form class="form-card reveal" id="home-inquiry" action="{{ route('frontend.legal-knowledge-store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="form_id" value="home-inquiry">
      @if ($errors->any() && old('form_id') === 'home-inquiry')
        <p class="form-status" role="alert">{{ $errors->first() }}</p>
      @endif
      <div class="form-row">
        <div class="field"><label for="hk-name">Full Name <span class="req" aria-hidden="true">*</span></label><input type="text" id="hk-name" name="name" value="{{ old('form_id') === 'home-inquiry' ? old('name') : '' }}" placeholder="Enter your full name" autocomplete="name" required></div>
        <div class="field"><label for="hk-email">Email Address <span class="req" aria-hidden="true">*</span></label><input type="email" id="hk-email" name="email" value="{{ old('form_id') === 'home-inquiry' ? old('email') : '' }}" placeholder="Enter your email" autocomplete="email" required></div>
        <div class="field"><label for="hk-mobile">Phone Number <span class="req" aria-hidden="true">*</span></label><input type="tel" id="hk-mobile" name="mobile" value="{{ old('form_id') === 'home-inquiry' ? old('mobile') : '' }}" placeholder="Enter your phone number" autocomplete="tel" maxlength="20" required></div>
        <div class="field"><label for="hk-subject">Select Legal Knowledge Category <span class="req" aria-hidden="true">*</span></label><select id="hk-subject" name="subject" required><option value="">Select Legal Knowledge Category</option>@foreach ($homeKnowledgeCategories as $homeKnOpt)<option value="{{ $homeKnOpt->name }}" @selected(old('form_id') === 'home-inquiry' && old('subject') === $homeKnOpt->name)>{{ $homeKnOpt->name }}</option>@endforeach<option value="Other" @selected(old('form_id') === 'home-inquiry' && old('subject') === 'Other')>Other</option></select></div>
        <div class="field full"><label for="hk-question">Your Inquiry <span class="req" aria-hidden="true">*</span></label><textarea id="hk-question" name="question" placeholder="Describe the legal topic you would like to explore" required>{{ old('form_id') === 'home-inquiry' ? old('question') : '' }}</textarea></div>
        <div class="field full"><label for="hk-doc">Upload Document (Optional)</label><input type="file" id="hk-doc" name="document" accept=".pdf,.doc,.docx,.txt"></div>
      </div>
      <div class="form-actions"><button type="submit" class="btn btn-gold">Send Inquiry</button></div>
      <div class="form-note"><strong>Disclaimer:</strong> This inquiry facility is intended for preliminary communication and legal/educational information. Submission of an inquiry does not by itself create an advocate-client relationship. Formal legal advice, representation or engagement shall be subject to separate communication and acceptance.</div>
    </form>
  </div>
</section>
<!--===== KNOWLEDGE INQUIRY FORM SECTION ENDS =======-->

<!--===== CENTRE & STATE GOVT EXAMS SECTION STARTS =======-->
<section class="section exams-section" id="exams">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Exams</span>
      <h2 class="section-title">Centre &amp; State Govt. <span class="accent">Examination</span></h2>
      <p class="section-sub">Comprehensive preparation for competitive legal examinations</p>
      <div class="title-rule"></div>
    </div>
    <div class="list-grid">
@foreach ($homeExams as $homeExam)
        <a href="{{ route('frontend.govtexams') }}" class="list-card reveal" data-d="{{ $loop->index % 2 + 1 }}"><div class="list-icon"><span class="site-icon icon-clipboard" aria-hidden="true"></span></div><div class="list-body"><h4>{{ Str::limit($homeExam->description, 70, '…', true) }}</h4><div class="list-meta"><span class="pdf">{{ $homePdfCount($homeExam) }} PDF available</span><span class="go">View All <span class="site-icon icon-arrow-right" aria-hidden="true"></span></span></div></div></a>
      @endforeach
    </div>
    <div class="section-cta reveal"><a href="{{ route('frontend.govtexams') }}" class="btn btn-gold">View All Govt. Examinations</a></div>
  </div>
</section>
<!--===== CENTRE & STATE GOVT EXAMS SECTION ENDS =======-->

<!--===== COURSE ENQUIRY SECTION STARTS =======-->
<section class="section enquiry-section">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Enquiry</span>
      <h2 class="section-title">Interested in <span class="accent">Our Courses?</span></h2>
      <p class="section-sub">Get in touch with our counselors to learn more about our comprehensive law courses and personalized learning programs. We're here to help you achieve your legal education goals.</p>
      <div class="title-rule"></div>
    </div>
    <form class="form-card reveal" id="home-enquiry" action="{{ route('frontend.contactstore') }}" method="post">
      @csrf
      <input type="hidden" name="form_id" value="home-enquiry">
      <input type="hidden" name="message" value="">
      @if ($errors->any() && old('form_id') === 'home-enquiry')
        <p class="form-status" role="alert">{{ $errors->first() }}</p>
      @endif
      @php $homeEnqOld = fn($k) => old('form_id') === 'home-enquiry' ? old($k) : ''; @endphp
      <div class="form-row">
        <div class="field"><label for="he-first">First Name <span class="req" aria-hidden="true">*</span></label><input type="text" id="he-first" name="first_name" value="{{ $homeEnqOld('first_name') }}" placeholder="Enter your first name" autocomplete="given-name" maxlength="100" required></div>
        <div class="field"><label for="he-last">Last Name <span class="req" aria-hidden="true">*</span></label><input type="text" id="he-last" name="last_name" value="{{ $homeEnqOld('last_name') }}" placeholder="Enter your last name" autocomplete="family-name" maxlength="100" required></div>
        <div class="field"><label for="he-email">Email Address <span class="req" aria-hidden="true">*</span></label><input type="email" id="he-email" name="email" value="{{ $homeEnqOld('email') }}" placeholder="Enter your email" autocomplete="email" required></div>
        <div class="field"><label for="he-phone">Phone Number <span class="req" aria-hidden="true">*</span></label><input type="tel" id="he-phone" name="phone" value="{{ $homeEnqOld('phone') }}" placeholder="10-digit mobile number" autocomplete="tel" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" title="Enter a 10-digit mobile number" required></div>
        <div class="field"><label for="he-course">Course Interested In <span class="req" aria-hidden="true">*</span></label><select id="he-course" name="service_type" required><option value="">Course Interested In</option>@foreach (['LL.B. Entrance Examination', 'LL.B. – 3 Years', 'LL.B. – 5 Years', 'LL.M.', 'Judiciary Examination', 'CSEET', 'CA', 'CS', 'CMA', 'English Grammar', 'Spoken English'] as $homeCourseOpt)<option @selected($homeEnqOld('service_type') === $homeCourseOpt)>{{ $homeCourseOpt }}</option>@endforeach</select></div>
        <div class="field"><label for="he-mode">Preferred Mode</label><select id="he-mode" name="mode"><option value="">Preferred Mode</option>@foreach (['Online', 'Offline', 'Both'] as $homeModeOpt)<option @selected($homeEnqOld('mode') === $homeModeOpt)>{{ $homeModeOpt }}</option>@endforeach</select></div>
        <div class="field full"><label for="he-city">City</label><input type="text" id="he-city" name="city" value="{{ $homeEnqOld('city') }}" placeholder="Enter your city" autocomplete="address-level2"></div>
        <div class="field full"><label for="he-msg">Message <span class="req" aria-hidden="true">*</span></label><textarea id="he-msg" name="enquiry_message" placeholder="Tell us what you would like to know" required>{{ $homeEnqOld('enquiry_message') }}</textarea></div>
      </div>
      <div class="form-actions"><button type="submit" class="btn btn-gold">Send Enquiry</button></div>
    </form>
  </div>
</section>
<!--===== COURSE ENQUIRY SECTION ENDS =======-->

<!--===== WHY LAWSTUDENT SECTION STARTS =======-->
<section class="section why-section">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Why Us</span>
      <h2 class="section-title">Why <span class="accent">Law Students?</span></h2>
      <p class="section-sub">Discover what makes our platform the best choice for legal education</p>
      <div class="title-rule"></div>
    </div>
    <div class="why-grid">
      <div class="why-card reveal" data-d="1"><div class="why-icon"><span class="site-icon icon-scale" aria-hidden="true"></span></div><h3>Expert Instructors</h3><p>Learn from experienced legal professionals with decades of practice and teaching experience</p></div>
      <div class="why-card reveal" data-d="2"><div class="why-icon"><span class="site-icon icon-books" aria-hidden="true"></span></div><h3>Comprehensive Content</h3><p>Access complete study materials covering all major areas of law and legal practice</p></div>
      <div class="why-card reveal" data-d="3"><div class="why-icon"><span class="site-icon icon-stopwatch" aria-hidden="true"></span></div><h3>Flexible Learning</h3><p>Study at your own pace with lifetime access to course materials and updates</p></div>
      <div class="why-card reveal" data-d="1"><div class="why-icon"><span class="site-icon icon-cash" aria-hidden="true"></span></div><h3>Affordable Pricing</h3><p>Quality legal education at competitive rates with various payment options available</p></div>
      <div class="why-card reveal" data-d="2"><div class="why-icon"><span class="site-icon icon-target" aria-hidden="true"></span></div><h3>Exam Preparation</h3><p>Dedicated exam coaching for CLAT, AIBE, UGC NET, and other legal entrance exams</p></div>
      <div class="why-card reveal" data-d="3"><div class="why-icon"><span class="site-icon icon-lifebuoy" aria-hidden="true"></span></div><h3>24/7 Support</h3><p>Round-the-clock support from our dedicated counselors and academic team</p></div>
    </div>
  </div>
</section>
<!--===== WHY LAWSTUDENT SECTION ENDS =======-->

<!--===== HOW IT WORKS SECTION STARTS =======-->
<section class="section how-section">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Process</span>
      <h2 class="section-title">How It <span class="accent">Works</span></h2>
      <p class="section-sub">Your path from choosing a programme to achieving your legal career goals</p>
      <div class="title-rule"></div>
    </div>
    <div class="how-grid">
      <div class="how-card reveal" data-d="1"><div class="how-num">01</div><h3>Select</h3><p>Choose your programme — Course, Notes, Bare Acts or Exam preparation</p></div>
      <div class="how-card reveal" data-d="2"><div class="how-num">02</div><h3>Study</h3><p>Go through structured notes, classes and resources at your own pace</p></div>
      <div class="how-card reveal" data-d="3"><div class="how-num">03</div><h3>Practise</h3><p>Reinforce learning with MCQs, tests and practical resources</p></div>
      <div class="how-card reveal" data-d="4"><div class="how-num">04</div><h3>Achieve</h3><p>Walk into your examination or career with confidence</p></div>
    </div>
  </div>
</section>
<!--===== HOW IT WORKS SECTION ENDS =======-->

<!--===== LATEST LEGAL KNOWLEDGE SECTION STARTS =======-->
<section class="section updates-section">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Updates</span>
      <h2 class="section-title">Latest <span class="accent">Legal Knowledge</span></h2>
      <p class="section-sub">Stay updated with the latest developments in law and legal practice</p>
      <div class="title-rule"></div>
    </div>
    <div class="list-grid">
@foreach ($homeKnowledgeNotes as $homeKnowledgeNote)
        <a href="{{ route('frontend.legalknowledgelibrary') }}" class="list-card reveal" data-d="{{ $loop->index % 2 + 1 }}"><div class="list-icon"><span class="site-icon icon-books" aria-hidden="true"></span></div><div class="list-body"><h4>{{ Str::limit($homeKnowledgeNote->description, 70, '…', true) }}</h4><div class="list-meta"><span class="pdf">{{ $homePdfCount($homeKnowledgeNote) }} PDF available</span><span class="go">View All <span class="site-icon icon-arrow-right" aria-hidden="true"></span></span></div></div></a>
      @endforeach
    </div>
    <div class="section-cta reveal"><a href="{{ route('frontend.legalknowledgelibrary') }}" class="btn btn-gold">View All Legal Knowledge</a></div>
  </div>
</section>
<!--===== LATEST LEGAL KNOWLEDGE SECTION ENDS =======-->

<!--===== GALLERY PREVIEW SECTION STARTS =======-->
<section class="section gallery-section" id="gallery">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Gallery</span>
      <h2 class="section-title">Our <span class="accent">Gallery</span></h2>
      <p class="section-sub">Glimpses of our campus, events, and learning environment</p>
      <div class="title-rule"></div>
    </div>
    <div class="gallery-grid">
@foreach ($homeGallery as $homeGroupName => $homeGroupItems)
        @php $homeUrls = $homeGroupItems->pluck('image')->filter()->map(fn($i) => asset('storage/app/public/' . $i))->values(); @endphp
        @continue($homeUrls->isEmpty())
        <a href="{{ route('frontend.gallery') }}" class="album reveal" data-d="{{ $loop->iteration }}">
          <div class="album-imgs {{ $homeUrls->count() === 1 ? 'single' : '' }}">@foreach ($homeUrls->take(2) as $homeUrl)<img src="{{ $homeUrl }}" alt="{{ $homeGroupName }}" loading="lazy" decoding="async">@endforeach</div>
          <div class="album-body"><h4>{{ $homeGroupName }}</h4><span>{{ $homeUrls->count() }} {{ Str::plural('Photo', $homeUrls->count()) }}</span></div>
        </a>
      @endforeach
    </div>
    <div class="section-cta reveal"><a href="{{ route('frontend.gallery') }}" class="btn btn-gold">View Full Gallery</a></div>
  </div>
</section>
<!--===== GALLERY PREVIEW SECTION ENDS =======-->

<!--===== CONTACT US SECTION STARTS =======-->
<section class="section contact-section" id="contact">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Contact</span>
      <h2 class="section-title">Get in Touch with <span class="accent">Law Students</span></h2>
      <div class="title-rule"></div>
    </div>
    <div class="contact-layout">
      <div class="contact-intro reveal">
        <p>Have questions about our courses, Bare Acts, or study materials? Our team is ready to help you every step of the way in your legal education journey.</p>
        <div class="contact-items">
          <div class="contact-item"><div class="contact-ico"><span class="site-icon icon-map-pin" aria-hidden="true"></span></div><div><h5>Address</h5><p>224 Legal District, Delhi High Court Marg, New Delhi 110001</p></div></div>
          <div class="contact-item"><div class="contact-ico"><span class="site-icon icon-phone" aria-hidden="true"></span></div><div><h5>Phone</h5><p><a href="tel:{{ $homeMobile }}">{{ $homeMobile }}</a></p></div></div>
          <div class="contact-item"><div class="contact-ico"><span class="site-icon icon-brand-whatsapp" aria-hidden="true"></span></div><div><h5>WhatsApp</h5><p><a href="https://wa.me/{{ $homeWhatsapp }}" target="_blank" rel="noopener">{{ $homeMobile }}</a></p></div></div>
          <div class="contact-item"><div class="contact-ico"><span class="site-icon icon-mail" aria-hidden="true"></span></div><div><h5>Email</h5><p><a href="mailto:{{ $homeEmail }}">{!! str_replace('@', '@<wbr>', e($homeEmail)) !!}</a></p></div></div>
        </div>
      </div>
      <form class="form-card reveal" data-d="1" id="home-contact" action="{{ route('frontend.contactstore') }}" method="post">
        @csrf
        <input type="hidden" name="form_id" value="home-contact">
        @if ($errors->any() && old('form_id') === 'home-contact')
          <p class="form-status" role="alert">{{ $errors->first() }}</p>
        @endif
        @php $homeCtOld = fn($k) => old('form_id') === 'home-contact' ? old($k) : ''; @endphp
        <div class="form-row">
          <div class="field"><label for="hc-first">First Name <span class="req" aria-hidden="true">*</span></label><input type="text" id="hc-first" name="first_name" value="{{ $homeCtOld('first_name') }}" placeholder="Enter your first name" autocomplete="given-name" maxlength="100" required></div>
          <div class="field"><label for="hc-last">Last Name <span class="req" aria-hidden="true">*</span></label><input type="text" id="hc-last" name="last_name" value="{{ $homeCtOld('last_name') }}" placeholder="Enter your last name" autocomplete="family-name" maxlength="100" required></div>
          <div class="field"><label for="hc-email">Email Address <span class="req" aria-hidden="true">*</span></label><input type="email" id="hc-email" name="email" value="{{ $homeCtOld('email') }}" placeholder="Enter your email" autocomplete="email" required></div>
          <div class="field"><label for="hc-phone">Phone Number <span class="req" aria-hidden="true">*</span></label><input type="tel" id="hc-phone" name="phone" value="{{ $homeCtOld('phone') }}" placeholder="10-digit mobile number" autocomplete="tel" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" title="Enter a 10-digit mobile number" required></div>
          <div class="field full"><label for="hc-subject">Subject <span class="req" aria-hidden="true">*</span></label><input type="text" id="hc-subject" name="service_type" value="{{ $homeCtOld('service_type') }}" placeholder="Subject of your message" maxlength="150" required></div>
          <div class="field full"><label for="hc-msg">Message <span class="req" aria-hidden="true">*</span></label><textarea id="hc-msg" name="message" placeholder="Write your message here" required>{{ $homeCtOld('message') }}</textarea></div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-gold">Send Message</button>
          <a href="https://wa.me/{{ $homeWhatsapp }}" class="btn btn-ghost btn-wa-light" target="_blank" rel="noopener">WhatsApp Us</a>
        </div>
      </form>
    </div>
  </div>
</section>
<!--===== CONTACT US SECTION ENDS =======-->
@endsection

@section('scripts')
    <script src="{{ asset('assets/theme/js/home.js') }}?v={{ filemtime(public_path('assets/theme/js/home.js')) }}"></script>
    <script>
    (function () {
      // contact-store keeps one message field, so fold the enquiry's mode and city into it.
      var enquiry = document.getElementById('home-enquiry');
      if (enquiry) enquiry.addEventListener('submit', function () {
        var mode = enquiry.elements.mode.value, city = enquiry.elements.city.value.trim();
        var extra = [mode ? 'Preferred mode: ' + mode : '', city ? 'City: ' + city : ''].filter(Boolean).join(' | ');
        enquiry.elements.message.value = (extra ? extra + '\n\n' : '') + enquiry.elements.enquiry_message.value.trim();
      });
      // After a failed submit the page reloads at the top; bring the form with the error back into view.
      var failed = document.querySelector('form.form-card .form-status[role="alert"]');
      if (failed) window.addEventListener('load', function () {
        window.scrollTo({ top: failed.closest('form').getBoundingClientRect().top + window.scrollY - 160, behavior: 'instant' });
      });
    })();
    </script>
@endsection
