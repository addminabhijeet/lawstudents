@include('layouts.partials.admin.dashboard')
<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Site Pages</li>
                    <li class="breadcrumb-item">{{ $page->title }}</li>
                    <li class="breadcrumb-item">Edit</li>
                </ul>
            </div>
        </div>
        <!-- [ page-header ] end -->

        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Edit: {{ $page->title }}</h6>
                            <a href="{{ route('admin.listsitepages') }}" class="btn btn-sm btn-secondary">
                                <i class="feather-arrow-left"></i> Back
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.updatesitepage', $page->id) }}" method="POST">
                                @csrf

                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Page Title</label>
                                    <input
                                        type="text"
                                        name="title"
                                        id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $page->title) }}"
                                        required>
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Slug (Read-only) -->
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug (Read-only)</label>
                                    <input
                                        type="text"
                                        name="slug"
                                        id="slug"
                                        class="form-control"
                                        value="{{ $page->slug }}"
                                        readonly>
                                    <small class="text-muted">This URL slug cannot be changed.</small>
                                </div>

                                <!-- Content Editor -->
                                <div class="mb-3">
                                    <label for="editor" class="form-label">Page Content</label>
                                    <p class="text-muted small">Use the editor below to add formatted text, headings, links, and lists.</p>

                                    <div id="editor" style="height: 500px; background-color: white;">
                                        {!! old('content', $page->content) !!}
                                    </div>

                                    <!-- Hidden input to store Quill content -->
                                    <input type="hidden" name="content" id="content">

                                    @error('content')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('admin.listsitepages') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="feather-save"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>

<!-- Quill Editor CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/quill.min.css') }}">

<script src="{{ asset('assets/vendors/js/quill.min.js') }}"></script>
<script>
    // Initialize Quill editor
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        },
        placeholder: 'Start editing...'
    });

    // Sync Quill content to hidden input before form submission.
    // (The first <form> on the page is the header's logout form, so target the editor's own form.)
    document.getElementById('content').closest('form').addEventListener('submit', function(e) {
        document.getElementById('content').value = quill.root.innerHTML;
    });
</script>

@include('layouts.partials.admin.theme')
