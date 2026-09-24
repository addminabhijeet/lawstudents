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
    <title>Law Students || Reset Password</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive-fixes.css') }}?v=3">

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
                        <img src="{{ asset('assets/images/logo-abbr.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4">Reset Password</h2>
                        <h4 class="fs-13 fw-bold mb-2">Choose a new password</h4>
                        <p class="fs-12 fw-medium text-muted">Enter a new password for your account, then confirm it.
                            Use at least 6 characters.</p>

                        {{-- Display Login Errors and Validation Messages --}}
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

                        <form action="{{ route('student.reset-password.submit', $student) }}" method="POST"
                            class="w-100 mt-4 pt-2">


                            @csrf
                            <div class="mb-4">
                                <input type="text" name="name" class="form-control" value="{{ $student->name }}"
                                    readonly>
                            </div>

                            <div class="mb-4">
                                <input type="text" name="username" class="form-control"
                                    value="{{ $student->username }}" readonly>
                            </div>

                            <div class="mb-4">
                                <input type="email" name="email" class="form-control" value="{{ $student->email }}"
                                    readonly>
                            </div>

                            <div class="mb-4 generate-pass">
                                <div class="input-group field">
                                    <input type="password" name="password" class="form-control password"
                                        id="newPassword" placeholder="Password" required>
                                    <div class="input-group-text border-start bg-gray-2 c-pointer show-pass"
                                        data-bs-toggle="tooltip" title="Show/Hide Password"><i></i></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="input-group field">
                                    <input type="password" name="password_confirmation" class="form-control password"
                                        id="confirmPassword" placeholder="Confirm Password" required>
                                    <div class="input-group-text border-start bg-gray-2 c-pointer show-pass"
                                        id="toggleConfirmPassword" data-bs-toggle="tooltip" title="Show/Hide Password">
                                        <i class="feather-eye"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Reset Password</button>
                            </div>
                        </form>

                        <div class="mt-5 text-muted">
                            <span>Remembered your password?</span>
                            <a href="{{ route('login') }}" class="fw-bold">Login</a>
                        </div>
                    </div>
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
    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/lslstrength.min.js') }}"></script>
    <script src="{{ asset('assets/js/common-init.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function togglePassword(toggleId, inputId) {
                let toggle = document.getElementById(toggleId);
                let input = document.getElementById(inputId);

                if (toggle && input) {
                    toggle.addEventListener('click', function() {
                        input.type = input.type === 'password' ? 'text' : 'password';
                    });
                }
            }

            togglePassword('toggleNewPassword', 'newPassword');
            togglePassword('toggleConfirmPassword', 'confirmPassword');
        });
    </script>
</body>

</html>
