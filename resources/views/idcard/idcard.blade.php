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
                    <li class="breadcrumb-item">ID Card</li>
                    <li class="breadcrumb-item">View</li>
                </ul>
            </div>
        </div>
        <div id="collapseOne" class="accordion-collapse collapse page-header-collapse">
            <div class="accordion-body pb-2">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Paid</span>
                                        <span class="fs-20 fw-bold d-block">78/100</span>
                                    </a>
                                    <div class="badge bg-soft-success text-success">
                                        <i class="feather-arrow-up fs-10 me-1"></i>
                                        <span>36.85%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Unpaid</span>
                                        <span class="fs-20 fw-bold d-block">38/50</span>
                                    </a>
                                    <div class="badge bg-soft-danger text-danger">
                                        <i class="feather-arrow-down fs-10 me-1"></i>
                                        <span>23.45%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Overdue</span>
                                        <span class="fs-20 fw-bold d-block">15/30</span>
                                    </a>
                                    <div class="badge bg-soft-success text-success">
                                        <i class="feather-arrow-up fs-10 me-1"></i>
                                        <span>25.44%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Draft</span>
                                        <span class="fs-20 fw-bold d-block">3/10</span>
                                    </a>
                                    <div class="badge bg-soft-danger text-danger">
                                        <i class="feather-arrow-down fs-10 me-1"></i>
                                        <span>12.68%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content container-lg py-5">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow-lg border-0" style="border-radius:15px; overflow:hidden;">

                        <!-- Header -->
                        <div class="card-header text-center bg-primary text-white py-4">
                            <h4 class="mb-0 fw-bold">ID CARD</h4>
                        </div>

                        <!-- Body -->
                        <div class="card-body text-center">

                            <!-- Profile Image (Optional Placeholder) -->
                            <div class="mb-3">
                                <img src="{{ asset('assets/images/user/avatar-1.jpg') }}"
                                    class="rounded-circle shadow" width="120" height="120" alt="User">
                            </div>

                            <h5 class="fw-bold text-dark mb-1">
                                {{ $idcard->to_name }}
                            </h5>

                            <p class="text-muted mb-2">
                                {{ ucfirst(str_replace('_', ' ', $idcard->payment_method)) }}
                            </p>

                            <hr>

                            <div class="text-start px-4">

                                <div class="mb-2">
                                    <strong>ID No :</strong>
                                    <span class="text-muted">
                                        {{ $idcard->invoice_number }}
                                    </span>
                                </div>

                                <div class="mb-2">
                                    <strong>Email :</strong>
                                    <span class="text-muted">
                                        {{ $idcard->to_email }}
                                    </span>
                                </div>

                                <div class="mb-2">
                                    <strong>Phone :</strong>
                                    <span class="text-muted">
                                        {{ $idcard->to_phone }}
                                    </span>
                                </div>

                                <div class="mb-2">
                                    <strong>Status :</strong>
                                    @php
                                        $statusColor = match ($idcard->payment_status) {
                                            'paid' => 'text-success',
                                            'failed' => 'text-danger',
                                            'cancelled' => 'text-secondary',
                                            default => 'text-warning',
                                        };
                                    @endphp

                                    <span class="fw-bold {{ $statusColor }}">
                                        {{ ucfirst($idcard->payment_status) }}
                                    </span>
                                </div>

                                <div class="mb-2">
                                    <strong>Issue Date :</strong>
                                    <span class="text-muted">
                                        {{ optional($idcard->issue_date)->format('d M, Y') }}
                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer text-center bg-light py-3">
                            <small class="text-muted">
                                This is a system generated ID Card.
                            </small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')
