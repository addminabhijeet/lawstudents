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
                    <li class="breadcrumb-item">Site Pages</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <!-- Info note -->
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
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Success/Error Messages -->
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="sitePagesList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Last Updated</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pages as $index => $page)
                                        <tr>
                                            <td>{{ $pages->firstItem() + $index }}</td>
                                            <td><strong>{{ $page->title }}</strong></td>
                                            <td><code>{{ $page->slug }}</code></td>
                                            <td>{{ $page->last_updated->format('M d, Y H:i') }}</td>
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{ route('admin.editsitepage', $page->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="feather-edit-2"></i> Edit
                                                    </a>

                                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#resetModal{{ $page->id }}">
                                                        <i class="feather-refresh-cw"></i> Reset
                                                    </button>

                                                    <!-- Reset Confirmation Modal -->
                                                    <div class="modal fade" id="resetModal{{ $page->id }}" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="resetModalLabel">Reset Page</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to reset <strong>{{ $page->title }}</strong> to its default content?</p>
                                                                    <p class="text-muted small">This action will replace all custom edits with the original template.</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <form action="{{ route('admin.resetsitepage', $page->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-warning">Reset</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No pages found. Please run migrations.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{-- Pagination links --}}
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $pages->links() }}
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
