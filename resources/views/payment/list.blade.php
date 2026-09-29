@include('layouts.partials.admin.dashboard')
<main class="nxl-container">
    <!-- main containts -->
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Payments</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
        </div>

        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->



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
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="paymentList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($payments as $firstPayment)
                                        <tr class="single-item">
                                            <td>
                                                {{ $payments->firstItem() + $loop->index }}
                                            </td>

                                            <td>
                                                <a class="hstack gap-3">
                                                    <div>
                                                        <span class="text-truncate-1-line">
                                                            {{ $firstPayment->to_name }}
                                                        </span>
                                                    </div>
                                                </a>
                                            </td>

                                            <td>
                                                <a class="hstack gap-3">
                                                    <div>
                                                        <small class="fs-12 fw-normal text-muted">
                                                            {{ $firstPayment->to_email }}
                                                        </small>
                                                    </div>
                                                </a>
                                            </td>

                                            <td>
                                                @if ($firstPayment->payment_status == 'paid')
                                                @if ($firstPayment->paid_amount > 0)
                                                <div class="badge bg-soft-success text-success">Completed
                                                </div>
                                                @else
                                                <div class="badge bg-soft-warning text-warning">Pending
                                                </div>
                                                @endif
                                                @elseif($firstPayment->payment_status == 'pending')
                                                <div class="badge bg-soft-warning text-warning">Pending</div>
                                                @elseif($firstPayment->payment_status == 'failed')
                                                <div class="badge bg-soft-danger text-danger">Failed</div>
                                                @else
                                                <div class="badge bg-soft-secondary text-secondary">
                                                    {{ ucfirst($firstPayment->payment_status) }}
                                                </div>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    {{-- View buttons for each payment --}}

                                                    <a href="{{ route('admin.viewpayment', $firstPayment->id) }}"
                                                        class="avatar-text avatar-md">
                                                        <i class="feather feather-eye"></i>
                                                    </a>


                                                    {{-- Single Edit button for student --}}
                                                    <a href="{{ route('admin.editpayment', $firstPayment->id) }}"
                                                        class="avatar-text avatar-md">
                                                        <i class="feather feather-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No Payments Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                            @include('admin.partials.pagination', ['paginator' => $payments])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')
