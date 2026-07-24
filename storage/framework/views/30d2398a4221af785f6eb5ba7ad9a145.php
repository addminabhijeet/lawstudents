<?php echo $__env->make('layouts.partials.admin.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                <!-- Total Students -->
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
                                            <span class="counter"><?php echo e($studentsCount); ?></span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Students</h3>
                                    </div>
                                </div>
                                <a href="javascript:void(0);">
                                    <i class="feather-more-vertical"></i>
                                </a>
                            </div>

                            <div class="pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fs-12 fw-medium text-muted text-truncate-1-line">Students</span>
                                    <div class="w-100 text-end">
                                        <span class="fs-12 text-dark"><?php echo e($studentsCount); ?></span>
                                    </div>
                                </div>
                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Admissions -->
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
                                            <span class="counter"><?php echo e($admissionsCount); ?></span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Admissions</h3>
                                    </div>
                                </div>
                                <a href="javascript:void(0);">
                                    <i class="feather-more-vertical"></i>
                                </a>
                            </div>

                            <div class="pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fs-12 fw-medium text-muted">Admissions</span>
                                    <div class="w-100 text-end">
                                        <span class="fs-12 text-dark"><?php echo e($admissionsCount); ?></span>
                                    </div>
                                </div>
                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Payments -->
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
                                            <span class="counter"><?php echo e($paymentsCount); ?></span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Payments</h3>
                                    </div>
                                </div>
                                <a href="javascript:void(0);">
                                    <i class="feather-more-vertical"></i>
                                </a>
                            </div>

                            <div class="pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fs-12 fw-medium text-muted">Payments</span>
                                    <div class="w-100 text-end">
                                        <span class="fs-12 text-dark"><?php echo e($paymentsCount); ?></span>
                                    </div>
                                </div>
                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total ID Cards -->
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
                                            <span class="counter"><?php echo e($idCardsCount); ?></span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total ID Cards</h3>
                                    </div>
                                </div>
                                <a href="javascript:void(0);">
                                    <i class="feather-more-vertical"></i>
                                </a>
                            </div>

                            <div class="pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fs-12 fw-medium text-muted">ID Cards</span>
                                    <div class="w-100 text-end">
                                        <span class="fs-12 text-dark"><?php echo e($idCardsCount); ?></span>
                                    </div>
                                </div>
                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Courses -->
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
                                            <span class="counter"><?php echo e($coursesCount); ?></span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Courses</h3>
                                    </div>
                                </div>
                                <a href="javascript:void(0);">
                                    <i class="feather-more-vertical"></i>
                                </a>
                            </div>

                            <div class="pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fs-12 fw-medium text-muted">Courses</span>
                                    <div class="w-100 text-end">
                                        <span class="fs-12 text-dark"><?php echo e($coursesCount); ?></span>
                                    </div>
                                </div>
                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Notes -->
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
                                            <span class="counter"><?php echo e($notesCount); ?></span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Notes</h3>
                                    </div>
                                </div>
                                <a href="javascript:void(0);">
                                    <i class="feather-more-vertical"></i>
                                </a>
                            </div>

                            <div class="pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fs-12 fw-medium text-muted">Notes</span>
                                    <div class="w-100 text-end">
                                        <span class="fs-12 text-dark"><?php echo e($notesCount); ?></span>
                                    </div>
                                </div>
                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
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
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\lawstudents\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>