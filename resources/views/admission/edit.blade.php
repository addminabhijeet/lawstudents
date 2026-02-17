@include('layouts.partials.admin.dashboard')
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
<form method="POST" action="{{ route('admin.updateadmsubmit', $admission->id) }}" enctype="multipart/form-data">
    @csrf

    <div class="main-content">
        <div class="row">

            <input type="hidden" name="student_id" value="{{ $admission->student_id ?? auth()->id() }}">

            <div class="col-xl-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">

                        <div class="mb-4">
                            <label class="form-label">Full Name *</label>
                            <input type="text" class="form-control" name="full_name"
                                value="{{ old('full_name', $admission->full_name) }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $admission->email) }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Gender *</label>
                            <select class="form-control" name="gender">
                                <option value="male"
                                    {{ old('gender', $admission->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female"
                                    {{ old('gender', $admission->gender) == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other"
                                    {{ old('gender', $admission->gender) == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Phone *</label>
                            <input type="text" class="form-control" name="phone"
                                value="{{ old('phone', $admission->phone) }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Alternate Phone</label>
                            <input type="text" class="form-control" name="alternate_phone"
                                value="{{ old('alternate_phone', $admission->alternate_phone) }}">
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <label class="form-label">DOB *</label>
                                <input type="date" class="form-control" name="dob"
                                    value="{{ old('dob', $admission->dob?->format('Y-m-d')) }}">
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label class="form-label">Pincode *</label>
                                <input type="text" class="form-control" name="pincode"
                                    value="{{ old('pincode', $admission->pincode) }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Father Name</label>
                            <input type="text" class="form-control" name="father_name"
                                value="{{ old('father_name', $admission->father_name) }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Mother Name</label>
                            <input type="text" class="form-control" name="mother_name"
                                value="{{ old('mother_name', $admission->mother_name) }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Guardian Phone</label>
                            <input type="text" class="form-control" name="guardian_phone"
                                value="{{ old('guardian_phone', $admission->guardian_phone) }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Guardian Email</label>
                            <input type="email" class="form-control" name="guardian_email"
                                value="{{ old('guardian_email', $admission->guardian_email) }}">
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
                                        placeholder="Address Line 1"
                                        value="{{ old('address_line1', $admission->address_line1) }}">
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <input type="text" class="form-control" name="address_line2"
                                        placeholder="Address Line 2"
                                        value="{{ old('address_line2', $admission->address_line2) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <label class="form-label">City *</label>
                                <input type="text" class="form-control" name="city"
                                    value="{{ old('city', $admission->city) }}">
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label class="form-label">State *</label>
                                <input type="text" class="form-control" name="state"
                                    value="{{ old('state', $admission->state) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <label class="form-label">Country *</label>
                                <input type="text" class="form-control" name="country"
                                    value="{{ old('country', $admission->country ?? 'India') }}">
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label class="form-label">Course Name *</label>
                                <input type="text" class="form-control" name="course_name"
                                    value="{{ old('course_name', $admission->course_name) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <label class="form-label">Course Duration</label>
                                <input type="text" class="form-control" name="course_duration"
                                    value="{{ old('course_duration', $admission->course_duration) }}">
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label class="form-label">Admission Session *</label>
                                <input type="text" class="form-control" name="admission_session"
                                    value="{{ old('admission_session', $admission->admission_session) }}">
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label class="form-label">Last Qualification *</label>
                            <input type="text" class="form-control" name="last_qualification"
                                value="{{ old('last_qualification', $admission->last_qualification) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Board / University *</label>
                            <input type="text" class="form-control" name="board_university"
                                value="{{ old('board_university', $admission->board_university) }}">
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Passing Year *</label>
                                <input type="number" class="form-control" name="passing_year"
                                    value="{{ old('passing_year', $admission->passing_year) }}">
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Percentage</label>
                                <input type="number" class="form-control" name="percentage"
                                    value="{{ old('percentage', $admission->percentage) }}">
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label class="form-label">Aadhaar</label>
                            <input type="text" class="form-control" name="aadhaar_number"
                                value="{{ old('aadhaar_number', $admission->aadhaar_number) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">PAN</label>
                            <input type="text" class="form-control" name="pan_number"
                                value="{{ old('pan_number', $admission->pan_number) }}">
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" class="form-control" name="photo">
                            @if ($admission->photo)
                                <img src="{{ asset('storage/' . $admission->photo) }}" alt="Photo" width="100"
                                    class="mt-2">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Signature</label>
                            <input type="file" class="form-control" name="signature">
                            @if ($admission->signature)
                                <img src="{{ asset('storage/' . $admission->signature) }}" alt="Signature"
                                    width="100" class="mt-2">
                            @endif
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
                            <textarea class="form-control" name="remarks">{{ old('remarks', $admission->remarks) }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Update Admission</button>
            </div>

        </div>
    </div>
</form>

<!-- [ Main Content ] end -->
@include('layouts.partials.admin.footer')
