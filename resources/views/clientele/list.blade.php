@include('layouts.partials.admin.dashboard')
<main class="nxl-container apps-container apps-notes">
    <div class="nxl-content without-header nxl-full-content">
        <!-- [ Main Content ] start -->
        <div class="main-content d-flex">
            <!-- [ Content Sidebar ] start -->
            <div class="content-sidebar content-sidebar-md" data-scrollbar-target="#psScrollbarInit">
                <div class="content-sidebar-header bg-white sticky-top hstack justify-content-between">
                    <h4 class="fw-bolder mb-0">Clienteles</h4>
                    <a href="javascript:void(0);" class="app-sidebar-close-trigger d-flex">
                        <i class="feather-x"></i>
                    </a>
                </div>
                <div class="content-sidebar-header">
                    <!-- Add Clientele Button -->
                    <a href="javascript:void(0);" class="btn btn-primary w-100" id="add-clientele" style="display:block;">
                        <i class="feather-plus me-2"></i>
                        <span>Add Clientele</span>
                    </a>
                </div>
                <div class="content-sidebar-body">
                    <ul class="nav d-flex flex-column nxl-content-sidebar-item">
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link note-link active" id="all-clienteles">
                                <i class="feather-layers"></i>
                                <span>All</span>
                            </a>
                        </li>
                        <!-- Optional: categories if you have them -->
                        {{-- @foreach ($categories as $category)
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link note-link" id="category-{{ $category->id }}">
                                    <i class="feather-folder"></i>
                                    <span>{{ $category->name }}</span>
                                </a>
                            </li>
                        @endforeach --}}
                    </ul>
                </div>
            </div>
            <!-- [ Content Sidebar ] end -->

            <!-- [ Main Area ] start -->
            <div class="content-area" data-scrollbar-target="#psScrollbarInit">
                <div class="content-area-header sticky-top">
                    <div class="page-header-right ms-auto">
                        <div class="hstack gap-2">
                            <div class="hstack">
                                <a href="javascript:void(0)" class="search-form-open-toggle">
                                    <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Search">
                                        <i class="feather feather-search"></i>
                                    </div>
                                </a>
                                <form class="search-form" style="display: none">
                                    <div class="search-form-inner">
                                        <a href="javascript:void(0)" class="search-form-close-toggle">
                                            <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Search Close">
                                                <i class="feather feather-arrow-left"></i>
                                            </div>
                                        </a>
                                        <input type="search" class="py-3 px-0 border-0 w-100" id="clienteleSearch" placeholder="Search...">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-area-body pb-0">
                    <div class="row note-has-grid" id="clientele-full-container">
                        @forelse ($clienteles as $clientele)
                            @if (!empty($clientele->pdfs))
                                @foreach ($clientele->pdfs as $item)
                                    <div class="col-xxl-4 col-xl-6 col-lg-4 col-sm-6 single-note-item all-category">
                                        <div class="card card-body mb-4 stretch stretch-full">
                                            <span class="side-stick"></span>

                                            <h5 class="note-title text-truncate w-75 mb-1">
                                                {{ pathinfo($item['file'], PATHINFO_FILENAME) }}
                                            </h5>

                                            <p class="fs-11 text-muted note-date">
                                                Uploaded: {{ $clientele->created_at->format('d F Y') }}
                                            </p>

                                            <div class="note-content flex-grow-1">
                                                <p class="text-muted note-inner-content text-truncate-3-line">
                                                    {{ $item['description'] ?? '' }}
                                                </p>
                                            </div>

                                            <!-- Optional badge -->
                                            <div class="d-flex align-items-center gap-2 mt-2">
                                                <span class="badge bg-primary w-75">
                                                    Clientele
                                                </span>
                                            </div>

                                            <div class="d-flex gap-2 mt-2">
                                                <a href="{{ asset('storage/' . $item['file']) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                                <form method="POST" action="{{ route('admin.clientelefiledelete', [$clientele->id]) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="file" value="{{ $item['file'] }}">
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this file?')">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @empty
                            <p class="text-center">No Clientele Files Found</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')