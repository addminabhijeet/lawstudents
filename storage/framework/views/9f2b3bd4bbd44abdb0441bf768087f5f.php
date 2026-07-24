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
                    <li class="breadcrumb-item">ID Card</li>
                    <li class="breadcrumb-item">List</li>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>ID Number</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $groupedPayments = $payments->groupBy('student_id');
                                        ?>

                                        <?php $__empty_1 = true; $__currentLoopData = $groupedPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studentId => $studentPayments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php
                                                $firstPayment = $studentPayments->first();
                                            ?>

                                            <tr class="single-item">
                                                <td>
                                                    <?php echo e($loop->iteration); ?>

                                                </td>

                                                <td>
                                                    <a class="hstack gap-3">
                                                        <div>
                                                            <span class="text-truncate-1-line">
                                                                <?php echo e($firstPayment->to_name); ?>

                                                            </span>
                                                        </div>
                                                    </a>
                                                </td>

                                                <td>
                                                    <a class="hstack gap-3">
                                                        <div>
                                                            <small class="fs-12 fw-normal text-muted">
                                                                <?php echo e($firstPayment->to_email); ?>

                                                            </small>
                                                        </div>
                                                    </a>
                                                </td>

                                                <td>
                                                    <?php echo e(\Carbon\Carbon::parse($firstPayment->created_at)->format('Y-m-d, h:i A')); ?>

                                                </td>

                                                <td>
                                                    
                                                    <a class="fw-bold">
                                                        <?php echo e($firstPayment->invoice_number); ?>

                                                    </a>
                                                </td>

                                                <td>
                                                    <?php if($firstPayment->payment_status == 'paid'): ?>
                                                        <?php if($firstPayment->paid_amount > 0): ?>
                                                            <div class="badge bg-soft-success text-success">Completed
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="badge bg-soft-warning text-warning">Pending
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php elseif($firstPayment->payment_status == 'pending'): ?>
                                                        <div class="badge bg-soft-warning text-warning">Pending</div>
                                                    <?php elseif($firstPayment->payment_status == 'failed'): ?>
                                                        <div class="badge bg-soft-danger text-danger">Failed</div>
                                                    <?php else: ?>
                                                        <div class="badge bg-soft-secondary text-secondary">
                                                            <?php echo e(ucfirst($firstPayment->payment_status)); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">


                                                        <a href="<?php echo e(route('admin.viewidcard', $firstPayment->id)); ?>"
                                                            class="avatar-text avatar-md"
                                                            title="ID #<?php echo e($firstPayment->invoice_number); ?>">
                                                            <i class="fas fa-id-card"></i>
                                                        </a>


                                                        <button type="button"
                                                            class="avatar-text avatar-md toggle-viewid-btn"
                                                            data-id="<?php echo e($firstPayment->id); ?>"
                                                            data-status="<?php echo e($firstPayment->viewid ? 1 : 0); ?>"
                                                            title="<?php echo e($firstPayment->viewid ? 'Click to Hide' : 'Click to make Visible'); ?>">
                                                            <i
                                                                class="feather <?php echo e($firstPayment->viewid ? 'feather-eye-off' : 'feather-eye'); ?>"></i>
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="8" class="text-center">No ID Card Found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>

                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item <?php echo e($payments->onFirstPage() ? 'disabled' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($payments->previousPageUrl()); ?>"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            <?php $__currentLoopData = $payments->getUrlRange(1, $payments->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li
                                                    class="page-item <?php echo e($payments->currentPage() == $page ? 'active' : ''); ?>">
                                                    <a class="page-link"
                                                        href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <!-- Next Page -->
                                            <li class="page-item <?php echo e(!$payments->hasMorePages() ? 'disabled' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($payments->nextPageUrl()); ?>"
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.toggle-viewid-btn');

        function showAlert(type, message) {
            // type: 'success' or 'error'
            const container = document.querySelector('.main-content');
            const alertDiv = document.createElement('div');
            alertDiv.className =
                `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
            alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
            container.prepend(alertDiv);
            // Auto-dismiss after 3 seconds
            setTimeout(() => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alertDiv);
                bsAlert.close();
            }, 3000);
        }

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const currentStatus = this.dataset.status;

                fetch("<?php echo e(route('admin.toggleviewid')); ?>", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        },
                        body: JSON.stringify({
                            id: id,
                            current_status: currentStatus
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.dataset.status = data.new_status;
                            this.title = data.new_status == 1 ? 'Click to Hide' :
                                'Click to make Visible';
                            this.querySelector('i').className =
                                `feather ${data.new_status == 1 ? 'feather-eye-off' : 'feather-eye'}`;

                            // Show success alert
                            showAlert('success',
                            `ID Card visibility updated successfully.`);
                        } else {
                            // Show error alert
                            showAlert('error', `Failed to update ID Card visibility.`);
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showAlert('error', `Something went wrong. Please try again.`);
                    });
            });
        });
    });
</script>
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\lawstudents\resources\views/idcard/list.blade.php ENDPATH**/ ?>