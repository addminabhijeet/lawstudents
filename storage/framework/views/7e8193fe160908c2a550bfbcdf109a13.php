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
                    <li class="breadcrumb-item">Applications</li>
                    <li class="breadcrumb-item">List Admissions</li>
                </ul>
            </div>
        </div>

        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">

                            <div class="table-responsive">

                                <table class="table table-hover" id="paymentList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Adm. no.</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $admissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $admission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="single-item">
                                                <td>
                                                    <?php echo e($loop->iteration); ?>

                                                </td>

                                                <td>
                                                    <div class="fw-bold">
                                                        <?php echo e($admission->admno); ?>

                                                    </div>
                                                </td>

                                                <td>
                                                    <div>
                                                        <small class="fs-12 fw-normal text-muted">
                                                            <?php echo e($admission->email ?? '-'); ?>

                                                        </small>
                                                    </div>
                                                </td>

                                                <td class="fw-bold text-dark">
                                                    <?php echo e($admission->full_name); ?>

                                                </td>

                                                <td>
                                                    <?php echo e(\Carbon\Carbon::parse($admission->created_at)->format('Y-m-d h:iA')); ?>

                                                </td>

                                                <td>
                                                    <div class="badge bg-soft-success text-success">
                                                        <?php echo e($admission->admission_status); ?>

                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">

                                                        <a href="<?php echo e(route('admin.showadmission', $admission->id)); ?>"
                                                            class="avatar-text avatar-md">
                                                            <i class="feather feather-eye"></i>
                                                        </a>

                                                        <a href="<?php echo e(route('admin.editadmission', $admission->id)); ?>"
                                                            class="avatar-text avatar-md">
                                                            <i class="feather feather-edit"></i>
                                                        </a>

                                                        <form
                                                            action="<?php echo e(route('admin.destroyadmission', $admission->id)); ?>"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this admission?');">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button
                                                                class="avatar-text avatar-md border-0 bg-transparent">
                                                                <i class="feather feather-trash-2 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($admissions->isEmpty()): ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No Admissions found.
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item <?php echo e($admissions->onFirstPage() ? 'disabled' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($admissions->previousPageUrl()); ?>"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            <?php $__currentLoopData = $admissions->getUrlRange(1, $admissions->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li
                                                    class="page-item <?php echo e($admissions->currentPage() == $page ? 'active' : ''); ?>">
                                                    <a class="page-link"
                                                        href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <!-- Next Page -->
                                            <li class="page-item <?php echo e(!$admissions->hasMorePages() ? 'disabled' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($admissions->nextPageUrl()); ?>"
                                                    aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="visually-hidden">Next</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

</main>
<div class="offcanvas offcanvas-end" tabindex="-1" id="paymentSent">
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <div>
            <h2 class="fs-16 fw-bold text-truncate-1-line">Sent Payment</h2>
            <small class="fs-12 text-muted">Sent payment to your client's</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div
        class="py-3 px-4 d-flex justify-content-between align-items-center border-bottom border-bottom-dashed border-gray-5 bg-gray-100">
        <div>
            <span class="fw-bold text-dark">Date:</span>
            <span class="fs-11 fw-medium text-muted">25 MAY, 2023</span>
        </div>
        <div>
            <span class="fw-bold text-dark">Payment No:</span>
            <span class="fs-12 fw-bold text-primary c-pointer">#NXL369852</span>
        </div>
    </div>
    <div class="offcanvas-body">
        <div class="form-group mb-4">
            <label class="form-label">From: <span class="text-danger">*</span></label>
            <input type="email" class="form-control" value="wrapcode.info@gmail.com" placeholder="Clients..."
                readonly="" required>
        </div>
        <div class="form-group mb-4">
            <label class="form-label">To: <span class="text-danger">*</span></label>
            <input class="form-control" name="tomailcontent" value="wrapcode.info@gmail.com" placeholder="To..."
                required>
        </div>
        <div class="form-group mb-4">
            <label class="form-label">Subject: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Subject..." required>
        </div>
        <div class="form-group mb-4">
            <label class="form-label">URL: </label>
            <input type="url" class="form-control" placeholder="URL...">
        </div>
        <div class="form-group">
            <label class="form-label">Messages:</label>
            <div data-editor-target="editor" class="ht-200"></div>
        </div>
    </div>
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-primary w-50" data-alert-target="alertMessage">Sent Payment</a>
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Cancel</a>
    </div>
</div>
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\lawstudents\resources\views/admission/list.blade.php ENDPATH**/ ?>