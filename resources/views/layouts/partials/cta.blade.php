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

<!--===== GET IN TOUCH STARTS =======-->
@php
    use App\Models\WhatsappSetting;

    $ctaUser = \App\Models\User::first();
    $ctaAddress = !empty($ctaUser->webaddress) ? $ctaUser->webaddress : 'email@gmail.com';
    $ctaEmail = !empty($ctaUser->webemail) ? $ctaUser->webemail : 'email@gmail.com';
    $ctaMobile = !empty($ctaUser->mobile) ? $ctaUser->mobile : '9876543210';
    $ctaWhatsapp = WhatsappSetting::latest()->first();
    $ctaWhatsappNumber = $ctaWhatsapp ? $ctaWhatsapp->whatsapp_number : $ctaMobile;
    $ctaWebsite = config('app.url');
@endphp

<div class="contact1-section-area sp1" id="get-in-touch">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cta3-header text-center">
                    <h2 data-aos="fade-up" data-aos-duration="800" style="opacity: 1 !important; visibility: visible !important;">Get in Touch with LawStudent</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="contact-box-area" data-aos="fade-up" data-aos-duration="1000" style="opacity: 1 !important; visibility: visible !important;">
                    <div class="contact-widget-area">
                        <div class="clock-img">
                            <img src="/img/icons/footer-location1.svg" alt="">
                        </div>
                        <div class="content">
                            <h4>Address</h4>
                            <a>{{ $ctaAddress }}</a>
                        </div>
                    </div>
                </div>

                <div class="contact-box-area" data-aos="fade-up" data-aos-duration="1100" style="opacity: 1 !important; visibility: visible !important;">
                    <div class="contact-widget-area">
                        <div class="clock-img">
                            <img src="/img/icons/phone2.svg" alt="">
                        </div>
                        <div class="content">
                            <h4>Phone</h4>
                            <a href="tel:{{ $ctaMobile }}">{{ $ctaMobile }}</a>
                        </div>
                    </div>
                </div>

                <div class="contact-box-area" data-aos="fade-up" data-aos-duration="1200" style="opacity: 1 !important; visibility: visible !important;">
                    <div class="contact-widget-area">
                        <div class="clock-img">
                            <i class="fa-brands fa-whatsapp" style="font-size: 28px; color: #070812;"></i>
                        </div>
                        <div class="content">
                            <h4>WhatsApp</h4>
                            <a href="https://wa.me/{{ $ctaWhatsappNumber }}" target="_blank">{{ $ctaWhatsappNumber }}</a>
                        </div>
                    </div>
                </div>

                <div class="contact-box-area" data-aos="fade-up" data-aos-duration="1300" style="opacity: 1 !important; visibility: visible !important;">
                    <div class="contact-widget-area">
                        <div class="clock-img">
                            <img src="/img/icons/footer-email2.svg" alt="">
                        </div>
                        <div class="content">
                            <h4>Email</h4>
                            <a href="mailto:{{ $ctaEmail }}">{{ $ctaEmail }}</a>
                        </div>
                    </div>
                </div>

                <div class="contact-box-area" data-aos="fade-up" data-aos-duration="1400" style="opacity: 1 !important; visibility: visible !important;">
                    <div class="contact-widget-area">
                        <div class="clock-img">
                            <i class="fa-solid fa-globe" style="font-size: 28px; color: #070812;"></i>
                        </div>
                        <div class="content">
                            <h4>Website</h4>
                            <a href="{{ $ctaWebsite }}" target="_blank">{{ $ctaWebsite }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="contact-submit-area" data-aos="fade-up" data-aos-duration="1000" style="opacity: 1 !important; visibility: visible !important;">
                    <form action="{{ route('frontend.contactstore') }}" method="POST">
                        @csrf
                        <input type="hidden" name="last_name" value="-">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-inner">
                                    <input type="text" name="first_name" id="cta_name" placeholder="Name" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="contact-inner">
                                    <input type="email" name="email" id="cta_email" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="contact-inner">
                                    <input type="text" name="phone" id="cta_mobile" placeholder="Mobile"
                                        pattern="[0-9]{10}" maxlength="10" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="contact-inner">
                                    <input type="text" name="service_type" id="cta_subject" placeholder="Subject" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="contact-inner">
                                    <textarea name="message" id="cta_message" placeholder="Message" cols="30" rows="6" required></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="contact-inner">
                                    <button type="submit">
                                        Send Message
                                        <i class="fa-light fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== GET IN TOUCH ENDS =======-->