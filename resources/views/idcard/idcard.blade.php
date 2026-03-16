@include('layouts.partials.admin.dashboard')
<main class="nxl-container">
    <div class="nxl-content">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">ID Card</li>
                    <li class="breadcrumb-item">View</li>
                </ul>
            </div>
        </div>

        <div class="main-content container-lg py-5">

            <div class="row justify-content-center">

                <div class="col-auto">

                    <!-- PVC CARD -->
                    <div class="card shadow border-0" style="width:260px; min-height:430px; overflow:hidden;">

                        <!-- TOP STRIPE -->
                        <div class="bg-primary text-white text-center py-2">

                            <img src="{{ asset('assets/images/logo.png') }}" height="28" class="mb-1">

                            <div style="font-size:12px;font-weight:600;">
                                STUDENT ID CARD
                            </div>

                            <div style="font-size:10px;opacity:0.9;">
                                Official Identification
                            </div>

                        </div>


                        <!-- BODY -->
                        <div class="card-body text-center py-3">

                            <!-- PHOTO -->
                            <div class="d-flex justify-content-center mb-2">

                                <div class="d-flex align-items-center justify-content-center bg-light rounded-circle shadow"
                                    style="width:80px;height:80px;">

                                    <i class="feather-user" style="font-size:32px;"></i>

                                </div>

                            </div>


                            <!-- NAME -->
                            <div style="font-weight:600;font-size:14px;">
                                {{ $idcard->to_name }}
                            </div>

                            @php
                                $statusColor = match ($idcard->payment_status) {
                                    'paid' => 'bg-success',
                                    'failed' => 'bg-danger',
                                    'cancelled' => 'bg-secondary',
                                    default => 'bg-warning',
                                };
                            @endphp

                            <span class="badge {{ $statusColor }}" style="font-size:9px;">
                                {{ ucfirst($idcard->payment_status) }}
                            </span>

                            <hr class="my-2">


                            <!-- STUDENT INFO -->
                            <div class="text-start px-2" style="font-size:11px;">

                                <div class="mb-1">
                                    <strong>ID :</strong>
                                    {{ $idcard->invoice_number }}
                                </div>

                                <div class="mb-1">
                                    <strong>Email :</strong>
                                    {{ $idcard->to_email }}
                                </div>

                                <div class="mb-1">
                                    <strong>Phone :</strong>
                                    {{ $idcard->to_phone }}
                                </div>

                                <div class="mb-1">
                                    <strong>Issue :</strong>
                                    {{ optional($idcard->issue_date)->format('d M Y') }}
                                </div>

                            </div>


                            <hr class="my-2">


                            <!-- COURSE + QR -->
                            <div class="row align-items-center">

                                <div class="col-7 text-start">

                                    <div style="font-size:10px;font-weight:600;">
                                        Course
                                    </div>

                                </div>

                                <div class="col-5 text-end">

                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=70x70&data={{ $idcard->invoice_number }}"
                                        width="55" height="55">

                                </div>

                            </div>

                        </div>


                        <!-- FOOTER STRIP -->
                        <div class="bg-light text-center py-2">

                            <small class="text-muted" style="font-size:9px;">
                                Scan QR to verify student ID
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</main>
@include('layouts.partials.admin.theme')
