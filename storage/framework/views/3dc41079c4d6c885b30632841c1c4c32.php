<?php echo $__env->make('layouts.partials.student.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php
$user = \App\Models\User::first();
?>
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Student</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Applications</li>
                    <li class="breadcrumb-item">View Student Admission</li>
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
        <div class="main-content">
            <div class="row">
                <?php if($notFound): ?>
                <div class="alert alert-warning text-center">
                    <strong>Please Complete Your Admission</strong>
                </div>
                <?php endif; ?>

                <?php if(!$notFound && $admission): ?>
                <!-- STUDENT PROFILE CARD -->
                <div class="col-xl-4">
                    <div class="card shadow-sm border-light">
                        <div class="card-body text-center">

                            <?php if($admission->photo): ?>
                            <img src="<?php echo e(asset('storage/app/public/' . $admission->photo)); ?>"
                                class="rounded-circle mb-3" style="width:130px;height:130px;object-fit:cover;">
                            <?php else: ?>
                            <img src="<?php echo e(asset('images/default-user.png')); ?>" class="rounded-circle mb-3"
                                style="width:130px;height:130px;">
                            <?php endif; ?>

                            <h5 class="fw-bold mb-1">
                                <?php echo e($admission->full_name); ?>

                            </h5>

                            <p class="text-muted mb-2">
                                Admission No
                            </p>

                            <span class="badge bg-primary fs-6">
                                <?php echo e($admission->admno); ?>

                            </span>

                            <hr>

                            <div class="text-start">

                                <p class="mb-2">
                                    <strong>Email:</strong><br>
                                    <?php echo e($admission->email); ?>

                                </p>

                                <p class="mb-2">
                                    <strong>Phone:</strong><br>
                                    <?php echo e($admission->phone); ?>

                                </p>

                                <p class="mb-2">
                                    <strong>Guardian:</strong><br>
                                    <?php echo e($admission->father_name); ?>

                                </p>

                                <p class="mb-0">
                                    <strong>Status:</strong><br>

                                    <?php if($admission->admission_status == 'approved'): ?>
                                    <span class="badge bg-success">Approved</span>
                                    <?php elseif($admission->admission_status == 'pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger">Rejected</span>
                                    <?php endif; ?>

                                </p>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- STUDENT DETAILS -->
                <div class="col-xl-8">

                    <div class="card shadow-sm border-light mb-4">
                        <div class="card-body">

                            <h5 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                Student Details
                            </h5>

                            <div class="row mb-3">

                                <div class="col-lg-6">
                                    <label class="text-muted small">Full Name</label>
                                    <p class="fw-semibold"><?php echo e($admission->full_name); ?></p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="text-muted small">Admission No</label>
                                    <p class="fw-semibold"><?php echo e($admission->admno); ?></p>
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-lg-6">
                                    <label class="text-muted small">Email</label>
                                    <p class="fw-semibold"><?php echo e($admission->email); ?></p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="text-muted small">Phone</label>
                                    <p class="fw-semibold"><?php echo e($admission->phone); ?></p>
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-lg-6">
                                    <label class="text-muted small">Father / Guardian</label>
                                    <p class="fw-semibold"><?php echo e($admission->father_name); ?></p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="text-muted small">Admission Status</label>
                                    <p class="fw-semibold text-capitalize">
                                        <?php echo e($admission->admission_status); ?>

                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- ADDRESS CARD -->
                    <div class="card shadow-sm border-light mb-4">
                        <div class="card-body">

                            <h5 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                Address Information
                            </h5>

                            <div class="row">

                                <div class="col-lg-6">
                                    <label class="text-muted small">Address Line 1</label>
                                    <p class="fw-semibold">
                                        <?php echo e($admission->address_line1); ?>

                                    </p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="text-muted small">Address Line 2</label>
                                    <p class="fw-semibold">
                                        <?php echo e($admission->address_line2); ?>

                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- DOCUMENTS -->
                    <div class="card shadow-sm border-light">
                        <div class="card-body">

                            <h5 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                Documents
                            </h5>

                            <div class="row text-center">

                                <div class="col-md-6">

                                    <label class="text-muted small d-block mb-2">
                                        Passport Photo
                                    </label>

                                    <?php if($admission->photo): ?>
                                    <img src="<?php echo e(asset('storage/app/public/' . $admission->photo)); ?>"
                                        class="img-thumbnail" style="max-height:180px;">
                                    <?php endif; ?>

                                </div>

                                <div class="col-md-6">

                                    <label class="text-muted small d-block mb-2">
                                        Signature
                                    </label>

                                    <?php if($admission->signature): ?>
                                    <img src="<?php echo e(asset('storage/app/public/' . $admission->signature)); ?>"
                                        class="img-thumbnail" style="max-height:150px;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">


                        <div class="card invoice-container">

                            <div class="card-header">
                                <!-- Print button -->
                                <div class="card-header">
                                    <!-- Print button -->
                                    <a href="javascript:void(0);" id="print-btn"
                                        class="d-flex me-1 printBTN"
                                        onclick="printInvoice(this.closest('.invoice-container'))">
                                        <div class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Print Invoice">
                                            <i class="feather feather-printer"></i>
                                        </div>
                                    </a>

                                    <!-- Download button -->
                                    <!-- <a href="javascript:void(0);" id="download-btn"
                                    class="d-flex me-1 file-download"
                                    onclick="downloadInvoice(this.closest('.invoice-container'))">
                                    <div class="avatar-text avatar-md" data-bs-toggle="tooltip"
                                        title="Download Invoice">
                                        <i class="feather feather-download"></i>
                                    </div>
                                </a> -->
                                </div>
                            </div>

                            <div class="card-body p-0" id="invoice-body">
                                <div class="px-3 pt-2 pb-1">
                                    <div class="row align-items-center text-center text-sm-start g-1">

                                        <!-- LEFT: centerone -->
                                        <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                                            <strong>
                                                <address class="text-muted small mb-0 lh-sm">
                                                    <?php if(!empty($user?->centerone)): ?>
                                                    <?php echo collect(explode(' ', trim($user->centerone)))
                                                    ->chunk(3)
                                                    ->map(fn($chunk) => implode(' ', $chunk->toArray()))
                                                    ->implode('<br>'); ?>

                                                    <br>
                                                    <?php else: ?>
                                                    P.O. Box 18728,<br>
                                                    DeLorean New York<br>
                                                    VAT No: 2617 348 2752<br>
                                                    <?php endif; ?>
                                                </address>
                                            </strong>
                                        </div>

                                        <!-- CENTER: Logo -->

                                        <div class="col-12 col-sm-4 text-center mb-2 mb-sm-0">
                                            <h2 class="fs-16 fw-bold text-dark mb-2">Admission Form</h2>
                                            <img src="<?php echo e(asset('assets/images/logo-full.png')); ?>"
                                                class="img-fluid mb-1"
                                                style="max-height: 55px;"
                                                alt="Logo">

                                            <div class="fw-bold text-dark small lh-sm">
                                                <strong>Mobile:</strong> <?php echo e($user->mobile ?? '-'); ?><br>
                                                <strong>Email:</strong> <?php echo e($user->webemail ?? ($user->email ?? '-')); ?><br>

                                            </div>
                                        </div>

                                        <!-- RIGHT: centertwo -->
                                        <div class="col-12 col-sm-4 text-sm-end">
                                            <strong>
                                                <address class="text-muted small mb-0 lh-sm">
                                                    <?php if(!empty($user?->centertwo)): ?>
                                                    <?php echo collect(explode(' ', trim($user->centertwo)))
                                                    ->chunk(3)
                                                    ->map(fn($chunk) => implode(' ', $chunk->toArray()))
                                                    ->implode('<br>'); ?>

                                                    <br>
                                                    <?php else: ?>
                                                    P.O. Box 18728,<br>
                                                    DeLorean New York<br>
                                                    VAT No: 2617 348 2752<br>
                                                    <?php endif; ?>
                                                </address>
                                            </strong>
                                        </div>

                                    </div>
                                </div>
                                <hr class="border-dashed my-2">
                                <div class="px-4 py-3">
                                    <div class="d-sm-flex gap-4 justify-content-center align-items-start">

                                        <!-- LEFT: Invoiced To -->
                                        <div class="text-sm-end">
                                            <h2 class="fs-16 fw-bold text-dark mb-2">Student Photo:</h2>

                                            <?php if($admission->photo): ?>
                                            <img src="<?php echo e(asset('storage/app/public/' . $admission->photo)); ?>"
                                                class="rounded-circle mb-3"
                                                style="width:100px; height:100px; object-fit:cover;">
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('images/default-user.png')); ?>" class="rounded-circle mb-3"
                                                style="width:100px; height:100px;">
                                            <?php endif; ?>
                                        </div>

                                        <!-- Divider -->
                                        <div class="border-end border-end-dashed border-gray-500 d-none d-sm-block"></div>

                                        <!-- CENTER: Bank Details -->
                                        <div class="text-center px-3">
                                            <h2 class="fs-16 fw-bold text-dark mb-2">Bank Details:</h2>
                                            <div class="text-muted lh-sm">
                                                <div>Account Holder name:</div>
                                                <div>RIZWANA BEGUM</div>
                                                <div>State Bank of India</div>
                                                <div>A/c no. 41669065973</div>
                                                <div>Branch: Newtown Rajarhat (05112)</div>
                                                <div>IFS CODE: SBIN0005112</div>
                                            </div>
                                        </div>

                                        <!-- Divider -->
                                        <div class="border-end border-end-dashed border-gray-500 d-none d-sm-block"></div>

                                        <!-- RIGHT: Payment Details -->
                                        <div class="mt-4 mt-sm-0">
                                            <h2 class="fs-16 fw-bold text-dark mb-2">Student Details:</h2>
                                            <address class="text-muted lh-sm">
                                                <div>Full Name: <?php echo e($admission->full_name); ?></div>
                                                <div>Email: <?php echo e($admission->email); ?></div>
                                                <div>Contact Number: <?php echo e($admission->phone); ?></div>
                                                <div>Guardian Contact Number: <?php echo e($admission->guardian_phone); ?></div>
                                                <div>Admission No: <strong><?php echo e($admission->admno); ?></strong></div>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-dashed mb-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="border-end" style="padding:4px 8px;">Enrolled Courses</th>
                                                <th class="text-end" style="padding:4px 8px;">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $total = 0;
                                            ?>

                                            
                                            <?php $__currentLoopData = $selectedCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $total += $course->price;
                                            ?>
                                            <tr>
                                                <td class="border-end" style="padding:4px 8px;">
                                                    <?php echo e($course->title); ?>

                                                </td>
                                                <td class="text-end fw-semibold" style="padding:4px 8px;">
                                                    ₹ <?php echo e(number_format($course->price, 2)); ?>

                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            
                                            <tr>
                                                <td class="fw-semibold text-dark text-end border-end" style="padding:4px 8px;">
                                                    Sub Total
                                                </td>
                                                <td class="fw-bold text-dark text-end" style="padding:4px 8px;">
                                                    ₹ <?php echo e(number_format($total, 2)); ?>

                                                </td>
                                            </tr>

                                            
                                            <tr>
                                                <td class="fw-semibold text-dark text-end border-end" style="padding:4px 8px;">
                                                    Discount (<?php echo e($admission->discount_percent ?? 0); ?>%)
                                                </td>
                                                <td class="fw-bold text-success text-end" style="padding:4px 8px;">
                                                    - ₹ <?php echo e(number_format($admission->discount ?? 0, 2)); ?>

                                                </td>
                                            </tr>

                                            
                                            <tr>
                                                <td class="fw-bold text-dark text-end border-end" style="padding:4px 8px;">
                                                    Grand Amount
                                                </td>
                                                <td class="fw-bolder text-dark text-end" style="padding:4px 8px;">
                                                    ₹ <?php echo e(number_format($total - ($admission->discount ?? 0), 2)); ?>

                                                </td>
                                            </tr>

                                            
                                            <tr>
                                                <td class="fw-semibold text-dark text-end border-end" style="padding:4px 8px;">
                                                    Paid Amount
                                                </td>
                                                <td class="fw-bold text-success text-end" style="padding:4px 8px;">
                                                    ₹ <?php echo e(number_format($admission->paidamount ?? 0, 2)); ?>

                                                </td>
                                            </tr>

                                            
                                            <tr>
                                                <td class="fw-semibold text-dark text-end border-end" style="padding:4px 8px;">
                                                    Remaining Amount
                                                </td>
                                                <td class="fw-bold text-dark text-end" style="padding:4px 8px;">
                                                    ₹ <?php echo e(number_format($admission->remamount ?? 0, 2)); ?>

                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <hr class="border-dashed my-2">

                                <div class="px-3 pt-2 d-sm-flex align-items-start justify-content-between">

                                    <!-- TERMS -->
                                    <div class="mb-2 mb-sm-0">
                                        <h6 class="fs-13 fw-bold mb-1">Terms & Conditions:</h6>
                                        <ul class="list-unstyled lh-sm fs-12 mb-0">
                                            <?php if($user && $user->terms): ?>
                                            <?php echo nl2br(e($user->terms)); ?>

                                            <?php else: ?>
                                            <li>1.All payments are due within 7 days from the date of invoice issuance.</li>
                                            <li>2.Payments can be made via cheque, credit/debit card, or online bank transfer.</li>
                                            <li>3.This invoice is computer-generated and does not require a physical signature.</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                    <!-- SIGNATURE 1 -->
                                    <div class="text-center">
                                        <?php if($user && $user->diraccsign): ?>
                                        <img src="<?php echo e(asset('storage/app/public/' . $user->diraccsign)); ?>"
                                            class="img-fluid" style="max-height:60px;" alt="signature">
                                        <?php else: ?>
                                        <img src="assets/images/general/signature.png"
                                            class="img-fluid" style="max-height:60px;" alt="default signature">
                                        <?php endif; ?>

                                        <h6 class="fs-13 fw-bold mt-1 mb-0 lh-sm">
                                            Signature:<br>
                                            Sd/-<br>
                                            (RIZWANA BEGUM)
                                        </h6>


                                        <p class="fs-11 fw-semibold text-muted mb-0">

                                        </p>

                                    </div>

                                    <!-- SIGNATURE 2 -->
                                    <div class="text-center">
                                        <?php if($user && $user->accsign): ?>
                                        <img src="<?php echo e(asset('storage/app/public/' . $user->accsign)); ?>"
                                            class="img-fluid" style="max-height:60px;" alt="signature">
                                        <?php else: ?>
                                        <img src="assets/images/general/signature.png"
                                            class="img-fluid" style="max-height:60px;" alt="default signature">
                                        <?php endif; ?>

                                        <h6 class="fs-13 fw-bold mt-1 mb-0 lh-sm">
                                            Signature:<br>
                                            Sd/-<br>
                                            (ARITRO FOUZDAR)
                                        </h6>


                                        <p class="fs-11 fw-semibold text-muted mb-0">

                                        </p>

                                    </div>

                                </div>
                                <hr class="border-dashed my-2">

                                <div class="px-4 pb-4 text-center">
                                    <div class="fw-bold text-dark">
                                        Advocate Rizwana Begum
                                    </div>
                                    <div class="text-muted small">
                                        B. A. (Hons); M. A.; LL. M. (1st Class); PGDCL (Cyber Law-NALSAR-1st Class)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h6 class="card-title">Aadhar Card</h6>

                    <div class="mb-3">

                        <div class="invalid-feedback" id="idProofErrorCard"></div>

                        <div class="text-center mt-2">
                            <?php if($admission->id_proof): ?>
                            <iframe id="idProofPreviewCard"
                                src="<?php echo e(asset('storage/app/public/' . $admission->id_proof)); ?>"
                                style="display:block; width:100%; height:1122px; border:1px solid #ccc;"></iframe>
                            <?php else: ?>
                            <a id="idProofButtonCard" class="btn btn-outline-secondary w-100 mb-2">
                                No file selected
                            </a>
                            <iframe id="idProofPreviewCard"
                                style="display:none; width:100%; height:1122px; border:1px solid #ccc;"></iframe>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<!-- Add this in your blade file before </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.11.0/html2pdf.bundle.min.js"></script>
<script>
    function printInvoice(invoiceContainer) {
        if (!invoiceContainer) return;

        // Get the inner card-body
        var bodyContent = invoiceContainer.querySelector('.card-body.p-0');
        if (!bodyContent) return;

        var printContents = bodyContent.cloneNode(true);

        var printWindow = window.open('', '', 'height=800,width=1200');
        printWindow.document.write('<html><head><title>Invoice</title>');

        // Include all CSS
        Array.from(document.querySelectorAll('link[rel="stylesheet"], style')).forEach(function(node) {
            printWindow.document.write(node.outerHTML);
        });

        printWindow.document.write('</head><body>');
        printWindow.document.body.appendChild(printContents);
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }

    function downloadInvoice(invoiceContainer) {
        if (!invoiceContainer) return;

        // Get the inner card-body
        var bodyContent = invoiceContainer.querySelector('.card-body.p-0');
        if (!bodyContent) return;

        var pdfContent = bodyContent.cloneNode(true);

        // Temporary off-screen container
        var container = document.createElement('div');
        container.style.position = 'absolute';
        container.style.left = '-9999px';
        container.appendChild(pdfContent);
        document.body.appendChild(container);

        // Filename from invoice number
        var invoiceId = bodyContent.id || 'invoice';
        var filename = invoiceId + '.pdf';

        var opt = {
            filename: filename,
            image: {
                type: 'jpeg',
                quality: 2
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        html2pdf().set(opt).from(container).save().finally(() => container.remove());
    }
</script>
<script>
    function previewPDF(event, iframeId, buttonId) {
        const file = event.target.files[0];
        const iframe = document.getElementById(iframeId);
        const button = document.getElementById(buttonId);

        if (file) {
            const fileURL = URL.createObjectURL(file);
            iframe.src = fileURL;
            iframe.style.display = 'block'; // Show PDF
            button.style.display = 'none'; // Hide button when viewing new file
        } else {
            iframe.src = '';
            iframe.style.display = 'none'; // Hide iframe if no file selected
            button.style.display = 'inline-block'; // Show button fallback
        }
    }
</script>

<script>
    function sendEmailOtp() {
        fetch("<?php echo e(route('admin.sendemailotp')); ?>", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: document.querySelector('[name=email]').value
            })
        }).then(res => res.json()).then(data => alert(data.message));
    }

    function verifyEmailOtp() {
        fetch("<?php echo e(route('admin.verifyemailotp')); ?>", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                otp: document.getElementById('emailOtp').value
            })
        }).then(res => res.json()).then(data => {
            if (data.success) alert("Email Verified");
            else alert("Invalid OTP");
        });
    }

    function sendPhoneOtp() {
        fetch("<?php echo e(route('admin.sendphoneotp')); ?>", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                phone: document.querySelector('[name=phone]').value
            })
        }).then(res => res.json()).then(data => alert(data.message));
    }

    function verifyPhoneOtp() {
        fetch("<?php echo e(route('admin.verifyphoneotp')); ?>", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                otp: document.getElementById('phoneOtp').value
            })
        }).then(res => res.json()).then(data => {
            if (data.success) alert("Phone Verified");
            else alert("Invalid OTP");
        });
    }
</script>
<script>
    function previewImage(event, previewId) {
        const input = event.target;
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    function validateAndPreview(event, previewId, maxSizeMB) {

        const input = event.target;
        const file = input.files[0];
        const preview = document.getElementById(previewId);

        const errorElement = previewId === 'photoPreview' ?
            document.getElementById('photoError') :
            document.getElementById('signError');

        if (!file) return;

        const maxSizeBytes = maxSizeMB * 1024 * 1024;

        // Reset state
        input.classList.remove('is-invalid');
        errorElement.textContent = "";
        preview.classList.add('d-none');

        if (file.size > maxSizeBytes) {

            input.value = ""; // Clear file
            input.classList.add('is-invalid');
            errorElement.textContent = "File size exceeds " + maxSizeMB + "MB limit.";
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };

        reader.readAsDataURL(file);
    }
</script>
<?php echo $__env->make('layouts.partials.student.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/admissionstu/view.blade.php ENDPATH**/ ?>