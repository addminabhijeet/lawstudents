@php
    $setting = $mailsetting ? $mailsetting->first() : null;
@endphp

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
                    <li class="breadcrumb-item">Setting</li>
                    <li class="breadcrumb-item">Mail</li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full shadow-sm border-0">

                        <div class="card-header text-white">
                            <h5 class="mb-0">Mail Settings</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.updatemailsetting', $mailsetting->id ?? 1) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="mb-3">
                                    <label>Mail Host</label>
                                    <input type="text" name="mail_host" class="form-control"
                                        value="{{ $mailsetting->mail_host ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label>Mail Port</label>
                                    <input type="number" name="mail_port" class="form-control"
                                        value="{{ $mailsetting->mail_port ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label>Username</label>
                                    <input type="text" name="mail_username" class="form-control"
                                        value="{{ $mailsetting->mail_username ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="text" name="mail_password" class="form-control"
                                        value="{{ $mailsetting->mail_password ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label>Encryption</label>
                                    <input type="text" name="mail_encryption" class="form-control"
                                        value="{{ $mailsetting->mail_encryption ?? 'tls' }}">
                                </div>

                                <div class="mb-3">
                                    <label>From Email</label>
                                    <input type="email" name="mail_from_address" class="form-control"
                                        value="{{ $mailsetting->mail_from_address ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label>From Name</label>
                                    <input type="text" name="mail_from_name" class="form-control"
                                        value="{{ $mailsetting->mail_from_name ?? '' }}">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')
