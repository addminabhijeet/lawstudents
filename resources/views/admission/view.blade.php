@include('layouts.partials.admin.dashboard')
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
            <a href="javascript:void(0);" id="print-btn"
                class="d-flex me-1 printBTN"
                onclick="printInvoice(this.closest('.invoice-container'))">
                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Print Invoice">
                    <i class="feather feather-printer"></i>
                </div>
            </a>
            <div class="row">

                <div class="invoice-container" style="width:210mm; min-height:297mm; margin:auto; font-family:'Times New Roman', serif; color:#333; line-height:1.4; background:#fff; padding:20mm; box-sizing:border-box; border:5px solid #3366ff; position:relative;">
                    <!-- HEADER -->
                    <div style="text-align:center; margin-bottom:30px;">
                        <img src="{{ asset('images/institute-logo.png') }}" alt="Institute Logo" style="height:80px; margin-bottom:10px;">
                        <h1 style="margin:0; font-size:26px; color:#3366ff; letter-spacing:2px;">Premium Multi-State Institute</h1>
                        <p style="margin:5px 0 0 0; font-size:14px; font-style:italic;">Official Admission Details</p>
                        <hr style="border:2px solid #3366ff; margin-top:10px;">
                    </div>

                    <!-- PROFILE -->
                    <div style="display:flex; gap:20px; margin-bottom:30px;">
                        <div style="flex:0 0 150px; text-align:center;">
                            @if ($admission->photo)
                            <img src="{{ asset('storage/app/public/' . $admission->photo) }}" style="width:150px; height:150px; border-radius:50%; border:4px solid #3366ff; object-fit:cover;">
                            @else
                            <img src="{{ asset('images/default-user.png') }}" style="width:150px; height:150px; border-radius:50%; border:4px solid #3366ff;">
                            @endif
                        </div>
                        <div style="flex:1;">
                            <h2 style="margin:0; font-size:22px; text-transform:uppercase;">{{ $admission->full_name }}</h2>
                            <p style="margin:5px 0; font-size:14px;">Admission No: <strong>{{ $admission->admno }}</strong></p>
                            <p>
                                @if ($admission->admission_status == 'approved')
                                <span style="padding:6px 12px; background:#28a745; color:#fff; border-radius:6px;">Approved</span>
                                @elseif($admission->admission_status == 'pending')
                                <span style="padding:6px 12px; background:#ffc107; color:#000; border-radius:6px;">Pending</span>
                                @else
                                <span style="padding:6px 12px; background:#dc3545; color:#fff; border-radius:6px;">Rejected</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- CONTACT INFORMATION -->
                    <div style="margin-bottom:20px;">
                        <h3 style="border-bottom:2px solid #3366ff; padding-bottom:5px; color:#3366ff;">Contact Information</h3>
                        <p><strong>Email:</strong> {{ $admission->email }}</p>
                        <p><strong>Phone:</strong> {{ $admission->phone }}</p>
                        <p><strong>Guardian:</strong> {{ $admission->father_name }}</p>
                        <p><strong>Guardian Phone:</strong> {{ $admission->guardian_phone }}</p>
                    </div>

                    <!-- COURSES -->
                    <div style="margin-bottom:20px;">
                        <h3 style="border-bottom:2px solid #3366ff; padding-bottom:5px; color:#3366ff;">Courses Enrolled</h3>
                        @if(!empty($admission->course_ids))
                        <table style="width:100%; border-collapse: collapse; margin-top:10px;">
                            <thead>
                                <tr style="background:#3366ff; color:#fff;">
                                    <th style="border:1px solid #ccc; padding:8px; text-align:left;">Course</th>
                                    <th style="border:1px solid #ccc; padding:8px; text-align:right;">Price (₹)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                @if(in_array($course->id, $admission->course_ids))
                                <tr>
                                    <td style="border:1px solid #ccc; padding:8px;">{{ $course->title }}</td>
                                    <td style="border:1px solid #ccc; padding:8px; text-align:right;">{{ $course->price }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p style="color:#888;">No courses selected.</p>
                        @endif
                    </div>

                    <!-- ADDRESS -->
                    <div style="margin-bottom:20px;">
                        <h3 style="border-bottom:2px solid #3366ff; padding-bottom:5px; color:#3366ff;">Address</h3>
                        <p><strong>Line 1:</strong> {{ $admission->address_line1 }}</p>
                        <p><strong>Line 2:</strong> {{ $admission->address_line2 }}</p>
                        <p><strong>Pin Code:</strong> {{ $admission->pincode }}</p>
                    </div>

                    <!-- DOCUMENTS -->
                    <div style="margin-bottom:20px;">
                        <h3 style="border-bottom:2px solid #3366ff; padding-bottom:5px; color:#3366ff;">Documents</h3>
                        <div style="display:flex; gap:50px; justify-content:start;">
                            <div style="text-align:center;">
                                <p><strong>Passport Photo</strong></p>
                                @if ($admission->photo)
                                <img src="{{ asset('storage/app/public/' . $admission->photo) }}" style="max-width:150px; max-height:150px; border:3px solid #3366ff;">
                                @endif
                            </div>
                            <div style="text-align:center;">
                                <p><strong>Signature</strong></p>
                                @if ($admission->signature)
                                <img src="{{ asset('storage/app/public/' . $admission->signature) }}" style="max-width:150px; max-height:100px; border:3px solid #333;">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div style="text-align:center; margin-top:40px; font-size:12px; color:#888;">
                        <p>© {{ date('Y') }} Premium Multi-State Institute. All rights reserved.</p>
                    </div>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title">Aadhar Card</h6>

                    <div class="mb-3">

                        <div class="invalid-feedback" id="idProofErrorCard"></div>

                        <div class="text-center mt-2">
                            @if ($admission->id_proof)
                            <iframe id="idProofPreviewCard"
                                src="{{ asset('storage/app/public/' . $admission->id_proof) }}"
                                style="display:block; width:100%; height:1122px; border:1px solid #ccc;"></iframe>
                            @else
                            <a id="idProofButtonCard" class="btn btn-outline-secondary w-100 mb-2">
                                No file selected
                            </a>
                            <iframe id="idProofPreviewCard"
                                style="display:none; width:100%; height:1122px; border:1px solid #ccc;"></iframe>
                            @endif
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
        fetch("{{ route('admin.sendemailotp') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: document.querySelector('[name=email]').value
            })
        }).then(res => res.json()).then(data => alert(data.message));
    }

    function verifyEmailOtp() {
        fetch("{{ route('admin.verifyemailotp') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
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
        fetch("{{ route('admin.sendphoneotp') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                phone: document.querySelector('[name=phone]').value
            })
        }).then(res => res.json()).then(data => alert(data.message));
    }

    function verifyPhoneOtp() {
        fetch("{{ route('admin.verifyphoneotp') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.11.0/html2pdf.bundle.min.js"></script>
<script>
    function printInvoice(invoiceContainer) {
        if (!invoiceContainer) return;

        // Clone the container itself for printing
        var printContents = invoiceContainer.cloneNode(true);

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

        // Clone the container itself for PDF
        var pdfContent = invoiceContainer.cloneNode(true);

        // Temporary off-screen container
        var container = document.createElement('div');
        container.style.position = 'absolute';
        container.style.left = '-9999px';
        container.appendChild(pdfContent);
        document.body.appendChild(container);

        var filename = 'admission-details.pdf';

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
@include('layouts.partials.admin.theme')