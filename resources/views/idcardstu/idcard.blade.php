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

                <div class="col-md-4">

                    <!-- PVC CARD -->
                    <div class="card shadow border-0">

                        <!-- HEADER -->
                        <div class="card-header bg-primary text-white text-center py-2">

                            <div class="d-flex justify-content-center align-items-center gap-2">

                                <img src="{{ asset('assets/images/logo.png') }}" height="30">

                                <div class="text-start">
                                    <strong>STUDENT ID CARD</strong>
                                    <div style="font-size:11px">Official Identification</div>
                                </div>

                            </div>

                        </div>


                        <!-- BODY -->
                        <div class="card-body py-3">

                            <div class="row">

                                <!-- PHOTO -->
                                <div class="col-4 text-center">

                                    <img src="{{ asset('assets/images/user/avatar-1.jpg') }}" class="rounded shadow"
                                        width="90" height="90">

                                    @php
                                        $statusColor = match ($idcard->payment_status) {
                                            'paid' => 'bg-success',
                                            'failed' => 'bg-danger',
                                            'cancelled' => 'bg-secondary',
                                            default => 'bg-warning',
                                        };
                                    @endphp

                                    <span class="badge {{ $statusColor }} mt-1">
                                        {{ ucfirst($idcard->payment_status) }}
                                    </span>

                                </div>


                                <!-- DETAILS -->
                                <div class="col-8">

                                    <h6 class="fw-bold mb-1">
                                        {{ $idcard->to_name }}
                                    </h6>

                                    <div class="text-muted mb-1" style="font-size:12px">
                                        {{ ucfirst(str_replace('_', ' ', $idcard->payment_method)) }}
                                    </div>

                                    <div style="font-size:12px">

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

                            <hr class="my-2">

                            <!-- COURSE + QR -->
                            <div class="row align-items-center">

                                <div class="col-7">

                                    <div style="font-size:12px">
                                        <strong>Course</strong>
                                    </div>

                                    <div class="text-muted" style="font-size:12px">
                                        {{ ucfirst(str_replace('_', ' ', $idcard->payment_method)) }}
                                    </div>

                                </div>


                                <!-- QR -->
                                <div class="col-5 text-end">

                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=70x70&data={{ $idcard->invoice_number }}"
                                        width="70" height="70">

                                </div>

                            </div>

                        </div>


                        <!-- FOOTER -->
                        <div class="card-footer text-center bg-light py-2">

                            <small style="font-size:11px" class="text-muted">
                                Scan QR to verify student
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</main>
@include('layouts.partials.student.theme')
