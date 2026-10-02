<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - Law Students</title>
    <link rel="stylesheet" href="{{ asset('assets/theme/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/protected-pdf-viewer.css') }}?v={{ filemtime(public_path('assets/css/protected-pdf-viewer.css')) }}">
</head>
<body>
    <header class="protected-pdf-toolbar">
        <a href="{{ route('frontend.home') }}">Law Students</a>
        <h1>{{ $title }}</h1>
        <nav aria-label="PDF pages">
            <button type="button" data-pdf-prev aria-label="Previous page" title="Previous page" disabled><span class="site-icon icon-arrow-left" aria-hidden="true"></span></button>
            <span data-pdf-pages aria-live="polite">Loading</span>
            <button type="button" data-pdf-next aria-label="Next page" title="Next page" disabled><span class="site-icon icon-arrow-right" aria-hidden="true"></span></button>
        </nav>
    </header>
    <main class="pdf-protected-viewer" data-protected-note-viewer data-file-url="{{ $fileUrl }}">
        <p data-pdf-status role="status">Loading PDF...</p>
        <canvas data-pdf-canvas aria-label="{{ $title }}"></canvas>
    </main>
    @include('notesstu.company-watermark')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script src="{{ asset('assets/js/protected-pdf-viewer.js') }}?v={{ filemtime(public_path('assets/js/protected-pdf-viewer.js')) }}"></script>
</body>
</html>
