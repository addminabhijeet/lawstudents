<?php
    $setting = $whatsapp->first();
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
                    <li class="breadcrumb-item">Whatsapp</li>
                    <li class="breadcrumb-item">Update</li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full shadow-sm border-0">

                        <div class="card-header text-white">
                            <h5 class="mb-0">Whatsapp Settings</h5>
                        </div>

                        <div class="card-body">
                            <form action="<?php echo e(route('admin.updateWhatsapp', ['id' => $setting ? $setting->id : 1])); ?>"
                                method="POST">
                                <?php echo csrf_field(); ?>

                                <div class="mb-3">
                                    <label class="form-label">WhatsApp Number</label>
                                    <input type="text" name="whatsapp_number" class="form-control"
                                        placeholder="WhatsApp Number"
                                        value="<?php echo e($setting ? $setting->whatsapp_number : ''); ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pre-filled Message</label>
                                    <textarea name="pre_message" class="form-control" rows="4"><?php echo e($setting ? $setting->pre_message : 'Hello LawStudents, I am interested in...'); ?></textarea>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        Save Settings
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
<?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/admission/whatsapp.blade.php ENDPATH**/ ?>