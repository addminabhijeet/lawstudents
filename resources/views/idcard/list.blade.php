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
                    <li class="breadcrumb-item">ID Card</li>
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
                                            <th>Date</th>
                                            <th>ID Number</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $groupedPayments = $payments->groupBy('student_id');
                                        @endphp

                                        @forelse($groupedPayments as $studentId => $studentPayments)
                                            @php
                                                $firstPayment = $studentPayments->first();
                                            @endphp

                                            <tr class="single-item">
                                                <td>
                                                    {{ $loop->iteration }}
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
                                                    {{ \Carbon\Carbon::parse($firstPayment->created_at)->format('Y-m-d, h:i A') }}
                                                </td>

                                                <td>
                                                    {{-- Show first invoice --}}
                                                    <a class="fw-bold">
                                                        {{ $firstPayment->invoice_number }}
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


                                                        <a href="{{ route('admin.viewidcard', $firstPayment->id) }}"
                                                            class="avatar-text avatar-md"
                                                            title="ID #{{ $firstPayment->invoice_number }}">
                                                            <i class="fas fa-id-card"></i>
                                                        </a>


                                                        <button type="button"
                                                            class="avatar-text avatar-md toggle-viewid-btn"
                                                            data-id="{{ $firstPayment->id }}"
                                                            data-status="{{ $firstPayment->viewid ? 1 : 0 }}"
                                                            title="{{ $firstPayment->viewid ? 'Click to Hide' : 'Click to make Visible' }}">
                                                            <i
                                                                class="feather {{ $firstPayment->viewid ? 'feather-eye-off' : 'feather-eye' }}"></i>
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No ID Card Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $payments->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                                                <li
                                                    class="page-item {{ $payments->currentPage() == $page ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            <!-- Next Page -->
                                            <li class="page-item {{ !$payments->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $payments->nextPageUrl() }}"
                                                    aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="visually-hidden">Next</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.toggle-viewid-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const currentStatus = this.dataset.status;

                fetch("{{ route('admin.toggleviewid') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            id: id,
                            current_status: currentStatus
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.dataset.status = data.new_status;
                            this.title = data.new_status == 1 ? 'Click to Hide' :
                                'Click to make Visible';
                            this.querySelector('i').className =
                                `feather ${data.new_status == 1 ? 'feather-eye-off' : 'feather-eye'}`;
                        }
                    })
                    .catch(err => console.error(err));
            });
        });
    });
</script>
@include('layouts.partials.admin.theme')
