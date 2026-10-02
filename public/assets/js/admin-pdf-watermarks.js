(function () {
    'use strict';
    document.addEventListener('click', function (event) {
        const button = event.target.closest('.edit-note-btn');
        const edit = document.getElementById('editShowWatermark');
        if (!button || !edit) return;
        const saved = document.querySelector('[data-pdf-watermark][data-type="course-note"][data-id="' + button.dataset.id + '"]');
        edit.checked = saved ? saved.checked : true;
    }, true);
    document.addEventListener('change', async function (event) {
        const input = event.target.closest('[data-pdf-watermark]');
        if (!input) return;
        const enabled = input.checked;
        const error = input.closest('.pdf-watermark-control').querySelector('[data-watermark-error]');
        input.disabled = true;
        error.textContent = '';
        try {
            const response = await fetch(input.dataset.url, {
                method: 'PUT', credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': input.dataset.csrf },
                body: JSON.stringify({ type: input.dataset.type, id: Number(input.dataset.id), index: Number(input.dataset.index), enabled: enabled })
            });
            if (!response.ok) throw new Error('Save failed');
            const result = await response.json();
            input.checked = result.enabled;
            document.querySelectorAll('[data-pdf-watermark]').forEach(function (other) {
                if (other.dataset.type === input.dataset.type && other.dataset.id === input.dataset.id && other.dataset.index === input.dataset.index) other.checked = result.enabled;
            });
        } catch (_) {
            input.checked = !enabled;
            error.textContent = 'Could not save watermark setting. Please try again.';
        } finally {
            input.disabled = false;
        }
    });
}());
