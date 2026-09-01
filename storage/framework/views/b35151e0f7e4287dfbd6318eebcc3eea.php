<?php
    $setting = $banner ? $banner->first() : null;
?>

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
                    <li class="breadcrumb-item">Banner</li>
                    <li class="breadcrumb-item">Update</li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full shadow-sm border-0">

                        <div class="card-header text-white">
                            <h5 class="mb-0">Banner Settings</h5>
                        </div>

                        <div class="card-body">
                            <form action="<?php echo e(route('admin.storebanner')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="banner_id" value="<?php echo e($banner->id ?? ''); ?>">

                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Banner Image 1 (1920 X 1080)</label>
                                        <input type="file" name="image_1" class="form-control">

                                        <?php $__errorArgs = ['image_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <small class="text-danger"><?php echo e($message); ?></small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                        <?php if($banner && $banner->image_1): ?>
                                            <div class="mt-2">
                                                <img src="<?php echo e(asset('storage/app/public/' . $banner->image_1)); ?>"
                                                    width="150">
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Banner Image 2 (1920 X 1080)</label>
                                        <input type="file" name="image_2" class="form-control">

                                        <?php $__errorArgs = ['image_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <small class="text-danger"><?php echo e($message); ?></small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                        <?php if($banner && $banner->image_2): ?>
                                            <div class="mt-2">
                                                <img src="<?php echo e(asset('storage/app/public/' . $banner->image_2)); ?>"
                                                    width="150">
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Banner Image 3 (1920 X 1080)</label>
                                        <input type="file" name="image_3" class="form-control">

                                        <?php $__errorArgs = ['image_3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <small class="text-danger"><?php echo e($message); ?></small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                        <?php if($banner && $banner->image_3): ?>
                                            <div class="mt-2">
                                                <img src="<?php echo e(asset('storage/app/public/' . $banner->image_3)); ?>"
                                                    width="150" class="img-thumbnail">
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>

                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Save Banner
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
</main>
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/course/banner.blade.php ENDPATH**/ ?>