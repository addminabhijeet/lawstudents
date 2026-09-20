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
@endphp

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
      <h2 class="section-title">Welcome to <span class="accent">Law Student</span></h2>
      <div class="title-rule"></div>
    </div>
    <div class="about-card reveal">
      <p>Law Student is an educational and knowledge platform dedicated to students, aspirants and professionals pursuing legal and professional education. The platform provides structured courses, study materials, Bare Acts, Rules, Notifications, legal knowledge resources and examination-oriented preparation.</p>
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
            <div class="course-foot"><span class="course-price">₹{{ number_format((float) $homeCourse->price, 2) }}</span><a class="course-link" href="{{ route('frontend.course') }}">Explore Course →</a></div>
          </div>
        </article>
      @endforeach
    </div>
    <div class="section-cta reveal"><a href="#" class="btn btn-gold">View All Courses</a></div>
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
@foreach ($homeKnowledgeNotes as $homeKnowledgeNote)
        @php $pdfCount = is_array($homeKnowledgeNote->pdfs) ? count($homeKnowledgeNote->pdfs) : (is_string($homeKnowledgeNote->pdfs) && $homeKnowledgeNote->pdfs !== '' ? count(json_decode($homeKnowledgeNote->pdfs, true) ?: [$homeKnowledgeNote->pdfs]) : 0); @endphp
        <a href="{{ route('frontend.legalknowledgelibrary') }}" class="list-card reveal" data-d="{{ $loop->index % 2 + 1 }}"><div class="list-icon">📚</div><div class="list-body"><h4>{{ Str::limit($homeKnowledgeNote->description, 60) }}</h4><div class="list-meta"><span class="pdf">{{ $pdfCount }} PDF available</span><span class="go">View All →</span></div></div></a>
      @endforeach
    </div>
    <div class="section-cta reveal"><a href="#" class="btn btn-gold">View All Notes</a></div>
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
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">📜</div><div class="list-body"><h4>The Indian Contract Act, 1872 - essentials of a valid contra...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="2"><div class="list-icon">📜</div><div class="list-body"><h4>The Transfer of Property Act, 1882 - sale, mortgage, lease a...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">📜</div><div class="list-body"><h4>The Hindu Marriage Act, 1955 - conditions for a valid marria...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="2"><div class="list-icon">📜</div><div class="list-body"><h4>The Consumer Protection Act, 2019 - Consumer Commissions, e-...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">📜</div><div class="list-body"><h4>The Industrial Disputes Act, 1947 - dispute resolution machi...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="2"><div class="list-icon">📜</div><div class="list-body"><h4>The Companies Act, 2013 - incorporation, corporate governanc...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">📜</div><div class="list-body"><h4>The Bharatiya Sakshya Adhiniyam, 2023</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
    </div>
    <div class="section-cta reveal"><a href="#" class="btn btn-gold">View All Acts</a></div>
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
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">⚖️</div><div class="list-body"><h4>Civil Procedure Rules: Order XXXIX - Temporary Injunctions,...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="2"><div class="list-icon">⚖️</div><div class="list-body"><h4>Code of Criminal Procedure, 1973 - Rules on Bail &amp; Anticipat...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">⚖️</div><div class="list-body"><h4>Companies (Incorporation) Rules, 2014 - SPICe+ procedure and...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="2"><div class="list-icon">⚖️</div><div class="list-body"><h4>The Indian Evidence Act, 1872 - Rules on Admissibility, burd...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">⚖️</div><div class="list-body"><h4>Landmark Judgment: Mohori Bibee v. Dharmodas Ghosh (1903) -...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
    </div>
    <div class="section-cta reveal"><a href="#" class="btn btn-gold">View All Rules</a></div>
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
        <a href="{{ route('frontend.legalknowledgelibrary') }}" class="kn-card reveal" data-d="{{ $loop->index % 4 + 1 }}"><span class="kn-ico">⚖️</span><h5>{{ $homeKnCat->name }}</h5><span>Explore</span></a>
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
    <form class="form-card reveal" onsubmit="return false;">
      <div class="form-row">
        <div class="field"><label>Full Name</label><input type="text" placeholder="Enter your full name"></div>
        <div class="field"><label>Email Address</label><input type="email" placeholder="Enter your email"></div>
        <div class="field"><label>Phone Number</label><input type="tel" placeholder="Enter your phone number"></div>
        <div class="field"><label>Select Legal Knowledge Category</label><select><option value="">Select Legal Knowledge Category</option><option>Constitutional Law</option><option>Criminal Law</option><option>Family Law</option><option>Corporate Law</option><option>Labor Law</option><option>Tax Law</option><option>Environmental Law</option><option>Intellectual Property</option><option>Administrative Law</option><option>International Law</option></select></div>
        <div class="field full"><label>Your Inquiry</label><textarea placeholder="Describe the legal topic you would like to explore"></textarea></div>
        <div class="field full"><label>Upload Document (Optional)</label><input type="file"></div>
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
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">📋</div><div class="list-body"><h4>State Judicial Services Examination: Becoming a Civil Judge...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="2"><div class="list-icon">📋</div><div class="list-body"><h4>All India Bar Examination (AIBE): What Every Law Graduate Sh...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">📋</div><div class="list-body"><h4>SSC CGL: Legal-Sector Posts for Law Graduates - exam stages,...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="2"><div class="list-icon">📋</div><div class="list-body"><h4>RBI Grade B (Legal Officer): Exam Guide for Law Graduates -...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">📋</div><div class="list-body"><h4>UPSC Civil Services Examination: A Guide for Law Graduates -...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
    </div>
    <div class="section-cta reveal"><a href="#" class="btn btn-gold">View All Govt. Examinations</a></div>
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
    <form class="form-card reveal" onsubmit="return false;">
      <div class="form-row">
        <div class="field"><label>Full Name</label><input type="text" placeholder="Enter your full name"></div>
        <div class="field"><label>Email Address</label><input type="email" placeholder="Enter your email"></div>
        <div class="field"><label>Phone Number</label><input type="tel" placeholder="Enter your phone number"></div>
        <div class="field"><label>Course Interested In</label><select><option value="">Course Interested In</option><option>LL.B. Entrance Examination</option><option>LL.B. – 3 Years</option><option>LL.B. – 5 Years</option><option>LL.M.</option><option>Judiciary Examination</option><option>CSEET</option><option>CA</option><option>CS</option><option>CMA</option><option>English Grammar</option><option>Spoken English</option></select></div>
        <div class="field"><label>Preferred Mode</label><select><option value="">Preferred Mode</option><option>Online</option><option>Offline</option><option>Both</option></select></div>
        <div class="field"><label>City</label><input type="text" placeholder="Enter your city"></div>
        <div class="field full"><label>Message</label><textarea placeholder="Tell us what you would like to know"></textarea></div>
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
      <div class="why-card reveal" data-d="1"><div class="why-icon">⚖️</div><h3>Expert Instructors</h3><p>Learn from experienced legal professionals with decades of practice and teaching experience</p></div>
      <div class="why-card reveal" data-d="2"><div class="why-icon">📚</div><h3>Comprehensive Content</h3><p>Access complete study materials covering all major areas of law and legal practice</p></div>
      <div class="why-card reveal" data-d="3"><div class="why-icon">⏱️</div><h3>Flexible Learning</h3><p>Study at your own pace with lifetime access to course materials and updates</p></div>
      <div class="why-card reveal" data-d="1"><div class="why-icon">💰</div><h3>Affordable Pricing</h3><p>Quality legal education at competitive rates with various payment options available</p></div>
      <div class="why-card reveal" data-d="2"><div class="why-icon">🎯</div><h3>Exam Preparation</h3><p>Dedicated exam coaching for CLAT, AIBE, UGC NET, and other legal entrance exams</p></div>
      <div class="why-card reveal" data-d="3"><div class="why-icon">🛟</div><h3>24/7 Support</h3><p>Round-the-clock support from our dedicated counselors and academic team</p></div>
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
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">📚</div><div class="list-body"><h4>The Right to Information Act, 2005: Empowering Citizens - ho...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="2"><div class="list-icon">📚</div><div class="list-body"><h4>Understanding Cyber Crimes and the Information Technology Ac...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">📚</div><div class="list-body"><h4>Know Your Rights: Consumer Protection in the Digital Age - e...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="2"><div class="list-icon">📚</div><div class="list-body"><h4>Legal Aid in India: Article 39A and Access to Justice - elig...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
      <a href="#" class="list-card reveal" data-d="1"><div class="list-icon">📚</div><div class="list-body"><h4>Article 21: Right to Life and Personal Liberty - from A.K. G...</h4><div class="list-meta"><span class="pdf">1 PDF available</span><span class="go">View All →</span></div></div></a>
    </div>
    <div class="section-cta reveal"><a href="#" class="btn btn-gold">View All Legal Knowledge</a></div>
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
    <div class="section-cta reveal"><a href="#" class="btn btn-gold">View Full Gallery</a></div>
  </div>
