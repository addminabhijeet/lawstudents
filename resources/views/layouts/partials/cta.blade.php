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

    /* ===== CTA ORANGE CONTRAST FIX (sitewide) =====
       The compiled theme stylesheet paints this "Get in Touch with LawStudent"
       banner (this partial, included on every page via layouts/landing.blade.php)
       with background: rgb(255,125,0) — its white h2/p text and its white-background
       "Send Message" button (orange text) both land at only ~2.57:1 contrast,
       under the WCAG AA minimum. The same orange, from the same theme rule
       (".inner-pages .contact1-section-area .contact-auhtor-area
       .contact-submit-area .contact-inner button", white text), is reused by the
       Clientele and Contact Us page's submit buttons ("Join Our Client" /
       "Free Case Evaluation"). Since this partial already loads on every page,
       darkening just this one shade here (additive — no existing rule, markup,
       or script above is changed) fixes all of these consistently in one place:
       ~4.6:1 against white, comfortably passing AA, while staying the same
       recognizable brand orange. */
    .ca3-scetion-area {
        background: #c25200 !important;
    }

    .ca3-scetion-area a.cta3-btn1 {
        color: #c25200 !important;
    }

    .inner-pages .contact1-section-area .contact-auhtor-area .contact-submit-area .contact-inner button {
        background: #c25200 !important;
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