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
                    <li class="breadcrumb-item">Legal Knowledge Subcategories</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">

                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('admin.addlegalknowledgelibrarysubcategory') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Add Legal Knowledge Subcategories</span>
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
                                <table class="table table-hover" id="legalKnowledgeLibrarySubcategoriesList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Subcategory Name</th>
                                            <th>Category Name</th>
                                            <th>Date Created</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($subcategories as $index => $subcategorie)
                                        <tr>
                                            <td>{{ $subcategories->firstItem() + $index }}</td>
                                            <td>{{ $subcategorie->name }}</td>
                                            <td>{{ $subcategorie->category ? $subcategorie->category->name : 'N/A' }}</td>
                                            <td>{{ $subcategorie->created_at->format('Y-m-d, h:i A') }}</td>
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{ route('admin.editlegalknowledgelibrarysubcategory', $subcategorie->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                    <form method="POST" action="{{ route('admin.deletelegalknowledgelibrarysubcategoryfile', $subcategorie->id) }}" class="d-inline">
                                                        @csrf

                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this subcategory?')">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Sub Categories found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{-- Page links: shown once by the Bootstrap bar below. --}}

                                </div>
                                @include('admin.partials.pagination', ['paginator' => $subcategories])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')