</section>
<!--===== GALLERY PREVIEW SECTION ENDS =======-->

<!--===== CONTACT US SECTION STARTS =======-->
<section class="section contact-section" id="contact">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Contact</span>
      <h2 class="section-title">Get in Touch with <span class="accent">Law Student</span></h2>
      <div class="title-rule"></div>
    </div>
    <div class="contact-layout">
      <div class="contact-intro reveal">
        <p>Have questions about our courses, Bare Acts, or study materials? Our team is ready to help you every step of the way in your legal education journey.</p>
        <div class="contact-items">
          <div class="contact-item"><div class="contact-ico">📍</div><div><h5>Address</h5><p>224 Legal District, Delhi High Court Marg, New Delhi 110001</p></div></div>
          <div class="contact-item"><div class="contact-ico">📞</div><div><h5>Phone</h5><p>+916624536320</p></div></div>
          <div class="contact-item"><div class="contact-ico">💬</div><div><h5>WhatsApp</h5><p>+916624536320</p></div></div>
          <div class="contact-item"><div class="contact-ico">✉️</div><div><h5>Email</h5><p>lawstudents.edu@gmail.com</p></div></div>
        </div>
      </div>
      <form class="form-card reveal" data-d="1" onsubmit="return false;">
        <div class="form-row">
          <div class="field"><label>Full Name</label><input type="text" placeholder="Enter your full name"></div>
          <div class="field"><label>Email Address</label><input type="email" placeholder="Enter your email"></div>
          <div class="field"><label>Phone Number</label><input type="tel" placeholder="Enter your phone number"></div>
          <div class="field"><label>Subject</label><input type="text" placeholder="Subject of your message"></div>
          <div class="field full"><label>Message</label><textarea placeholder="Write your message here"></textarea></div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-gold">Send Message</button>
          <a href="#" class="btn btn-ghost" style="color:#a8842a">WhatsApp Us</a>
        </div>
      </form>
    </div>
  </div>
</section>
<!--===== CONTACT US SECTION ENDS =======-->
@endsection

@section('scripts')
    <script src="{{ asset('assets/theme/js/home.js') }}"></script>
@endsection
