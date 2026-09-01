<?php echo $__env->make('layouts.partials.student.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<main class="nxl-container">
    <div class="nxl-content">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Student</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">ID Card</li>
                    <li class="breadcrumb-item">View</li>
                </ul>
            </div>
        </div>

        <div class="main-content container-lg py-5">
            <?php if($notFound): ?>
                <div class="alert alert-warning text-center">
                    <strong>Please Complete Your Payment to get ID Card</strong>
                </div>
            <?php endif; ?>

            <?php if(!$notFound && $idcard): ?>
                <div class="row justify-content-center">

                    <div class="col-auto">

                        <!-- PVC CARD -->
                        <div class="card shadow border-0" style="width:260px; min-height:430px; overflow:hidden;">

                            <!-- TOP STRIPE -->
                            <div style="background:#4e342e; color:#fff;" class="text-center py-2">

                                <img src="<?php echo e(asset('assets/images/logo-full.png')); ?>" height="28" class="mb-1">

                                <div style="font-size:12px;font-weight:600; letter-spacing:0.5px;">
                                    STUDENT ID CARD
                                </div>

                            </div>


                            <!-- BODY -->
                            <div class="card-body text-center py-3">

                                <div class="d-flex justify-content-center mb-2">

                                    <div class="d-flex align-items-center justify-content-center bg-light rounded-circle shadow"
                                        style="width:80px;height:80px;">

                                        <?php if(!empty($admission?->photo)): ?>
                                            <img src="<?php echo e(asset('storage/app/public/' . $admission->photo)); ?>"
                                                style="width:100%; height:100%; object-fit:cover;">
                                        <?php else: ?>
                                            <i class="feather-user" style="font-size:32px;"></i>
                                        <?php endif; ?>

                                    </div>

                                </div>

                                <!-- NAME -->
                                <div style="font-weight:600;font-size:14px;">
                                    <?php echo e($idcard->to_name); ?>

                                </div>

                                <hr class="my-2">


                                <!-- STUDENT INFO -->
                                <div class="text-start px-2 text-center" style="font-size:11px; font-weight:600;">

                                    <div class="mb-1">
                                        <strong>ID :</strong>
                                        <?php echo e($idcard->invoice_number); ?>

                                    </div>

                                    <div class="mb-1">
                                        <strong>Email :</strong>
                                        <?php echo e($idcard->to_email); ?>

                                    </div>

                                    <div class="mb-1">
                                        <strong>Phone :</strong>
                                        <?php echo e($idcard->to_phone); ?>

                                    </div>

                                    <?php if(!is_null($idcard->issue_date)): ?>
                                        <div class="mb-1">
                                            <strong>Issue :</strong>
                                            <?php echo e($idcard->issue_date->format('d M Y')); ?>

                                        </div>
                                    <?php endif; ?>

                                </div>


                                <hr class="my-2">


                                <!-- COURSE + QR -->
                                <div class="row align-items-center text-center justify-content-center">

                                    <div class="col-5 d-flex justify-content-center">

                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?php echo e(urlencode($idcard->invoice_number)); ?>"
                                            style="width:90px; height:90px; object-fit:contain;">
                                    </div>

                                </div>

                            </div>


                            <!-- FOOTER STRIP -->
                            <div class="bg-light text-center py-2">

                                <small class="text-muted" style="font-size:9px;">
                                    Scan QR to verify student ID
                                </small>

                            </div>

                        </div>

                    </div>

                </div>
            <?php endif; ?>

        </div>

    </div>
</main>
<?php echo $__env->make('layouts.partials.student.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/idcardstu/idcard.blade.php ENDPATH**/ ?>