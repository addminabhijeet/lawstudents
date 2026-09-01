<?php echo $__env->make('layouts.partials.admin.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php
$user = \App\Models\User::first();
?>
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
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

                                <p class="mb-2">
                                    <strong>Guardian Contact Number:</strong><br>
                                    <?php echo e($admission->guardian_phone); ?>

                                </p>

                                <p class="mb-2">
                                    <strong>Guardian Contact Number:</strong><br>
                                    <?php echo e($admission->guardian_phone); ?>

                                </p>

                                <p class="mb-2">
                                    <strong>Courses:</strong><br>
                                    <?php if(!empty($admission->course_ids)): ?>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($course->id, $admission->course_ids)): ?>
                                    <?php echo e($course->title); ?> - ₹<?php echo e($course->price); ?> <br>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <span class="text-muted">No courses selected.</span>
                                    <?php endif; ?>
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

                                <div class="col-lg-6">
                                    <label class="text-muted small">Pin code</label>
                                    <p class="fw-semibold">
                                        <?php echo e($admission->pincode); ?>

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
            </div>

            <div class="card mb-4">
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
            </div>
        </div>
    </div>
</main>

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
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/admission/view.blade.php ENDPATH**/ ?>