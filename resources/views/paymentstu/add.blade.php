@include('layouts.partials.student.dashboard')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Student</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Payment</li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <h5 class="fw-bold mb-2">Payment</h5>
                            <p class="text-muted mb-4">Your payment slips are on the Payment page.</p>
                            <a href="{{ route('student.viewpayment') }}" class="btn btn-primary">
                                <i class="feather-credit-card me-2"></i>Go to Payment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.student.theme')
