<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>Law Students || Verify Minimal</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <!--! END: Favicon-->
    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!--! END: Bootstrap CSS-->
    <!--! BEGIN: Vendors CSS-->
    <link rel="stylesheet" type="text/css" href="assets/vendors/css/vendors.min.css">
    <!--! END: Vendors CSS-->
    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/theme.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive-fixes.css') }}?v=3">
    <!--! END: Custom CSS-->
    <!--! HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries !-->
    <!--! WARNING: Respond.js doesn"t work if you view the page via file: !-->
    <!--[if lt IE 9]>
   <script src="https:oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
   <script src="https:oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    <div
                        class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                        <img src="assets/images/logo-abbr.png" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4">
                            Verify
                            <a href="{{ route('student.forgot') }}" class="float-end fs-12 text-primary">Change email</a>
                        </h2>

                        <h4 class="fs-13 fw-bold mb-2">
                            Please enter the code generated one time password to verify your account.
                        </h4>

                        <p class="fs-12 fw-medium text-muted">
                            <span>A code has been sent to</span>
                            <strong>{{ $email }}</strong>
                        </p>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('student.verify-otp.submit') }}" class="w-100 mt-4 pt-2"
                            onsubmit="return combineOtp();">
                            @csrf

                            <!-- Hidden Email -->
                            <input type="hidden" name="email" value="{{ $email }}">

                            <!-- Hidden OTP for backend -->
                            <input type="hidden" name="otp" id="otp_full">

                            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                <input class="m-2 text-center form-control rounded otp-digit" type="text"
                                    inputmode="numeric" pattern="[0-9]*" maxlength="1" required>
                                <input class="m-2 text-center form-control rounded otp-digit" type="text"
                                    inputmode="numeric" pattern="[0-9]*" maxlength="1" required>
                                <input class="m-2 text-center form-control rounded otp-digit" type="text"
                                    inputmode="numeric" pattern="[0-9]*" maxlength="1" required>
                                <input class="m-2 text-center form-control rounded otp-digit" type="text"
                                    inputmode="numeric" pattern="[0-9]*" maxlength="1" required>
                                <input class="m-2 text-center form-control rounded otp-digit" type="text"
                                    inputmode="numeric" pattern="[0-9]*" maxlength="1" required>
                                <input class="m-2 text-center form-control rounded otp-digit" type="text"
                                    inputmode="numeric" pattern="[0-9]*" maxlength="1" required>
                            </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Validate</button>
                            </div>

                            <div class="mt-5 text-muted">
                                <span>Didn't get the code?</span>
                                <button type="submit" form="resendOtpForm" class="btn btn-link p-0 align-baseline fw-semibold">
                                    Resend code
                                </button>
                            </div>
                        </form>

                        {{-- Resend: posts the same email to the existing send-code route. --}}
                        <form id="resendOtpForm" method="POST" action="{{ route('student.send-otp') }}" class="d-none">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                        </form>
                    </div>

                    <script>
                        function combineOtp() {
                            let otp = '';
                            document.querySelectorAll('.otp-digit').forEach(input => {
                                otp += input.value;
                            });

                            document.getElementById('otp_full').value = otp;
                            return true;
                        }
                    </script>

                </div>
            </div>
        </div>
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! Footer Script !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Vendors JS !-->
    <script src="assets/vendors/js/vendors.min.js"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <!--! END: Vendors JS !-->
    <!--! BEGIN: Apps Init  !-->
    <script src="assets/js/common-init.min.js"></script>
    <!--! END: Apps Init !-->
    <!--! BEGIN: Theme Customizer  !--><!--! END: Theme Customizer !-->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function OTPInput() {

                const container = document.querySelector('#otp');
                if (!container) return;

                const inputs = container.querySelectorAll('.otp-digit');

                inputs.forEach((input, index) => {

                    input.addEventListener('input', function() {

                        this.value = this.value.replace(/[^0-9]/g, '');

                        // Move focus to next input
                        if (this.value.length === 1 && index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }

                        // If last input and filled, auto submit form
                        if (index === inputs.length - 1 && this.value.length === 1) {
                            combineOtp();
                            input.closest('form').submit();
                        }

                    });
                    
                    input.addEventListener('keydown', function(e) {

                        if (e.key === "Backspace" && this.value === '' && index > 0) {
                            inputs[index - 1].focus();
                        }

                    });

                    input.addEventListener('paste', function(e) {

                        let pasteData = (e.clipboardData || window.clipboardData).getData('text');
                        pasteData = pasteData.replace(/[^0-9]/g, '').slice(0, inputs.length);

                        if (pasteData.length > 1) {

                            inputs.forEach((input, i) => {
                                input.value = pasteData[i] || '';
                            });

                            e.preventDefault();
                        }

                    });

                });

                if (inputs.length) {
                    inputs[0].focus();
                }
            }

            OTPInput();

        });
    </script>
    <script>
        function combineOtp() {

            let otp = '';

            document.querySelectorAll('#otp .otp-digit').forEach(input => {
                otp += input.value;
            });

            document.getElementById('otp_full').value = otp;

            return true;
        }
    </script>
</body>

</html>
