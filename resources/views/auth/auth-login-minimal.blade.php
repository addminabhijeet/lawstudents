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
    <title>Law Students</title>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive-fixes.css') }}?v=4">
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
                        <h2 class="fs-20 fw-bolder mb-4 text-center">Login</h2>
                        <p class="text-center mb-4"><a href="{{ route('frontend.home') }}" class="fs-12 fw-bold text-primary">Back to Website</a></p>

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


                        <form action="{{ route('login.submit') }}" method="POST" class="w-100 mt-4 pt-2">
                            @csrf
                            <div class="mb-4">
                                <input type="text" name="login" class="form-control"
                                    placeholder="Email or Username" required>
                            </div>

                            <div class="mb-4 generate-pass">
                                <div class="input-group field">
                                    <input type="password" name="password" class="form-control password"
                                        placeholder="Password" required>
                                    <div class="input-group-text border-start bg-gray-2 c-pointer show-pass"
                                        data-bs-toggle="tooltip" title="Show/Hide Password"><i></i></div>
                                </div>
                            </div>


                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input"
                                            id="rememberMe">
                                        <label class="custom-control-label c-pointer" for="rememberMe">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('student.forgot') }}" class="fs-11 text-primary">Forget
                                        password?</a>
                                </div>
                            </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Login</button>
                            </div>
                        </form>
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
    <script src="assets/vendors/js/vendors.min.js"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <script src="assets/vendors/js/lslstrength.min.js"></script>
    <!--! BEGIN: Apps Init  !-->
    <script src="assets/js/common-init.min.js"></script>
    <!--! END: Apps Init !-->
</body>

</html>
