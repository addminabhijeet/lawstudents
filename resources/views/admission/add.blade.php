@include('layouts.partials.admin.dashboard')
<main class="nxl-container">
    <!-- main containts -->
    <div class="nxl-content">
        <!-- [ page-header ] start -->
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
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <form action="{{ route('admin.registeradmsubmit') }}" method="POST">
            @csrf

            <div class="main-content">
                <div class="row">

                    <input type="hidden" name="student_id" value="{{ auth()->id() }}">

                    <div class="col-xl-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">

                                <div class="mb-4">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" name="full_name">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Email ID</label>
                                    <input type="email" class="form-control" name="email">
                                    <button type="button" onclick="sendEmailOtp()">Send Email OTP</button>
                                    <input type="text" id="emailOtp" placeholder="Enter Email OTP">
                                    <button type="button" onclick="verifyEmailOtp()">Verify</button>
                                </div>

                                {{-- <div class="mb-4">
                                    <label class="form-label">Gender *</label>
                                    <select class="form-control" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div> --}}

                                <div class="mb-4">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" name="phone">
                                    <button type="button" onclick="sendPhoneOtp()">Send Phone OTP</button>
                                    <input type="text" id="phoneOtp" placeholder="Enter Phone OTP">
                                    <button type="button" onclick="verifyPhoneOtp()">Verify</button>
                                </div>

                                <div class="mb-4">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">DOB *</label>
                                        <input type="date" class="form-control" name="dob">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Father's / Guardian Name</label>
                                    <input type="text" class="form-control" name="father_name">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Admission Status</label>
                                    <select class="form-control" name="admission_status">
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">

                                <div>
                                    <label class="form-label">Address</label>
                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <input type="text" class="form-control" name="address_line1"
                                                placeholder="Address Line 1">
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <input type="text" class="form-control" name="address_line2"
                                                placeholder="Address Line 2">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">City *</label>
                                        <input type="text" class="form-control" name="city">
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">State *</label>
                                        <input type="text" class="form-control" name="state">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Country *</label>
                                        <input type="text" class="form-control" name="country" value="India">
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Course Selection</label>
                                        <input type="text" class="form-control" name="course_name">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Course Duration</label>
                                        <input type="text" class="form-control" name="course_duration">
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Admission Session *</label>
                                        <input type="text" class="form-control" name="admission_session">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Passport Size Photo (JPEG/PNG)</label>
                                    <input type="file" class="form-control" name="photo">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Signature (JPEG/PNG)</label>
                                    <input type="file" class="form-control" name="signature">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Marksheet</label>
                                    <input type="file" class="form-control" name="marksheet">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">ID Proof</label>
                                    <input type="file" class="form-control" name="id_proof">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control" name="remarks"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Submit Admission</button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <!-- [ Main Content ] end -->
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
