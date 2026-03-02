@include('layouts.partials.admin.dashboard')
<main class="container-fluid py-4 bg-light">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Create Admission Proposal</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <a href="javascript:void(0);" class="btn btn-outline-primary">
                    <i class="feather-save me-1"></i> Save
                </a>
                <a href="javascript:void(0);" class="btn btn-primary">
                    <i class="feather-send me-1"></i> Save & Send
                </a>
            </div>
        </div>

        <form action="{{ route('admin.registeradmsubmit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="main-content">
                <div class="row">

                    <input type="hidden" name="student_id" value="{{ auth()->id() }}">

                    <!-- LEFT COLUMN -->
                    <div class="col-xl-6">
                        <div class="card shadow-sm">
                            <div class="card-body">

                                <h6 class="fw-bold mb-4 text-primary">Student Information</h6>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Full Name *</label>
                                    <input type="text" class="form-control" name="full_name"
                                        placeholder="Enter full name">
                                </div>

                                <!-- Email Section -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email ID</label>
                                    <input type="email" class="form-control mb-2" name="email"
                                        placeholder="Enter email">

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

                                <!-- Phone Section -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Contact Number</label>
                                    <input type="text" class="form-control mb-2" name="phone"
                                        placeholder="Enter phone number">

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
                                        placeholder="Enter guardian name">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Admission Status</label>
                                    <select class="form-select" name="admission_status">
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN -->
                    <div class="col-xl-6">
                        <div class="card shadow-sm">
                            <div class="card-body">

                                <h6 class="fw-bold mb-4 text-primary">Address & Documents</h6>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Address</label>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <input type="text" class="form-control" name="address_line1"
                                                placeholder="Address Line 1">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <input type="text" class="form-control" name="address_line2"
                                                placeholder="Address Line 2">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Passport Size Photo (JPEG/PNG)</label>
                                    <input type="file" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Signature (JPEG/PNG)</label>
                                    <input type="file" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            Submit Admission
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
@include('layouts.partials.admin.theme')
