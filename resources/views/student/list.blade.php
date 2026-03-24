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
                    <li class="breadcrumb-item">Applications</li>
                    <li class="breadcrumb-item">List Students</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('admin.addstudent') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Add Student</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="paymentList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr class="single-item">
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td><a href="javascript:void(0)"
                                                        class="fw-bold">{{ $student->username }}</a></td>
                                                <td>
                                                    <a href="javascript:void(0)" class="hstack gap-3">
                                                        <div>
                                                            <small
                                                                class="fs-12 fw-normal text-muted">{{ $student->email }}</small>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="fw-bold text-dark">
                                                    {{ $student->name }}
                                                </td>
                                                <td>{{ $student->created_at->format('Y-m-d, h:iA') }}</td>

                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">

                                                        <a href="{{ route('admin.viewstudent', $student->id) }}"
                                                            class="avatar-text avatar-md">
                                                            <i class="feather feather-eye"></i>
                                                        </a>

                                                        <a href="{{ route('admin.editstudent', $student->id) }}"
                                                            class="avatar-text avatar-md">
                                                            <i class="feather feather-edit"></i>
                                                        </a>

                                                        <form action="{{ route('admin.destroystudent', $student->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="avatar-text avatar-md border-0 bg-transparent">
                                                                <i class="feather feather-trash-2 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($students->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No students found.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $students->links('pagination::bootstrap-5') }}
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
@include('layouts.partials.admin.theme')
