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

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Courses</label>

                                    <div class="border rounded p-3" style="max-height:250px; overflow-y:auto;">
                                        @if(!empty($admission->course_ids))
                                        @foreach($courses as $course)
                                        @if(in_array($course->id, $admission->course_ids))
                                        <p class="mb-2">
                                            <strong>{{ $course->title }}:</strong><br>
                                            ₹{{ $course->price }} | {{ $course->duration }}
                                        </p>
                                        @endif
                                        @endforeach
                                        @else
                                        <p class="text-muted mb-0">No courses selected.</p>
                                        @endif
                                    </div>
                                </div>

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

            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title">Aadhar Card Upload</h6>

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
        </div>
    </div>
</main>



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