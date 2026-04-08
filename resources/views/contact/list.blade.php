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
                    <li class="breadcrumb-item">Contact Form</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
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
                                <table class="table table-hover" id="clienteleList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>File Name</th>
                                            <th>Button Name</th>
                                            <th>Date Uploaded</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($contact as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <!-- Full Name -->
                                            <td>{{ $item->first_name }} {{ $item->last_name }}</td>

                                            <!-- Service Type -->
                                            <td>{{ $item->service_type }}</td>

                                            <!-- Created Date -->
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d, h:i A') }}</td>

                                            <td>
                                                <div class="hstack gap-2 justify-content-end">

                                                    <!-- MAIL BUTTON -->
                                                    <a href=""
                                                        class="btn btn-sm btn-success">
                                                        Mail
                                                    </a>

                                                    <!-- DELETE -->
                                                    <form method="POST"
                                                        action="{{ route('deletecontact', $item->id) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Delete this record?')">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Data Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">

                                            <!-- Previous Page -->
                                            <li class="page-item {{ $contact->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $contact->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            @foreach ($contact->getUrlRange(1, $contact->lastPage()) as $page => $url)
                                            <li class="page-item {{ $contact->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                            @endforeach

                                            <!-- Next Page -->
                                            <li class="page-item {{ !$contact->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $contact->nextPageUrl() }}"
                                                    aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
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
@include('layouts.partials.admin.theme')