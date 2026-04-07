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
                    <li class="breadcrumb-item">Edit</li>
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
        <form method="POST" action="{{ route('admin.updateadmsubmit', $admission->id) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="main-content">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                <div class="row">

                    <input type="hidden" name="student_id" value="{{ auth()->id() }}">

                    <!-- LEFT COLUMN -->
                    <div class="col-xl-6">
                        <div class="card shadow-sm">
                            <div class="card-body">

                                <h6 class="fw-bold mb-4 text-primary">Student Information</h6>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Adm No</label>
                                    <input type="text" class="form-control" name="admno"
                                        value="{{ old('admno', $admission->admno) }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Full Name *</label>
                                    <input type="text" class="form-control" name="full_name"
                                        value="{{ old('full_name', $admission->full_name) }}"
                                        placeholder="Enter full name"
                                        oninput="this.value = this.value
            .replace(/[^a-zA-Z\s]/g, '')  // allow only letters and spaces
            .replace(/\b\w/g, c => c.toUpperCase())"> <!-- capitalize first letter of each word -->
                                </div>

                                <!-- Email Section -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email ID</label>
                                    <input type="email" class="form-control mb-2" name="email"
                                        value="{{ old('email', $admission->email) }}" placeholder="Enter email"
                                        oninput="this.value = this.value
                                        .replace(/[^a-z0-9@.]/g, '') // allow only lowercase letters, numbers, @, .
                                        .replace(/@/g, (m, i, s) => s.indexOf('@') === i ? m : '') // allow only first @
                                        .replace(/\./g, (m, i, s) => s.indexOf('.') === i ? m : '')">

                                    <div class="d-flex gap-2 mb-2">
                                        <button type="button" onclick="sendEmailOtp()"
                                            class="btn btn-outline-primary btn-sm">
                                            Send OTP
                                        </button>
                                    </div>

                                    <div class="input-group">
                                        <input type="text" name="email_otp" id="emailOtp" class="form-control"
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
                                        value="{{ old('phone', $admission->phone) }}" placeholder="Enter phone number">

                                    <!-- <div class="d-flex gap-2 mb-2">
                                        <button type="button" onclick="sendPhoneOtp()"
                                            class="btn btn-outline-primary btn-sm">
                                            Send OTP
                                        </button>
                                    </div>

                                    <div class="input-group">
                                        <input type="text" name="phone_otp" id="phoneOtp" class="form-control"
                                            placeholder="Enter Phone OTP">
                                        <button type="button" onclick="verifyPhoneOtp()" class="btn btn-success">
                                            Verify
                                        </button>
                                    </div> -->
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Father's / Guardian Name</label>
                                    <input type="text" class="form-control" name="father_name"
                                        placeholder="Enter guardian name"
                                        value="{{ old('father_name', $admission->father_name) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Guardian Contact Number</label>
                                    <input type="text" class="form-control mb-2" name="guardian_phone"
                                        value="{{ old('guardian_phone', $admission->guardian_phone) }}"
                                        placeholder="Enter guardian phone number">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Choose from below Course</label>

                                    <div class="border rounded p-3" style="max-height:250px; overflow-y:auto;">
                                        <div class="row">
                                            @foreach ($courses as $course)
                                            <div class="col-md-6">
                                                <div class="form-check mb-2 p-2 border rounded">
                                                    <input class="form-check-input course-checkbox"
                                                        type="checkbox" name="course_ids[]"
                                                        value="{{ $course->id }}"
                                                        data-price="{{ $course->price }}"
                                                        id="course{{ $course->id }}"
                                                        {{ in_array($course->id, old('course_ids', $admission->course_ids ?? [])) ? 'checked' : '' }}>

                                                    <label class="form-check-label fw-semibold"
                                                        for="course{{ $course->id }}">
                                                        {{ $course->title }}
                                                        <br>
                                                        <small class="text-muted">
                                                            ₹{{ $course->price }} | {{ $course->duration }}
                                                        </small>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

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

                    <!-- RIGHT COLUMN -->
                    <div class="col-xl-6">
                        <div class="card shadow-sm">
                            <div class="card-body">

                                <h6 class="fw-bold mb-4 text-primary">Address & Documents</h6>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Address</label>
                                    <div class="row">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="address_line1"
                                                placeholder="Address Line 1"
                                                value="{{ old('address_line1', $admission->address_line1) }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="address_line2"
                                                placeholder="Address Line 2"
                                                value="{{ old('address_line2', $admission->address_line2) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Pincode</label>
                                    <input type="text" class="form-control mb-2" name="pincode"
                                        value="{{ old('pincode', $admission->pincode) }}"
                                        placeholder="Enter pincode">
                                </div>

                                <!-- Passport Photo -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        Passport Size Photo (JPEG/PNG)
                                        <small class="text-muted">(Max 2MB)</small>
                                    </label>
                                    <input type="file" name="photo" id="photoInput" class="form-control mb-2"
                                        accept="image/*" onchange="validateAndPreview(event, 'photoPreview', 2)">

                                    <div class="invalid-feedback" id="photoError"></div>

                                    <div class="text-center">

                                        @if ($admission->photo)
                                        <img id="photoPreview"
                                            src="{{ asset('storage/app/public/' . $admission->photo) }}"
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
                                    <input type="file" name="signature" id="signInput" class="form-control mb-2"
                                        accept="image/*" onchange="validateAndPreview(event, 'signPreview', 1)">

                                    <div class="invalid-feedback" id="signError"></div>

                                    <div class="text-center">
                                        @if ($admission->signature)
                                        <img id="signPreview"
                                            src="{{ asset('storage/app/public/' . $admission->signature) }}"
                                            class="img-thumbnail" style="max-height:150px;">
                                        @else
                                        <img id="signPreview" class="img-thumbnail d-none"
                                            style="max-height:150px;">
                                        @endif
                                    </div>
                                </div>

                                <!-- Fee Structure Section -->
                                <h6 class="fw-bold text-primary mt-3">Fee Structure</h6>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Subtotal:</span>
                                        <span>₹<span id="subtotal">0.00</span></span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span>Discount %:</span>
                                        <input type="number" id="customDiscount" class="form-control"
                                            min="0" max="100"
                                            value="{{ old('discount_percent', $admission->discount_percent ?? 0) }}">
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <span>Discount:</span>
                                        <span>- ₹<span id="discount">0.00</span></span>
                                    </div>

                                    <hr>

                                    <!-- Hidden fields for backend -->
                                    <input type="hidden" name="discount_percent" id="discountPercentInput"
                                        value="{{ old('discount_percent', $admission->discount_percent ?? 0) }}">
                                    <input type="hidden" name="discount" id="discountInput"
                                        value="{{ old('discount', $admission->discount ?? 0) }}">

                                    <div class="d-flex justify-content-between fw-bold">
                                        <span>Total Payable:</span>
                                        <span>₹<span id="grandtotal">0.00</span></span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="fw-semibold">Paid Amount:</span>
                                        <input type="number" name="paidamount" id="paidamount"
                                            class="form-control w-50" min="0"
                                            value="{{ old('paidamount', $admission->paidamount ?? 0) }}">
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="fw-semibold">Remaining Amount:</span>
                                        <span>₹<span
                                                id="remainingamount">{{ old('remamount', $admission->remamount ?? 0) }}</span></span>
                                    </div>

                                    <input type="hidden" name="remamount" id="remamount"
                                        value="{{ old('remamount', $admission->remamount ?? 0) }}">
                                </div>

                                <!-- Declaration -->
                                @if (isset($declaration))
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" name="declaration_accept"
                                        id="declarationCheck" required>

                                    <label class="form-check-label" for="declarationCheck">
                                        {!! $declaration->declaration !!}
                                    </label>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title">Aadhar Card Upload</h6>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    ID Proof (PDF)
                                    <small class="text-muted">(Max 2MB)</small>
                                </label>
                                <input type="file" name="id_proof" id="idProofInputCard" class="form-control mb-2"
                                    accept="application/pdf"
                                    onchange="previewPDF(event, 'idProofPreviewCard', 'idProofButtonCard')">

                                <div class="invalid-feedback" id="idProofErrorCard"></div>

                                <div class="text-center mt-2">
                                    @if ($admission->id_proof)
                                    <!-- Button hidden when iframe is displayed -->
                                    <!-- <a id="idProofButtonCard" href="{{ asset('storage/app/public/' . $admission->id_proof) }}"
                                        target="_blank" class="btn btn-outline-primary w-100 mb-2">
                                        View Current ID Proof
                                    </a> -->
                                    <!-- Inline iframe for uploaded PDF -->
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

                    <!-- SUBMIT BUTTON -->
                    <div class="col-12 mb-3">
                        <button type="submit" class="btn btn-primary w-100">
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
        preview.classList.remove('d-none');

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
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const checkboxes = document.querySelectorAll('.course-checkbox');
        const subtotalEl = document.getElementById('subtotal');
        const discountEl = document.getElementById('discount');
        const grandTotalEl = document.getElementById('grandtotal');
        const discountInput = document.getElementById('customDiscount');
        const paidInput = document.getElementById('paidamount');
        const remainingEl = document.getElementById('remainingamount');
        const hiddenRemInput = document.getElementById('remamount');

        function calculateFees() {
            // Calculate subtotal
            let subtotal = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) subtotal += parseFloat(cb.dataset.price) || 0;
            });

            // Discount
            let discountPercent = parseFloat(discountInput.value) || 0;
            if (discountPercent < 0) discountPercent = 0;
            if (discountPercent > 100) discountPercent = 100;

            let discount = subtotal * (discountPercent / 100);

            // Grand total
            let grandTotal = subtotal - discount;

            // Paid and remaining
            let paid = parseFloat(paidInput.value) || 0;
            if (paid < 0) paid = 0;

            let remaining = grandTotal - paid;
            if (remaining < 0) remaining = 0;

            // Update DOM
            subtotalEl.innerText = subtotal.toFixed(2);
            discountEl.innerText = discount.toFixed(2);
            grandTotalEl.innerText = grandTotal.toFixed(2);
            remainingEl.innerText = remaining.toFixed(2);
            hiddenRemInput.value = remaining.toFixed(2);

            // Update hidden inputs for backend
            document.getElementById('discountPercentInput').value = discountPercent.toFixed(2);
            document.getElementById('discountInput').value = discount.toFixed(2);
        }

        // Event listeners
        checkboxes.forEach(cb => cb.addEventListener('change', calculateFees));
        discountInput.addEventListener('input', calculateFees);
        paidInput.addEventListener('input', calculateFees);

        // Initial load fix (important for edit mode)
        setTimeout(() => {
            calculateFees();
        }, 100);
    });
</script>
@include('layouts.partials.admin.theme')