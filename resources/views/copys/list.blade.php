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
                    <li class="breadcrumb-item">Free Notes</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">

                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('admin.addcopys') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Add Free Notes</span>
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
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($copyss as $copys)
                                        <tr>
                                            <!-- Serial -->
                                            <td>{{ $copyss->firstItem() + $loop->index }}</td>

                                            <!-- Category -->
                                            <td>{{ $copys->category?->name }}</td>

                                            <!-- Subcategory -->
                                            <td>{{ $copys->subcategory?->name }}</td>

                                            <!-- Description -->
                                            <td>
                                                <div>{{ $copys->description }}</div>
                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                    @foreach ($copys->pdfs ?? [] as $pdf)
                                                        <a href="{{ asset('storage/' . $pdf) }}" class="btn btn-sm btn-outline-primary"
                                                            data-document-preview data-preview-title="{{ basename($pdf) }}">
                                                            <i class="feather-file-text me-1" aria-hidden="true"></i>PDF {{ $loop->iteration }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </td>

                                            <!-- Actions -->
                                            <td>
                                                <div class="d-flex flex-column gap-2">

                                                    <!-- Edit -->
                                                    <a href="{{ route('admin.editcopys', $copys->id) }}"
                                                        class="btn btn-sm btn-primary w-100">
                                                        Edit
                                                    </a>



                                                    <!-- Delete Whole Free Notes -->
                                                    <form method="POST"
                                                        action="{{ route('admin.copysfiledelete', $copys->id) }}">
                                                        @csrf
                                                

                                                        <button class="btn btn-sm btn-danger w-100"
                                                            onclick="return confirm('Delete this copy and all PDFs?')">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>

                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Free Notes</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                </div>
                                @include('admin.partials.pagination', ['paginator' => $copyss])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')