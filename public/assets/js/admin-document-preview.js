/* One in-app preview for PDFs, images and the existing, unchanged receipt pages. */
(function (w, d) {
    'use strict';
    if (!d.body.classList.contains('ls-admin') || d.body.dataset.lsKind === 'doc') { return; }
    var dialog, body, status, download, print, controller, returnFocus, current, loaded = false;
    var sequence = 0;

    function candidate(link) {
        if (!link || link.hasAttribute('download') || link.hasAttribute('data-no-preview')) { return null; }
        var raw = link.getAttribute('href');
        if (!raw || raw.charAt(0) === '#') { return null; }
        var url;
        try { url = new URL(raw, w.location.href); } catch (_) { return null; }
        if (url.origin !== w.location.origin || !/^https?:$/.test(url.protocol)) { return null; }
        var image = /\.(png|jpe?g|gif|webp)$/i.test(url.pathname);
        var pdf = /\.pdf$/i.test(url.pathname) || /\/admin\/course-notes\/view\/\d+\/?$/.test(url.pathname);
        var receipt = /\/admin\/view-payment\/\d+\/?$/.test(url.pathname);
        if (!image && !pdf && !receipt && !link.hasAttribute('data-document-preview')) { return null; }
        return { url: url.href, kind: image ? 'image' : (receipt ? 'receipt' : 'pdf'), description: link.dataset.previewDescription || '',
            title: link.dataset.previewTitle || link.getAttribute('title') || link.textContent.trim() || (receipt ? 'Payment receipt' : 'Document preview') };
    }

    function build() {
        dialog = d.createElement('dialog');
        dialog.className = 'admin-preview';
        dialog.setAttribute('aria-labelledby', 'adminPreviewTitle');
        dialog.innerHTML = '<header class="admin-preview__header"><div class="admin-preview__heading">' +
            '<h2 id="adminPreviewTitle">Document preview</h2><p>Preview without leaving your current page</p></div>' +
            '<div class="admin-preview__actions"><a class="btn btn-outline-primary" data-preview-download download>Download</a>' +
            '<button type="button" class="btn btn-outline-primary" data-preview-print>Print</button>' +
            '<button type="button" class="btn btn-outline-secondary" data-preview-expand aria-pressed="false">Full screen</button>' +
            '<button type="button" class="btn btn-primary" data-preview-close autofocus>Close</button></div></header>' +
            '<p class="admin-preview__description" hidden></p><p class="admin-preview__status" role="status" aria-live="polite"></p><div class="admin-preview__body"></div>';
        d.body.appendChild(dialog);
        body = dialog.querySelector('.admin-preview__body');
        status = dialog.querySelector('[role="status"]');
        download = dialog.querySelector('[data-preview-download]');
        print = dialog.querySelector('[data-preview-print]');
        dialog.querySelector('[data-preview-close]').addEventListener('click', function () { dialog.close(); });
        dialog.querySelector('[data-preview-expand]').addEventListener('click', function () {
            var expanded = dialog.classList.toggle('is-expanded');
            this.setAttribute('aria-pressed', String(expanded));
            this.textContent = expanded ? 'Exit full screen' : 'Full screen';
        });
        print.addEventListener('click', printDocument);
        download.addEventListener('click', function (event) {
            if (current.kind === 'receipt') {
                event.preventDefault();
                var frame = body.querySelector('iframe');
                var buttons = frame && frame.contentDocument ? frame.contentDocument.querySelectorAll('.invoice-toolbar .file-download') : [];
                if (buttons.length === 1) { buttons[0].click(); }
                else { status.textContent = 'Use the Download button on the receipt you need in the preview below.'; }
            }
        });
        dialog.addEventListener('click', function (event) {
            var rect = dialog.getBoundingClientRect();
            if (event.target === dialog && (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom)) { dialog.close(); }
        });
        dialog.addEventListener('close', function () {
            sequence++;
            if (controller) { controller.abort(); }
            body.replaceChildren();
            d.body.classList.remove('admin-preview-open');
            if (returnFocus && returnFocus.isConnected) { returnFocus.focus(); }
        });
    }

    function printDocument() {
        if (!loaded) { return; }
        var frame = body.querySelector('iframe');
        try {
            if (frame) { frame.contentWindow.focus(); frame.contentWindow.print(); }
            else { status.textContent = 'Download this image to print it at its original size.'; }
        } catch (_) { status.textContent = 'Use the print control inside the PDF viewer, or download the file to print it.'; }
    }

    function open(item, link) {
        if (!dialog) { build(); }
        if (controller) { controller.abort(); }
        controller = new AbortController();
        var id = ++sequence;
        current = item;
        returnFocus = link;
        loaded = false;
        print.disabled = true;
        download.hidden = true;
        download.href = item.url;
        download.textContent = 'Download';
        body.replaceChildren();
        status.textContent = 'Loading document…';
        dialog.querySelector('h2').textContent = item.title;
        var description = dialog.querySelector('.admin-preview__description');
        description.textContent = item.description;
        description.hidden = !item.description;
        dialog.classList.remove('is-expanded');
        var expand = dialog.querySelector('[data-preview-expand]');
        expand.textContent = 'Full screen';
        expand.setAttribute('aria-pressed', 'false');
        if (!dialog.open) { dialog.showModal(); }
        d.body.classList.add('admin-preview-open');

        // Check missing files / expired sessions before opening the embedded viewer.
        // HEAD avoids downloading a potentially large file twice.
        fetch(item.url, { method: 'HEAD', credentials: 'same-origin', signal: controller.signal, headers: { Accept: '*/*' } })
            .then(function (response) {
                if (id !== sequence) { return; }
                if (!response.ok) { throw new Error(response.status === 404 ? 'This document is no longer available.' : 'Unable to load this document. Please try again.'); }
                var type = response.headers.get('Content-Type') || '';
                if (response.redirected && /\/login(?:[/?]|$)/i.test(response.url)) { throw new Error('Your session has expired. Close this preview and sign in again.'); }
                if (item.kind === 'pdf' && !/application\/pdf|application\/octet-stream/i.test(type)) { throw new Error('The server did not return a PDF. Close this preview and try again.'); }
                var viewer = d.createElement(item.kind === 'image' ? 'img' : 'iframe');
                if (item.kind === 'image') { viewer.alt = item.title; }
                else { viewer.title = item.title; }
                viewer.addEventListener('load', function () {
                    if (id !== sequence) { return; }
                    loaded = true;
                    print.disabled = item.kind === 'image';
                    download.hidden = false;
                    status.textContent = item.kind === 'pdf' ? 'If your browser cannot display the PDF, use Download above.' : (item.kind === 'receipt' ? 'Use the receipt’s own Download button to save its original PDF.' : 'Image ready.');
                    // Escape still closes the preview when a same-origin HTML document has focus.
                    try { viewer.contentDocument.addEventListener('keydown', function (event) { if (event.key === 'Escape') { dialog.close(); } }); } catch (_) { /* Native PDF viewer owns its keyboard controls. */ }
                });
                viewer.addEventListener('error', function () { if (id === sequence) { status.textContent = 'Preview unavailable. Use Download to open the file on your device.'; download.hidden = false; } });
                viewer.src = item.kind === 'pdf' && item.url.indexOf('#') < 0 ? item.url + '#view=FitH' : item.url;
                body.appendChild(viewer);
            })
            .catch(function (error) {
                if (id !== sequence || error.name === 'AbortError') { return; }
                status.textContent = error.message === 'Failed to fetch' ? 'Connection interrupted. Close the preview and try again.' : error.message;
                var empty = d.createElement('div');
                empty.className = 'admin-preview__empty';
                empty.textContent = 'Document preview unavailable';
                body.replaceChildren(empty);
            });
    }

    // Capture also covers document links inserted by AJAX, modals and related-record menus.
    d.addEventListener('click', function (event) {
        if (event.defaultPrevented || event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) { return; }
        var link = event.target.closest && event.target.closest('a[href]');
        var item = candidate(link);
        if (!item || typeof HTMLDialogElement === 'undefined') { return; }
        event.preventDefault();
        event.stopImmediatePropagation();
        open(item, link);
    }, true);
})(window, document);
