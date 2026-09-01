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
                    <li class="breadcrumb-item">Contact Form</li>
                    <li class="breadcrumb-item">View</li>
                </ul>
            </div>
        </div>

        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Contact Details</h4>
                        </div>

                        <div class="card-body">

                            <p><strong>Name:</strong> <?php echo e($contact->first_name); ?> <?php echo e($contact->last_name); ?></p>

                            <p><strong>Email:</strong> <?php echo e($contact->email); ?></p>

                            <p><strong>Phone:</strong> <?php echo e($contact->phone); ?></p>

                            <p><strong>Service Type:</strong> <?php echo e($contact->service_type); ?></p>

                            <p><strong>Message:</strong></p>
                            <div class="border p-3 bg-light rounded">
                                <?php echo e($contact->message); ?>

                            </div>

                            <p class="mt-3 text-muted">
                                Submitted on: <?php echo e($contact->created_at->format('d M Y, h:i A')); ?>

                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/contact/view.blade.php ENDPATH**/ ?>