<?php echo $__env->make('layouts.partials.student.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<main class="nxl-container">
    <!-- main containts -->
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Student</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Applications</li>
                    <li class="breadcrumb-item">Registration</li>
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

                            
                            <?php if($notFound): ?>
                                <div class="alert alert-warning text-center">
                                    <strong>Please Complete Your Registration</strong>
                                </div>
                            <?php endif; ?>

                            <?php if(!$notFound && $student): ?>
                                
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



                                <div class="card border-light shadow-sm mb-4">
                                    <div class="card-body">

                                        <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">Student Details</h5>

                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="text-muted small mb-1">Full Name</label>
                                                <p class="mb-0 fw-semibold"><?php echo e(old('name', $student->name ?? '')); ?></p>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="text-muted small mb-1">Registration No.</label>
                                                <p class="mb-0">
                                                    <span class="badge bg-primary fs-6">
                                                        <?php echo e(old('name', $student->username ?? '')); ?>

                                                    </span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="text-muted small mb-1">Email</label>
                                                <p class="mb-0 fw-semibold"><?php echo e(old('email', $student->email ?? '')); ?>

                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo e(asset('assets/vendors/js/vendors.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendors/js/lslstrength.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/common-init.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/theme-customizer-init.min.js')); ?>"></script>
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
<?php echo $__env->make('layouts.partials.student.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/studentstu/view.blade.php ENDPATH**/ ?>