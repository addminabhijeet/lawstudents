@include('layouts.partials.admin.dashboard')
<main class="nxl-container">
    <!-- main containts -->
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Applications</li>
                    <li class="breadcrumb-item">Edit Student Registration</li>
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

        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h2 class="fs-20 fw-bolder">Student Registration</h2>
                            </div>

                            {{-- Display Login Errors and Validation Messages --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.updatestusubmit', $student->id) }}" method="POST" class="mt-4">
                                @csrf

                                <div class="row">

                                    <div class="col-lg-6 mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Full Name" value="{{ old('name', $student->name ?? '') }}"
                                            required>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                            placeholder="Username" value="{{ old('name', $student->username ?? '') }}"
                                            readonly>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Email" value="{{ old('email', $student->email ?? '') }}"
                                            required>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="newPassword" class="form-label">Password</label>
                                        <div class="input-group field">
                                            <input type="password" name="password" class="form-control password"
                                                id="newPassword" placeholder="Password" value="{{ $defaultpassword }}"
                                                required>

                                            <div class="input-group-text border-start bg-gray-2 c-pointer show-pass"
                                                data-bs-toggle="tooltip" title="Show/Hide Password">
                                                <i></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <div class="input-group field">
                                            <input type="password" name="password_confirmation"
                                                class="form-control password" id="confirmPassword"
                                                placeholder="Confirm Password" value="{{ $defaultpassword }}" required>

                                            <div class="input-group-text border-start bg-gray-2 c-pointer show-pass"
                                                id="toggleConfirmPassword" data-bs-toggle="tooltip"
                                                title="Show/Hide Password">
                                                <i class="feather-eye"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Student
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/js/lslstrength.min.js') }}"></script>
        <script src="{{ asset('assets/js/common-init.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>
    </div>
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
</main>
@include('layouts.partials.admin.theme')
