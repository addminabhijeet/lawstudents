<?php echo $__env->make('layouts.partials.admin.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<main class="nxl-container">
    <div class="nxl-content">

        <!-- Header -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Acts Categories</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>

            <div class="page-header-right ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <a href="<?php echo e(route('admin.addactcategory')); ?>" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Add Categories Acts</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
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
                                <table class="table table-hover" id="actsList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Category Name</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                            <tr class="single-item">
                                                <td><?php echo e($loop->iteration); ?></td>

                                                <!-- Category Name Styled -->
                                                <td>
                                                    <a class="hstack gap-3">
                                                        <div>
                                                            <span class="text-truncate-1-line">
                                                                <?php echo e($categorie->name); ?>

                                                            </span>
                                                        </div>
                                                    </a>
                                                </td>

                                                <!-- Actions -->
                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">

                                                        <!-- Edit -->
                                                        <a href="<?php echo e(route('admin.editactcategory', [$categorie->id])); ?>"
                                                            class="avatar-text avatar-md"
                                                            title="Edit Category">
                                                            <i class="feather feather-edit"></i>
                                                        </a>

                                                        <!-- Delete -->
                                                        <form action="<?php echo e(route('admin.deleteactcategoryfile', [$categorie->id])); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                            

                                                            <button type="submit"
                                                                class="avatar-text avatar-md text-danger"
                                                                title="Delete Category"
                                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                                                <i class="feather feather-trash-2"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="3" class="text-center">No Categories Found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">

                                            <!-- Previous -->
                                            <li class="page-item <?php echo e($categories->onFirstPage() ? 'disabled' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($categories->previousPageUrl()); ?>">
                                                    &laquo;
                                                </a>
                                            </li>

                                            <!-- Pages -->
                                            <?php $__currentLoopData = $categories->getUrlRange(1, $categories->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="page-item <?php echo e($categories->currentPage() == $page ? 'active' : ''); ?>">
                                                    <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <!-- Next -->
                                            <li class="page-item <?php echo e(!$categories->hasMorePages() ? 'disabled' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($categories->nextPageUrl()); ?>">
                                                    &raquo;
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
</main>
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/acts/categories/list.blade.php ENDPATH**/ ?>