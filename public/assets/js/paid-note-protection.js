(function () {
    'use strict';

    function active() {
        return document.querySelector('[data-protected-note-viewer], #pdfModal.show');
    }

    function conceal(hidden) {
        document.documentElement.classList.toggle('protected-pdf-concealed', hidden);
    }

    document.addEventListener('keydown', function (event) {
        const key = event.key.toLowerCase();
        const print = (event.ctrlKey || event.metaKey) && key === 'p';
        const save = active() && (event.ctrlKey || event.metaKey) && key === 's';
        const capture = active() && (key === 'printscreen' || (event.metaKey && event.shiftKey && ['3', '4', '5', 's'].includes(key)));
        if (print || save || capture) {
            event.preventDefault();
            event.stopImmediatePropagation();
        }
        if (capture) {
            conceal(true);
            setTimeout(function () { conceal(document.hidden || !document.hasFocus()); }, 1200);
        }
    }, true);

    ['contextmenu', 'copy', 'cut', 'dragstart'].forEach(function (name) {
        document.addEventListener(name, function (event) {
            if (event.target instanceof Element && event.target.closest('.pdf-protected-viewer')) event.preventDefault();
        }, true);
    });
    document.addEventListener('visibilitychange', function () { conceal(!!active() && document.hidden); });
    window.addEventListener('blur', function () { if (active()) conceal(true); });
    window.addEventListener('focus', function () { conceal(document.hidden); });
}());
