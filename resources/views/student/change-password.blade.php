@include('layouts.partials.student.dashboard')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Change Password</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Change Password</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h2 class="fs-20 fw-bolder">Change Password</h2>
                                <p class="text-muted">Update your password to keep your account secure</p>
                            </div>

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

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('student.changepassword') }}" class="needs-validation">
                                @csrf

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                                    <input
                                        type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password"
                                        name="current_password"
                                        placeholder="Enter your current password"
                                        required
                                    >
                                    @error('current_password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                                    <input
                                        type="password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        id="new_password"
                                        name="new_password"
                                        placeholder="Enter new password (minimum 8 characters)"
                                        required
                                    >
                                    <small class="form-text text-muted d-block mt-1">
                                        Password must be at least 8 characters long and different from your current password.
                                    </small>
                                    @error('new_password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="new_password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                    <input
                                        type="password"
                                        class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                        id="new_password_confirmation"
                                        name="new_password_confirmation"
                                        placeholder="Confirm your new password"
                                        required
                                    >
                                    @error('new_password_confirmation')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-grid gap-2 d-sm-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="feather-lock me-2"></i>Change Password
                                    </button>
                                    <a href="{{ route('student.dashboard') }}" class="btn btn-secondary btn-lg">
                                        Cancel
                                    </a>
                                </div>
                            </form>

                            <div class="alert alert-info mt-4">
                                <i class="feather-info me-2"></i>
                                <strong>Security Tip:</strong> Use a strong password that is difficult to guess.
                                Include a mix of uppercase and lowercase letters, numbers, and special characters.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.student.theme')
