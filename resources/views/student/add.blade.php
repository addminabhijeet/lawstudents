@include('layouts.partials.admin.dashboard')
<main class="nxl-container">
    <!-- main containts -->
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Proposal</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Create</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="javascript:void(0);" class="btn btn-light-brand" data-bs-toggle="offcanvas"
                            data-bs-target="#proposalSent">
                            <i class="feather-layers me-2"></i>
                            <span>Save & Send</span>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-primary successAlertMessage">
                            <i class="feather-save me-2"></i>
                            <span>Save</span>
                        </a>
                    </div>
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <main class="auth-minimal-wrapper">
            <div class="auth-minimal-inner">
                <div class="minimal-card-wrapper">
                    <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                        <div
                            class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                            <img src="assets/images/logo-abbr.png" alt="" class="img-fluid">
                        </div>
                        <div class="card-body p-sm-5">
                            <h2 class="fs-20 fw-bolder mb-4">Register</h2>
                            <h4 class="fs-13 fw-bold mb-2">Manage all your Duralux crm</h4>
                            <p class="fs-12 fw-medium text-muted">Let's get you all setup, so you can verify your
                                personal
                                account and begine setting up your profile.</p>

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

                            <form action="{{ route('admin.registerstusubmit') }}" method="POST"
                                class="w-100 mt-4 pt-2">
                                @csrf
                                <div class="mb-4">
                                    <input type="text" name="name" class="form-control" placeholder="Full Name"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="username" class="form-control" placeholder="Username"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        required>
                                </div>
                                <div class="mb-4 generate-pass">
                                    <div class="input-group field">
                                        <input type="password" name="password" class="form-control password"
                                            id="newPassword" placeholder="Password" required>
                                        <div class="input-group-text c-pointer gen-pass" data-bs-toggle="tooltip"
                                            title="Generate Password"><i class="feather-hash"></i></div>
                                        <div class="input-group-text border-start bg-gray-2 c-pointer show-pass"
                                            data-bs-toggle="tooltip" title="Show/Hide Password"><i></i></div>
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Confirm Password" required>
                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="btn btn-lg btn-primary w-100">Create Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="assets/vendors/js/vendors.min.js"></script>
        <!-- vendors.min.js {always must need to be top} -->
        <script src="assets/vendors/js/lslstrength.min.js"></script>
        <!--! END: Vendors JS !-->
        <!--! BEGIN: Apps Init  !-->
        <script src="assets/js/common-init.min.js"></script>
        <!--! END: Apps Init !-->
        <!--! BEGIN: Theme Customizer  !-->
        <script src="assets/js/theme-customizer-init.min.js"></script>
        <!--! END: Theme Customizer !-->
        <!-- [ Main Content ] end -->
    </div>
    @include('layouts.partials.admin.footer')
</main>
@include('layouts.partials.admin.theme')