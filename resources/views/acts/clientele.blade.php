@extends('layouts.landing', ['title' => 'Law Students'])

@section('content')
    <!--===== WELCOME STARTS =======-->
    <div class="welcome-inner-section-area"
        style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 m-auto">
                    <div class="welcome-inner-header text-center">
                        <h1>Client</h1>
                        <a href="">Home <span><i class="fa-light fa-angle-right"></i></span>Client</a>
                        <img src="/img/elements/elementor20.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== WELCOME ENDS =======-->

    <!--===== BLOG STARTS =======-->
    <div class="contact1-section-area sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-auhtor-area contact2">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="contact-submit-area">
                                    <h3>Join Our Client Network</h3>
                                    <p>We respond within 30 minutes during business hours to guide you better</p>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="number" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="email" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <input type="text"
                                                    placeholder="Interested Course (Criminal / Corporate / Traffic Law)">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <textarea placeholder="Tell us about your learning goals or queries" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <button type="submit">Join Our client <i
                                                        class="fa-light fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="contact-content-area">
                                    <h2>Our Esteemed client & Learners</h2>
                                    <p>
                                        At Law Students, we take pride in serving a diverse client including aspiring
                                        lawyers,
                                        law students, working professionals, and legal enthusiasts. Our courses are trusted
                                        by individuals
                                        who aim to build a strong foundation in legal studies and advance their careers in
                                        law.
                                    </p>
                                    <p>
                                        Our client includes students preparing for judiciary exams, professionals
                                        enhancing their legal
                                        expertise, and individuals seeking practical knowledge in criminal, corporate, and
                                        traffic law.
                                        We are committed to delivering high-quality education and real-world insights to
                                        every learner.
                                    </p>

                                    <!-- Grid Wrapper -->
                                    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">
                                        @foreach ($clienteles as $clientele)
                                            @if (is_array(json_decode($clientele->pdfs)))
                                                @foreach (json_decode($clientele->pdfs) as $pdf)
                                                    <a href="{{ asset('storage/app/public/' . $pdf) }}" class="welcome-btn3"
                                                        target="_blank">
                                                        {{ $clientele->description }}<i class="fa-light fa-arrow-right"></i>
                                                    </a>
                                                @endforeach
                                            @else
                                                <a href="{{ asset('storage/app/public/' . $clientele->pdfs) }}"
                                                    class="welcome-btn3" target="_blank">
                                                    {{ $clientele->description }}<i class="fa-light fa-arrow-right"></i>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
