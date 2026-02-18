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
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Gender *</label>
                                    <select class="form-control" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Phone *</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Alternate Phone</label>
                                    <input type="text" class="form-control" name="alternate_phone">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">DOB *</label>
                                        <input type="date" class="form-control" name="dob">
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Pincode *</label>
                                        <input type="text" class="form-control" name="pincode">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Father Name</label>
                                    <input type="text" class="form-control" name="father_name">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Mother Name</label>
                                    <input type="text" class="form-control" name="mother_name">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Guardian Phone</label>
                                    <input type="text" class="form-control" name="guardian_phone">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Guardian Email</label>
                                    <input type="email" class="form-control" name="guardian_email">
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
                                    <label class="form-label">Address *</label>
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
                                        <label class="form-label">Course Name *</label>
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

                                <hr class="my-4">

                                <div class="mb-3">
                                    <label class="form-label">Last Qualification *</label>
                                    <input type="text" class="form-control" name="last_qualification">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Board / University *</label>
                                    <input type="text" class="form-control" name="board_university">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Passing Year *</label>
                                        <input type="number" class="form-control" name="passing_year">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Percentage</label>
                                        <input type="number" class="form-control" name="percentage">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="mb-3">
                                    <label class="form-label">Aadhaar</label>
                                    <input type="text" class="form-control" name="aadhaar_number">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">PAN</label>
                                    <input type="text" class="form-control" name="pan_number">
                                </div>

                                <hr class="my-4">

                                <div class="mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file" class="form-control" name="photo">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Signature</label>
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
@include('layouts.partials.admin.theme')