@include('layouts.partials.admin.dashboard')

<main class="nxl-container">
    <div class="nxl-content">

        <!-- Header -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Course Subjects</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>

            <div class="page-header-right ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.addsubject') }}" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Add Subject</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">

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
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Subject Name</th>
                                            <th>Course</th>
                                            <th>Chapters</th>
                                            <th>Sort Order</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($subjects as $subject)
                                            <tr class="single-item">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $subject->name }}</td>
                                                <td>{{ $subject->course->title ?? '—' }}</td>
                                                <td>{{ $subject->chapters()->where('delete', 1)->count() }}</td>
                                                <td>{{ $subject->sort_order }}</td>
                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <a href="{{ route('admin.editsubject', $subject->id) }}"
                                                            class="avatar-text avatar-md" title="Edit Subject">
                                                            <i class="feather feather-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.deletesubject', $subject->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit"
                                                                class="avatar-text avatar-md text-danger"
                                                                title="Delete Subject"
                                                                onclick="return confirm('Are you sure you want to delete this subject?')">
                                                                <i class="feather feather-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No Subjects Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center mt-3">
                                    {{ $subjects->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')
