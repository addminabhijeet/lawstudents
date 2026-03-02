@include('layouts.partials.admin.dashboard')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Proposal</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Create</li>
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
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="javascript:void(0);" class="btn btn-light-brand" data-bs-toggle="offcanvas"
                            data-bs-target="#proposalSent">
                            <i class="feather-layers me-2"></i>
                            <span>Save & Send</span>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-primary successAlertMessage">
                            <i class="feather-save me-2"></i>
                            <span>Save</span>
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
        <form method="POST" action="{{ route('admin.updateadmsubmit', $admission->id) }}"
            enctype="multipart/form-data">
            @csrf

            <div class="main-content">
                <div class="row">

                    <input type="hidden" name="student_id" value="{{ $admission->student_id ?? auth()->id() }}">

                    <div class="col-xl-6">
                        <div class="card shadow-sm">
                            <div class="card-body">

                                <h6 class="fw-bold mb-4 text-primary">Student Information</h6>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Full Name *</label>
                                    <input type="text" class="form-control" name="full_name"
                                        value="{{ old('full_name', $admission->full_name) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email ID</label>

                                    <input type="email" class="form-control mb-2" name="email"
                                        placeholder="Enter email" value="{{ old('email', $admission->email) }}">

                                    <div class="d-flex gap-2 mb-2">
                                        <button type="button" onclick="sendEmailOtp()"
                                            class="btn btn-outline-primary btn-sm">
                                            Send OTP
                                        </button>
                                    </div>

                                    <div class="input-group">
                                        <input type="text" id="emailOtp" class="form-control"
                                            placeholder="Enter Email OTP">

                                        <button type="button" onclick="verifyEmailOtp()" class="btn btn-success">
                                            Verify
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Contact Number</label>

                                    <input type="text" class="form-control mb-2" name="phone"
                                        placeholder="Enter phone number" value="{{ old('phone', $admission->phone) }}">

                                    <div class="d-flex gap-2 mb-2">
                                        <button type="button" onclick="sendPhoneOtp()"
                                            class="btn btn-outline-primary btn-sm">
                                            Send OTP
                                        </button>
                                    </div>

                                    <div class="input-group">
                                        <input type="text" id="phoneOtp" class="form-control"
                                            placeholder="Enter Phone OTP">

                                        <button type="button" onclick="verifyPhoneOtp()" class="btn btn-success">
                                            Verify
                                        </button>
                                    </div>
                                </div>



                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Father's / Guardian Name</label>
                                    <input type="text" class="form-control" name="father_name"
                                        placeholder="Enter guardian name"
                                        value="{{ old('father_name', $admission->father_name) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Admission Status</label>
                                    <select class="form-select" name="admission_status">
                                        <option value="pending"
                                            {{ old('admission_status', $admission->admission_status) == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="approved"
                                            {{ old('admission_status', $admission->admission_status) == 'approved' ? 'selected' : '' }}>
                                            Approved</option>
                                        <option value="rejected"
                                            {{ old('admission_status', $admission->admission_status) == 'rejected' ? 'selected' : '' }}>
                                            Rejected</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card shadow-sm">
                            <div class="card-body">

                                <h6 class="fw-bold mb-4 text-primary">Address & Documents</h6>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Address</label>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <input type="text" class="form-control" name="address_line1"
                                                placeholder="Address Line 1"
                                                value="{{ old('address_line1', $admission->address_line1) }}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <input type="text" class="form-control" name="address_line2"
                                                placeholder="Address Line 2"
                                                value="{{ old('address_line2', $admission->address_line2) }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Passport Photo -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        Passport Size Photo (JPEG/PNG)
                                        <small class="text-muted">(Max 2MB)</small>
                                    </label>

                                    <input type="file" id="photoInput" name="photo" class="form-control mb-2"
                                        accept="image/*" onchange="validateAndPreview(event, 'photoPreview', 2)">

                                    <div class="invalid-feedback" id="photoError"></div>

                                    <div class="text-center">

                                        @if ($admission->photo)
                                            <img id="photoPreview" src="{{ asset('storage/' . $admission->photo) }}"
                                                class="img-thumbnail" style="max-height: 180px;">
                                        @else
                                            <img id="photoPreview" class="img-thumbnail d-none"
                                                style="max-height: 180px;">
                                        @endif

                                    </div>
                                </div>

                                <!-- Signature -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Signature (JPEG/PNG)
                                        <small class="text-muted">(Max 1MB)</small>
                                    </label>

                                    <input type="file" id="signInput" name="signature" class="form-control mb-2"
                                        accept="image/*" onchange="validateAndPreview(event, 'signPreview', 1)">

                                    <div class="invalid-feedback" id="signError"></div>

                                    <div class="text-center">

                                        @if ($admission->signature)
                                            <img id="signPreview"
                                                src="{{ asset('storage/' . $admission->signature) }}"
                                                class="img-thumbnail" style="max-height: 150px;">
                                        @else
                                            <img id="signPreview" class="img-thumbnail d-none"
                                                style="max-height: 150px;">
                                        @endif

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            Update Admission
                        </button>
                    </div>

                </div>
            </div>
        </form>
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
