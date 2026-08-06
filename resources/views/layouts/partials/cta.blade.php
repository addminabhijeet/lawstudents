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
                    <h2 data-aos="fade-up" data-aos-duration="800" style="opacity: 1 !important; visibility: visible !important;">Ready to Start Your Legal Career?</h2>
                    <p data-aos="fade-up" data-aos-duration="1000" style="opacity: 1 !important; visibility: visible !important;">
                        Join our comprehensive law courses and learn from experienced instructors. Gain the knowledge and skills needed to excel in the legal profession.
                    </p>
                    <div class="div" data-aos="fade-up" data-aos-duration="1200" style="opacity: 1 !important; visibility: visible !important;">
                        <a href="" class="cta3-btn1">Enroll in a Course</a>
                        <a href="" class="cta3-btn2">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== CTA ENDS =======-->