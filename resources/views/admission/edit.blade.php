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
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', $admission->email) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Gender *</label>
                                    <select class="form-select" name="gender">
                                        <option value="male"
                                            {{ old('gender', $admission->gender) == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female"
                                            {{ old('gender', $admission->gender) == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="other"
                                            {{ old('gender', $admission->gender) == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Phone *</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ old('phone', $admission->phone) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Alternate Phone</label>
                                    <input type="text" class="form-control" name="alternate_phone"
                                        value="{{ old('alternate_phone', $admission->alternate_phone) }}">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-semibold">DOB *</label>
                                        <input type="date" class="form-control" name="dob"
                                            value="{{ old('dob', $admission->dob?->format('Y-m-d')) }}">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-semibold">Pincode *</label>
                                        <input type="text" class="form-control" name="pincode"
                                            value="{{ old('pincode', $admission->pincode) }}">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h6 class="fw-bold mb-3 text-primary">Parent / Guardian Details</h6>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Father Name</label>
                                    <input type="text" class="form-control" name="father_name"
                                        value="{{ old('father_name', $admission->father_name) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Mother Name</label>
                                    <input type="text" class="form-control" name="mother_name"
                                        value="{{ old('mother_name', $admission->mother_name) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Guardian Phone</label>
                                    <input type="text" class="form-control" name="guardian_phone"
                                        value="{{ old('guardian_phone', $admission->guardian_phone) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Guardian Email</label>
                                    <input type="email" class="form-control" name="guardian_email"
                                        value="{{ old('guardian_email', $admission->guardian_email) }}">
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

                                <h6 class="fw-bold mb-4 text-primary">Address & Course Details</h6>

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

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <input type="text" class="form-control" name="city" placeholder="City"
                                            value="{{ old('city', $admission->city) }}">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <input type="text" class="form-control" name="state"
                                            placeholder="State" value="{{ old('state', $admission->state) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <input type="text" class="form-control" name="country"
                                            placeholder="Country"
                                            value="{{ old('country', $admission->country ?? 'India') }}">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <input type="text" class="form-control" name="course_name"
                                            placeholder="Course Name"
                                            value="{{ old('course_name', $admission->course_name) }}">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h6 class="fw-bold mb-3 text-primary">Documents</h6>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Photo</label>
                                    <input type="file" class="form-control" name="photo">
                                    @if ($admission->photo)
                                        <img src="{{ asset('storage/' . $admission->photo) }}"
                                            class="img-thumbnail mt-2" style="max-height:120px;">
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Signature</label>
                                    <input type="file" class="form-control" name="signature">
                                    @if ($admission->signature)
                                        <img src="{{ asset('storage/' . $admission->signature) }}"
                                            class="img-thumbnail mt-2" style="max-height:100px;">
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Marksheet</label>
                                    <input type="file" class="form-control" name="marksheet">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">ID Proof</label>
                                    <input type="file" class="form-control" name="id_proof">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Remarks</label>
                                    <textarea class="form-control" name="remarks" rows="3">{{ old('remarks', $admission->remarks) }}</textarea>
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
@include('layouts.partials.admin.theme')
