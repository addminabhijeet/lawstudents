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
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item">Count View</li>
                </ul>
            </div>
            
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <!-- [Total Students] start -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                    <div class="avatar-text avatar-lg bg-gray-200">
                                        <i class="feather-users"></i>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-dark">
                                            <span class="counter">{{ $studentsCount }}</span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Students</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [Total Students] end -->

                <!-- Repeat similar structure for Admissions -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                    <div class="avatar-text avatar-lg bg-gray-200">
                                        <i class="feather-file-text"></i>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-dark">
                                            <span class="counter">{{ $admissionsCount }}</span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Admissions</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payments -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                    <div class="avatar-text avatar-lg bg-gray-200">
                                        <i class="feather-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-dark">
                                            <span class="counter">{{ $paymentsCount }}</span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Payments</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ID Cards -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                    <div class="avatar-text avatar-lg bg-gray-200">
                                        <i class="feather-credit-card"></i>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-dark">
                                            <span class="counter">{{ $idCardsCount }}</span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total ID Cards</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                    <div class="avatar-text avatar-lg bg-gray-200">
                                        <i class="feather-book"></i>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-dark">
                                            <span class="counter">{{ $coursesCount }}</span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Courses</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                    <div class="avatar-text avatar-lg bg-gray-200">
                                        <i class="feather-file"></i>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-dark">
                                            <span class="counter">{{ $notesCount }}</span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Notes</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</main>
@include('layouts.partials.admin.theme')
