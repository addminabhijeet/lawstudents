(function () {
    'use strict';
    const viewer = document.querySelector('[data-protected-note-viewer]');
    const canvas = viewer.querySelector('[data-pdf-canvas]');
    const status = viewer.querySelector('[data-pdf-status]');
    const pages = document.querySelector('[data-pdf-pages]');
    const previous = document.querySelector('[data-pdf-prev]');
    const next = document.querySelector('[data-pdf-next]');
    let pdf = null, pageNumber = 1, rendering = false, resizeTimer;

    async function render() {
        if (!pdf || rendering) return;
        rendering = true;
        previous.disabled = next.disabled = true;
        try {
            const page = await pdf.getPage(pageNumber);
            const viewport = page.getViewport({ scale: 1 });
            const width = viewer.clientWidth - parseFloat(getComputedStyle(viewer).paddingLeft) - parseFloat(getComputedStyle(viewer).paddingRight);
            const density = Math.min(window.devicePixelRatio || 1, 3);
            const scaled = page.getViewport({ scale: width / viewport.width * density });
            canvas.width = scaled.width;
            canvas.height = scaled.height;
            canvas.style.width = Math.floor(scaled.width / density) + 'px';
            canvas.style.height = Math.floor(scaled.height / density) + 'px';
            await page.render({ canvasContext: canvas.getContext('2d'), viewport: scaled }).promise;
            status.hidden = true;
            pages.textContent = pageNumber + ' / ' + pdf.numPages;
        } catch (_) {
            status.hidden = false;
            status.textContent = 'Unable to display this PDF. Please refresh to try again.';
        } finally {
            rendering = false;
            previous.disabled = pageNumber === 1;
            next.disabled = pageNumber === pdf.numPages;
        }
    }
    previous.addEventListener('click', function () { if (pageNumber > 1 && !rendering) { pageNumber--; render(); } });
    next.addEventListener('click', function () { if (pdf && pageNumber < pdf.numPages && !rendering) { pageNumber++; render(); } });
    window.addEventListener('resize', function () { clearTimeout(resizeTimer); resizeTimer = setTimeout(render, 150); });
    if (!window.pdfjsLib) {
        status.textContent = 'Unable to load the PDF viewer. Please refresh to try again.';
        return;
    }
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    pdfjsLib.getDocument({ url: viewer.dataset.fileUrl, isEvalSupported: false, disableRange: true, disableStream: true }).promise
        .then(function (document) { pdf = document; render(); })
        .catch(function () { status.textContent = 'Unable to load this PDF. Please refresh to try again.'; });
}());
