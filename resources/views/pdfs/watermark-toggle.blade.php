@php
    $watermarkEnabled = app(\App\Services\PdfWatermarkService::class)->isEnabled($file);
    $watermarkId = 'watermark-' . \Illuminate\Support\Str::uuid();
@endphp
<div class="form-check pdf-watermark-control" style="min-width:140px">
    <input type="checkbox" class="form-check-input" id="{{ $watermarkId }}" @checked($watermarkEnabled)
        data-pdf-watermark data-type="{{ $type }}" data-id="{{ $id }}" data-index="{{ $index ?? 0 }}"
        data-url="{{ route('admin.pdf-watermarks.update') }}" data-csrf="{{ csrf_token() }}">
    <label class="form-check-label" for="{{ $watermarkId }}">Show watermark</label>
    <span class="d-block small text-danger" data-watermark-error role="status"></span>
</div>
@once
    <script src="{{ asset('assets/js/admin-pdf-watermarks.js') }}?v={{ filemtime(public_path('assets/js/admin-pdf-watermarks.js')) }}"></script>
@endonce
