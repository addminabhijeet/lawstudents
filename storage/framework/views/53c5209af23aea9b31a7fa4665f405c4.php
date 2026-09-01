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
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
        </div>

        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>File Name</th>
                                            <th>Button Name</th>
                                            <th>Date Uploaded</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $contact; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>

                                            <!-- Full Name -->
                                            <td><?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?></td>

                                            <!-- Service Type -->
                                            <td><?php echo e($item->service_type); ?></td>

                                            <!-- Created Date -->
                                            <td><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('Y-m-d, h:i A')); ?></td>

                                            <td>
                                                <div class="hstack gap-2 justify-content-end">

                                                    <!-- MAIL BUTTON -->
                                                    <a href="<?php echo e(route('admin.viewcontactform', $item->id)); ?>"
                                                        class="btn btn-sm btn-success">
                                                        Mail
                                                    </a>

                                                    <!-- DELETE -->
                                                    <form method="POST"
                                                        action="<?php echo e(route('admin.deletecontact', $item->id)); ?>"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Delete this record?')">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No Data Found</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">

                                            <!-- Previous Page -->
                                            <li class="page-item <?php echo e($contact->onFirstPage() ? 'disabled' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($contact->previousPageUrl()); ?>"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            <?php $__currentLoopData = $contact->getUrlRange(1, $contact->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="page-item <?php echo e($contact->currentPage() == $page ? 'active' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <!-- Next Page -->
                                            <li class="page-item <?php echo e(!$contact->hasMorePages() ? 'disabled' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($contact->nextPageUrl()); ?>"
                                                    aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
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
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/contact/list.blade.php ENDPATH**/ ?>