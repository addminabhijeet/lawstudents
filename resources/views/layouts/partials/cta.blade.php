<!--===== AOS ANIMATION FIXES =======-->
<style>
    /* Ensure AOS elements are visible by default */
    [data-aos] {
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
    }

    /* Override AOS initial state */
    body:not(.aos-animate) [data-aos] {
        opacity: 1 !important;
    }

    /* Ensure CTA section is always visible */
    .ca3-scetion-area [data-aos] {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translate(0, 0) !important;
    }

    /* Prevent AOS from hiding elements during filter changes */
    .ca3-scetion-area .cta3-header h2,
    .ca3-scetion-area .cta3-header p,
    .ca3-scetion-area .cta3-header .div {
        opacity: 1 !important;
        visibility: visible !important;
    }
</style>

<!--===== CTA STARTS =======-->
<div class="ca3-scetion-area sp4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="cta3-header text-center">
                    <h2 data-aos="fade-up" data-aos-duration="800">Get in Touch with LawStudent</h2>
                    <p data-aos="fade-up" data-aos-duration="1000">Have questions about our courses, Bare Acts, or study materials? Our team is ready to help you every step of the way in your legal education journey.</p>
                    <div class="div" data-aos="fade-up" data-aos-duration="1200">
                        <a href="{{ route('frontend.contact') }}" class="cta3-btn1">Send Message</a>
                        <a href="{{ route('frontend.contact') }}" class="cta3-btn2">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== CTA ENDS =======-->