/*
 * Page loader for the admin and student panels (styles in assets/css/panel-loader.css).
 * Shows the loader only when loading takes longer than SHOW_DELAY:
 *   - while this page is still loading, and
 *   - after a link or form sends the browser to another page.
 * It never blocks longer than MAX_SHOW, and ignores downloads, new tabs, email/phone
 * links and clicks that other code cancelled (e.g. "Cancel" on a confirm box).
 */
(function () {
    'use strict';

    var loader = document.getElementById('panelLoader');
    if (!loader) {
        return;
    }

    var SHOW_DELAY = 400;
    var MAX_SHOW = 15000;
    var showTimer = null;
    var hideTimer = null;

    function show() {
        clearTimeout(showTimer);
        showTimer = setTimeout(function () {
            loader.classList.add('is-visible');
            loader.setAttribute('aria-hidden', 'false');
            clearTimeout(hideTimer);
            hideTimer = setTimeout(hide, MAX_SHOW);
        }, SHOW_DELAY);
    }

    function hide() {
        clearTimeout(showTimer);
        clearTimeout(hideTimer);
        loader.classList.remove('is-visible');
        loader.setAttribute('aria-hidden', 'true');
    }

    // This page is still loading.
    if (document.readyState !== 'complete') {
        show();
        window.addEventListener('load', hide);
    }

    // Back / Forward restores a page from the browser cache with the loader still on.
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            hide();
        }
    });

    function leavesPage(link, event) {
        if (event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return false;
        }
        if ((link.target && link.target !== '_self') || link.hasAttribute('download')) {
            return false;
        }

        var href = link.getAttribute('href') || '';
        if (href === '' || href.charAt(0) === '#' || /^(javascript|mailto|tel):/i.test(href)) {
            return false;
        }

        var url;
        try {
            url = new URL(link.href, window.location.href);
        } catch (e) {
            return false;
        }

        if (url.origin !== window.location.origin) {
            return false;
        }
        if (url.pathname === window.location.pathname && url.search === window.location.search) {
            return false;
        }
        // Files and download routes keep the current page open.
        if (/\/storage\/|download|\.(pdf|jpe?g|png|gif|webp|svg|zip|docx?|xlsx?|csv)$/i.test(url.pathname)) {
            return false;
        }

        return true;
    }

    document.addEventListener('click', function (event) {
        var link = event.target.closest ? event.target.closest('a[href]') : null;
        if (!link || !leavesPage(link, event)) {
            return;
        }
        // Let the page's own click handlers run first; they may cancel the navigation.
        setTimeout(function () {
            if (!event.defaultPrevented) {
                show();
            }
        }, 0);
    });

    document.addEventListener('submit', function (event) {
        var form = event.target;
        if (form.target && form.target !== '_self') {
            return;
        }
        setTimeout(function () {
            if (!event.defaultPrevented) {
                show();
            }
        }, 0);
    });
})();
