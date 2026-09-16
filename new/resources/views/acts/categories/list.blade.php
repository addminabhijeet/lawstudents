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
                    <li class="breadcrumb-item">Acts Categories</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>

            <div class="page-header-right ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.addactcategory') }}" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Add Categories Acts</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">

            {{-- Alerts (Same as ID Card Page) --}}
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
                                <table class="table table-hover" id="actsList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Category Name</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($categories as $categorie)

                                            <tr class="single-item">
                                                <td>{{ $loop->iteration }}</td>

                                                <!-- Category Name Styled -->
                                                <td>
                                                    <a class="hstack gap-3">
                                                        <div>
                                                            <span class="text-truncate-1-line">
                                                                {{ $categorie->name }}
                                                            </span>
                                                        </div>
                                                    </a>
                                                </td>

                                                <!-- Actions -->
                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">

                                                        <!-- Edit -->
                                                        <a href="{{ route('admin.editactcategory', [$categorie->id]) }}"
                                                            class="avatar-text avatar-md"
                                                            title="Edit Category">
                                                            <i class="feather feather-edit"></i>
                                                        </a>

                                                        <!-- Delete -->
                                                        <form action="{{ route('admin.deleteactcategoryfile', [$categorie->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                            

                                                            <button type="submit"
                                                                class="avatar-text avatar-md text-danger"
                                                                title="Delete Category"
                                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                                                <i class="feather feather-trash-2"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No Categories Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">

                                            <!-- Previous -->
                                            <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $categories->previousPageUrl() }}">
                                                    &laquo;
                                                </a>
                                            </li>

                                            <!-- Pages -->
                                            @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                                                <li class="page-item {{ $categories->currentPage() == $page ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            <!-- Next -->
                                            <li class="page-item {{ !$categories->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $categories->nextPageUrl() }}">
                                                    &raquo;
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
</main>
@include('layouts.partials.admin.theme')
