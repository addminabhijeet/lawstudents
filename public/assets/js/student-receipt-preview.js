/* Opens the student's payment receipt in a popup over the current page, like the admin panel does. */
(function (w, d) {
    'use strict';
    if (!d.body.classList.contains('ls-student') || typeof HTMLDialogElement === 'undefined') { return; }
    var dialog, body, status, controller, returnFocus, sequence = 0;

    function candidate(link) {
        if (!link || link.hasAttribute('download') || link.hasAttribute('data-no-preview')) { return null; }
        var raw = link.getAttribute('href');
        if (!raw || raw.charAt(0) === '#') { return null; }
        var url;
        try { url = new URL(raw, w.location.href); } catch (_) { return null; }
        if (url.origin !== w.location.origin || !/^https?:$/.test(url.protocol)) { return null; }
        if (!/\/student\/view-payment\/?$/.test(url.pathname)) { return null; }
        return { url: url.href, title: 'Payment receipt' };
    }

    function build() {
        dialog = d.createElement('dialog');
        dialog.className = 'student-preview';
        dialog.setAttribute('aria-labelledby', 'studentPreviewTitle');
        dialog.innerHTML = '<header class="student-preview__header"><div class="student-preview__heading">' +
            '<h2 id="studentPreviewTitle">Payment receipt</h2><p>Preview without leaving your current page</p></div>' +
            '<div class="student-preview__actions">' +
            '<button type="button" class="btn btn-outline-secondary" data-preview-expand aria-pressed="false">Full screen</button>' +
            '<button type="button" class="btn btn-primary" data-preview-close autofocus>Close</button></div></header>' +
            '<p class="student-preview__status" role="status" aria-live="polite"></p><div class="student-preview__body"></div>';
        d.body.appendChild(dialog);
        body = dialog.querySelector('.student-preview__body');
        status = dialog.querySelector('[role="status"]');
        dialog.querySelector('[data-preview-close]').addEventListener('click', function () { dialog.close(); });
        dialog.querySelector('[data-preview-expand]').addEventListener('click', function () {
            var expanded = dialog.classList.toggle('is-expanded');
            this.setAttribute('aria-pressed', String(expanded));
            this.textContent = expanded ? 'Exit full screen' : 'Full screen';
        });
        dialog.addEventListener('click', function (event) {
            var rect = dialog.getBoundingClientRect();
            if (event.target === dialog && (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom)) { dialog.close(); }
        });
        dialog.addEventListener('close', function () {
            sequence++;
            if (controller) { controller.abort(); }
            body.replaceChildren();
            d.body.classList.remove('student-preview-open');
            if (returnFocus && returnFocus.isConnected) { returnFocus.focus(); }
        });
    }

    function open(item, link) {
        if (!dialog) { build(); }
        if (controller) { controller.abort(); }
        controller = new AbortController();
        var id = ++sequence;
        returnFocus = link;
        body.replaceChildren();
        status.textContent = 'Loading receipt…';
        dialog.classList.remove('is-expanded');
        var expand = dialog.querySelector('[data-preview-expand]');
        expand.textContent = 'Full screen';
        expand.setAttribute('aria-pressed', 'false');
        if (!dialog.open) { dialog.showModal(); }
        d.body.classList.add('student-preview-open');

        fetch(item.url, { method: 'HEAD', credentials: 'same-origin', signal: controller.signal, headers: { Accept: '*/*' } })
            .then(function (response) {
                if (id !== sequence) { return; }
                if (!response.ok) { throw new Error(response.status === 404 ? 'This receipt is no longer available.' : 'Unable to load this receipt. Please try again.'); }
                if (response.redirected && /\/login(?:[/?]|$)/i.test(response.url)) { throw new Error('Your session has expired. Close this preview and sign in again.'); }
                var viewer = d.createElement('iframe');
                viewer.title = item.title;
                viewer.addEventListener('load', function () {
                    if (id !== sequence) { return; }
                    status.textContent = '';
                    try { viewer.contentDocument.addEventListener('keydown', function (event) { if (event.key === 'Escape') { dialog.close(); } }); } catch (_) { /* cross-origin frame: nothing to hook */ }
                });
                viewer.addEventListener('error', function () { if (id === sequence) { status.textContent = 'Preview unavailable. Close it and try again.'; } });
                viewer.src = item.url;
                body.appendChild(viewer);
            })
            .catch(function (error) {
                if (id !== sequence || error.name === 'AbortError') { return; }
                status.textContent = error.message === 'Failed to fetch' ? 'Connection interrupted. Close the preview and try again.' : error.message;
                var empty = d.createElement('div');
                empty.className = 'student-preview__empty';
                empty.textContent = 'Receipt preview unavailable';
                body.replaceChildren(empty);
            });
    }

    d.addEventListener('click', function (event) {
        if (event.defaultPrevented || event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) { return; }
        var link = event.target.closest && event.target.closest('a[href]');
        var item = candidate(link);
        if (!item) { return; }
        event.preventDefault();
        event.stopImmediatePropagation();
        open(item, link);
    }, true);
})(window, document);
