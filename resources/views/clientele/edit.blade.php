@include('layouts.partials.admin.dashboard')
<main class="nxl-container apps-container apps-notes">
    <div class="nxl-content without-header nxl-full-content">
        <!-- [ Main Content ] start -->
        <div class="main-content d-flex">
            <!-- [ Content Sidebar  ] end -->
            <!-- [ Main Area  ] start -->
            <div class="content-area-body pb-0">
                <div class="row note-has-grid">
                    <form action="{{ route('admin.updateclientele', $clientele->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $clientele->description }}</textarea>
                        </div>

                        <h5>Existing PDFs</h5>
                        @if (!empty($clientele->pdfs))
                            @foreach ($clientele->pdfs as $index => $pdf)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $pdf['file']) }}"
                                        target="_blank">{{ pathinfo($pdf['file'], PATHINFO_FILENAME) }}</a>
                                    <input type="text" name="pdf_descriptions[{{ $index }}]"
                                        class="form-control mt-1" value="{{ $pdf['description'] ?? '' }}"
                                        placeholder="Description">

                                    <form method="POST"
                                        action="{{ route('admin.clientelefiledelete', $clientele->id) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="file" value="{{ $pdf['file'] }}">
                                        <button type="submit" class="btn btn-sm btn-danger mt-1">Delete</button>
                                    </form>
                                </div>
                            @endforeach
                        @endif

                        <h5>Add New PDFs</h5>
                        <div id="newPdfsContainer">
                            <div class="mb-2">
                                <input type="file" name="pdfs[]" class="form-control">
                                <input type="text" name="pdf_descriptions[]" class="form-control mt-1"
                                    placeholder="Description">
                            </div>
                        </div>

                        <button type="button" id="addPdfBtn" class="btn btn-sm btn-secondary mb-3">Add Another
                            PDF</button>

                        <button type="submit" class="btn btn-primary">Update Clientele</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')
