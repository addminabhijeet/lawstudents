@include('layouts.partials.admin.dashboard')
@php
$user = \App\Models\User::first();
@endphp
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

                            @if ($admission->photo)
                            <img src="{{ asset('storage/app/public/' . $admission->photo) }}"
                                class="rounded-circle mb-3" style="width:130px;height:130px;object-fit:cover;">
                            @else
                            <img src="{{ asset('images/default-user.png') }}" class="rounded-circle mb-3"
                                style="width:130px;height:130px;">
                            @endif

                            <h5 class="fw-bold mb-1">
                                {{ $admission->full_name }}
                            </h5>

                            <p class="text-muted mb-2">
                                Admission No
                            </p>

                            <span class="badge bg-primary fs-6">
                                {{ $admission->admno }}
                            </span>

                            <hr>

                            <div class="text-start">

                                <p class="mb-2">
                                    <strong>Email:</strong><br>
                                    {{ $admission->email }}
                                </p>

                                <p class="mb-2">
                                    <strong>Phone:</strong><br>
                                    {{ $admission->phone }}
                                </p>

                                <p class="mb-2">
                                    <strong>Guardian:</strong><br>
                                    {{ $admission->father_name }}
                                </p>

                                <p class="mb-2">
                                    <strong>Guardian Contact Number:</strong><br>
                                    {{ $admission->guardian_phone }}
                                </p>

                                <p class="mb-2">
                                    <strong>Guardian Contact Number:</strong><br>
                                    {{ $admission->guardian_phone }}
                                </p>

                                <p class="mb-2">
                                    <strong>Courses:</strong><br>
                                    @if(!empty($admission->course_ids))
                                    @foreach($courses as $course)
                                    @if(in_array($course->id, $admission->course_ids))
                                    {{ $course->title }} - ₹{{ $course->price }} <br>
                                    @endif
                                    @endforeach
                                    @else
                                    <span class="text-muted">No courses selected.</span>
                                    @endif
                                </p>

                                <p class="mb-0">
                                    <strong>Status:</strong><br>

                                    @if ($admission->admission_status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                    @elseif($admission->admission_status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @else
                                    <span class="badge bg-danger">Rejected</span>
                                    @endif

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
                                    <p class="fw-semibold">{{ $admission->full_name }}</p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="text-muted small">Admission No</label>
                                    <p class="fw-semibold">{{ $admission->admno }}</p>
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-lg-6">
                                    <label class="text-muted small">Email</label>
                                    <p class="fw-semibold">{{ $admission->email }}</p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="text-muted small">Phone</label>
                                    <p class="fw-semibold">{{ $admission->phone }}</p>
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-lg-6">
                                    <label class="text-muted small">Father / Guardian</label>
                                    <p class="fw-semibold">{{ $admission->father_name }}</p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="text-muted small">Admission Status</label>
                                    <p class="fw-semibold text-capitalize">
                                        {{ $admission->admission_status }}
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
                                        {{ $admission->address_line1 }}
                                    </p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="text-muted small">Address Line 2</label>
                                    <p class="fw-semibold">
                                        {{ $admission->address_line2 }}
                                    </p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="text-muted small">Pin code</label>
                                    <p class="fw-semibold">
                                        {{ $admission->pincode }}
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

                                    @if ($admission->photo)
                                    <img src="{{ asset('storage/app/public/' . $admission->photo) }}"
                                        class="img-thumbnail" style="max-height:180px;">
                                    @endif

                                </div>

                                <div class="col-md-6">

                                    <label class="text-muted small d-block mb-2">
                                        Signature
                                    </label>

                                    @if ($admission->signature)
                                    <img src="{{ asset('storage/app/public/' . $admission->signature) }}"
                                        class="img-thumbnail" style="max-height:150px;">
                                    @endif

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="card-body p-0" id="invoice-body">
                <div class="px-3 pt-2 pb-1">
                    <div class="row align-items-center text-center text-sm-start g-1">

                        <!-- LEFT: centerone -->
                        <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                            <strong>
                                <address class="text-muted small mb-0 lh-sm">
                                    @if (!empty($user?->centerone))
                                    {!! collect(explode(' ', trim($user->centerone)))
                                    ->chunk(3)
                                    ->map(fn($chunk) => implode(' ', $chunk->toArray()))
                                    ->implode('<br>') !!}
                                    <br>
                                    @else
                                    P.O. Box 18728,<br>
                                    DeLorean New York<br>
                                    VAT No: 2617 348 2752<br>
                                    @endif
                                </address>
                            </strong>
                        </div>

                        <!-- CENTER: Logo -->
                        <div class="col-12 col-sm-4 text-center mb-2 mb-sm-0">
                            <img src="{{ asset('assets/images/logo-full.png') }}"
                                class="img-fluid mb-1"
                                style="max-height: 55px;"
                                alt="Logo">
                            <div class="fw-bold text-dark small lh-sm">
                                <strong>Mobile:</strong> {{ $user->mobile ?? '-' }}<br>
                                <strong>Email:</strong> {{ $user->webemail ?? ($user->email ?? '-') }}
                            </div>
                        </div>

                        <!-- RIGHT: centertwo -->
                        <div class="col-12 col-sm-4 text-sm-end">
                            <strong>
                                <address class="text-muted small mb-0 lh-sm">
                                    @if (!empty($user?->centertwo))
                                    {!! collect(explode(' ', trim($user->centertwo)))
                                    ->chunk(3)
                                    ->map(fn($chunk) => implode(' ', $chunk->toArray()))
                                    ->implode('<br>') !!}
                                    <br>
                                    @else
                                    P.O. Box 18728,<br>
                                    DeLorean New York<br>
                                    VAT No: 2617 348 2752<br>
                                    @endif
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
                            <h2 class="fs-16 fw-bold text-dark mb-2">Invoiced To:</h2>
                            <address class="text-muted lh-sm">
                                <div>Full Name:</div>
                                <div>{{ $admission->full_name }}</div>
                                <div>Admission No:</div>
                                <div>{{ $admission->admno }}</div>
                                <div>Email:</div>
                                <div>{{ $admission->email }}</div>
                                <div>Contact Number:</div>
                                <div>{{ $admission->phone }}</div>
                                <div>Guardian Contact Number:</div>
                                <div>{{ $admission->guardian_phone }}</div>
                            </address>
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
                            <h2 class="fs-16 fw-bold text-dark mb-2">Payment Details:</h2>
                            <div class="text-muted lh-sm">
                                <div>
                                    <span class="text-muted">Total Due:</span>
                                    <span class="fw-bold text-dark">

                                    </span>
                                </div>

                                <div>
                                    <span class="text-muted">Payout Status:</span>


                                    <span class="fw-bold ">

                                    </span>
                                </div>

                                <div>
                                    <span class="text-muted">Invoice:</span>
                                    <span class="fw-bold text-primary">

                                    </span>
                                </div>


                                <div>
                                    <span class="text-muted">Due Date:</span>
                                    <span class="fw-bold text-dark">

                                    </span>
                                </div>



                                <div>
                                    <span class="text-muted">Issued Date:</span>
                                    <span class="fw-bold text-dark">

                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <hr class="border-dashed mb-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-end">Enrolled Courses</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td class="border-end">

                                </td>
                                <td class="text-end fw-semibold">

                                </td>
                            </tr>


                            {{-- Sub Total --}}
                            <tr>
                                <td class="fw-semibold text-dark text-end border-end">Sub Total
                                </td>
                                <td class="fw-bold text-dark text-end">

                                </td>
                            </tr>

                            {{-- Discount --}}
                            <tr>
                                <td class="fw-semibold text-dark text-end border-end">
                                    Discount
                                </td>
                                <td class="fw-bold text-success text-end">

                                </td>
                            </tr>

                            {{-- Grand Total --}}
                            <tr>
                                <td class="fw-bold text-dark text-end border-end">Grand Amount
                                </td>
                                <td class="fw-bolder text-dark text-end">

                                </td>
                            </tr>

                            {{-- Tax --}}

                            <tr>
                                <td class="fw-semibold text-dark text-end border-end">
                                    Paid Amount
                                </td>
                                <td class="fw-bold text-success text-end">

                                </td>
                            </tr>

                            <tr>
                                <td class="fw-semibold text-dark text-end border-end">
                                    Remaining Amount
                                </td>
                                <td class="fw-bold text-dark text-end">

                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
                <hr class="border-dashed my-2">
                <div class="px-3">

                    <div class="alert alert-dismissible p-2 mt-2 mb-2 alert-soft-warning-message">
                        <p class="mb-0 small">

                        </p>
                    </div>

                </div>

                <div class="px-3 pt-2 d-sm-flex align-items-start justify-content-between">

                    <!-- TERMS -->
                    <div class="mb-2 mb-sm-0">
                        <h6 class="fs-13 fw-bold mb-1">Terms & Conditions:</h6>
                        <ul class="list-unstyled lh-sm fs-12 mb-0">
                            @if ($user && $user->terms)
                            {!! nl2br(e($user->terms)) !!}
                            @else
                            <li>1.All payments are due within 7 days from the date of invoice issuance.</li>
                            <li>2.Payments can be made via cheque, credit/debit card, or online bank transfer.</li>
                            <li>3.This invoice is computer-generated and does not require a physical signature.</li>
                            @endif
                        </ul>
                    </div>

                    <!-- SIGNATURE 1 -->
                    <div class="text-center">
                        @if ($user && $user->diraccsign)
                        <img src="{{ asset('storage/app/public/' . $user->diraccsign) }}"
                            class="img-fluid" style="max-height:60px;" alt="signature">
                        @else
                        <img src="assets/images/general/signature.png"
                            class="img-fluid" style="max-height:60px;" alt="default signature">
                        @endif

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
                        @if ($user && $user->accsign)
                        <img src="{{ asset('storage/app/public/' . $user->accsign) }}"
                            class="img-fluid" style="max-height:60px;" alt="signature">
                        @else
                        <img src="assets/images/general/signature.png"
                            class="img-fluid" style="max-height:60px;" alt="default signature">
                        @endif

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
@include('layouts.partials.admin.theme')