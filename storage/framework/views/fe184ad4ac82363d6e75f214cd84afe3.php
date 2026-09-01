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
                    <li class="breadcrumb-item">Rules</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">

                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="<?php echo e(route('admin.addrules')); ?>" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Add Rules</span>
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
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $ruless; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rules): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <!-- Serial -->
                                            <td><?php echo e($loop->iteration); ?></td>

                                            <!-- Category -->
                                            <td><?php echo e($rules->category?->name); ?></td>

                                            <!-- Subcategory -->
                                            <td><?php echo e($rules->subcategory?->name); ?></td>

                                            <!-- Description -->
                                            <td><?php echo e($rules->description); ?></td>

                                            <!-- Actions -->
                                            <td>
                                                <div class="d-flex flex-column gap-2">

                                                    <!-- Edit -->
                                                    <a href="<?php echo e(route('admin.editrules', $rules->id)); ?>"
                                                        class="btn btn-sm btn-primary w-100">
                                                        Edit
                                                    </a>

                                                    <!-- Delete Whole Rule -->
                                                    <form method="POST"
                                                        action="<?php echo e(route('admin.rulesfiledelete', $rules->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                    

                                                        <button class="btn btn-sm btn-danger w-100"
                                                            onclick="return confirm('Delete this rule and all PDFs?')">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No Rule Found</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item <?php echo e($ruless->onFirstPage() ? 'disabled' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($ruless->previousPageUrl()); ?>"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            <?php $__currentLoopData = $ruless->getUrlRange(1, $ruless->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li
                                                class="page-item <?php echo e($ruless->currentPage() == $page ? 'active' : ''); ?>">
                                                <a class="page-link"
                                                    href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <!-- Next Page -->
                                            <li class="page-item <?php echo e(!$ruless->hasMorePages() ? 'disabled' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($ruless->nextPageUrl()); ?>"
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
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/rules/list.blade.php ENDPATH**/ ?>