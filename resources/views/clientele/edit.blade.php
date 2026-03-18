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
                    <li class="breadcrumb-item">Clientele</li>
                    <li class="breadcrumb-item">Edit Clientele</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <!-- Existing header buttons remain unchanged -->
                </div>
            </div>
        </div>
        <!-- [ page-header ] end -->

        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <form action="{{ route('admin.updateclientele', $clientele->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Existing PDFs (display only, no editing) -->
                                @if (!empty($clientele->pdfs))
                                    <div class="mb-3">
                                        <label class="form-label">Existing PDFs</label>
                                        @foreach ($clientele->pdfs as $pdf)
                                            <div class="mb-1">
                                                <a href="{{ asset('storage/' . $pdf['file']) }}" target="_blank">
                                                    {{ pathinfo($pdf['file'], PATHINFO_BASENAME) }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Upload new PDFs (same as Add form) -->
                                <div class="mb-3">
                                    <label for="pdfs" class="form-label">Upload PDF(s)</label>
                                    <input type="file" name="pdfs[]" id="pdfs" class="form-control" multiple>
                                    @error('pdfs.*')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Description / Button Name -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Button Name / Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $clientele->description) }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Update Clientele</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</main>
