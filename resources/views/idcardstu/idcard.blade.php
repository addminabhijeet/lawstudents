@include('layouts.partials.student.dashboard')
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

                    <!-- REAL PVC CARD SIZE -->
                    <div style="width:85.6mm;height:54mm;">

                        <div class="card shadow border-0 h-100">

                            <!-- HEADER -->
                            <div class="card-header bg-primary text-white text-center py-1">

                                <div class="d-flex justify-content-center align-items-center gap-2">

                                    <img src="{{ asset('assets/images/logo.png') }}" height="22">

                                    <div class="text-start">
                                        <strong style="font-size:12px;">STUDENT ID CARD</strong>
                                        <div style="font-size:9px">Official Identification</div>
                                    </div>

                                </div>

                            </div>


                            <!-- BODY -->
                            <div class="card-body py-1">

                                <div class="row">

                                    <!-- PHOTO -->
                                    <div class="col-4 text-center">

                                        <div class="d-flex align-items-center justify-content-center bg-light rounded shadow"
                                            style="width:60px;height:60px;margin:auto;">

                                            <i class="feather-user" style="font-size:28px;"></i>

                                        </div>

                                        @php
                                            $statusColor = match ($idcard->payment_status) {
                                                'paid' => 'bg-success',
                                                'failed' => 'bg-danger',
                                                'cancelled' => 'bg-secondary',
                                                default => 'bg-warning',
                                            };
                                        @endphp

                                        <span class="badge {{ $statusColor }}" style="font-size:8px;">
                                            {{ ucfirst($idcard->payment_status) }}
                                        </span>

                                    </div>


                                    <!-- DETAILS -->
                                    <div class="col-8">

                                        <h6 class="fw-bold mb-0" style="font-size:12px;">
                                            {{ $idcard->to_name }}
                                        </h6>

                                        <div class="text-muted mb-1" style="font-size:10px">
                                            {{ ucfirst(str_replace('_', ' ', $idcard->payment_method)) }}
                                        </div>

                                        <div style="font-size:9px">

                                            <div>
                                                <strong>ID:</strong>
                                                {{ $idcard->invoice_number }}
                                            </div>

                                            <div>
                                                <strong>Email:</strong>
                                                {{ $idcard->to_email }}
                                            </div>

                                            <div>
                                                <strong>Phone:</strong>
                                                {{ $idcard->to_phone }}
                                            </div>

                                            <div>
                                                <strong>Issue:</strong>
                                                {{ optional($idcard->issue_date)->format('d M Y') }}
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <hr class="my-1">

                                <!-- COURSE + QR -->
                                <div class="row align-items-center">

                                    <div class="col-7">

                                        <div style="font-size:9px">
                                            <strong>Course</strong>
                                        </div>

                                        <div class="text-muted" style="font-size:9px">
                                            {{ ucfirst(str_replace('_', ' ', $idcard->payment_method)) }}
                                        </div>

                                    </div>


                                    <!-- QR -->
                                    <div class="col-5 text-end">

                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&data={{ $idcard->invoice_number }}"
                                            width="50" height="50">

                                    </div>

                                </div>

                            </div>


                            <!-- FOOTER -->
                            <div class="card-footer text-center bg-light py-1">

                                <small style="font-size:8px" class="text-muted">
                                    Scan QR to verify
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</main>
@include('layouts.partials.student.theme')
