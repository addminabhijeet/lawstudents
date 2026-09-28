/*
 * Panel suite: everyday helpers for the admin and student panels (each shell describes
 * its own pages, menu words and shortcuts in the #lsPanelData block).
 *   - search palette (Ctrl/Cmd K or /): pages, and students / payments / messages / courses
 *   - page bar: real page title, breadcrumb, related buttons, pin-to-menu star
 *   - list tools: filter, sort, column chooser, export / print / copy, row "more" menu
 *   - menu: find box, pinned pages, opens on the current page
 *   - forms: busy state on save, "jump to save" on long forms, unsaved-changes warning
 *   - display settings (row spacing, text size, calm motion), shortcuts, back-to-top, footer
 *
 * Presentation only. It reads what is already on the page (plus two read-only endpoints
 * for search and related links) and never changes what a form sends or what a page does
 * when it is saved. Everything is added on top of the page, so if this file fails to load
 * the page still works as before. Styles: assets/css/panel-suite.css.
 */
(function (w, d) {
    'use strict';
    if (w.__lsSuite) { return; }
    w.__lsSuite = true;

    /* ------------------------------------------------------------------ */
    /*  Small helpers                                                      */
    /* ------------------------------------------------------------------ */
    var DATA = (function () {
        try { return JSON.parse((d.getElementById('lsPanelData') || {}).textContent || '{}'); } catch (e) { return {}; }
    })();
    var PAGE = DATA.page || {};
    var ENDPOINTS = DATA.endpoints || {};
    var IS_MAC = /Mac|iPhone|iPad|iPod/.test(navigator.platform || navigator.userAgent || '');

    function $(sel, root) { return (root || d).querySelector(sel); }
    function $$(sel, root) { return Array.prototype.slice.call((root || d).querySelectorAll(sel)); }
    function esc(s) {
        return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
        });
    }
    function make(tag, cls, html) {
        var n = d.createElement(tag);
        if (cls) { n.className = cls; }
        if (html != null) { n.innerHTML = html; }
        return n;
    }
    function icon(name) { return '<i class="feather-' + esc(name) + '" aria-hidden="true"></i>'; }
    function store(key, val) {
        try {
            if (val === undefined) { return w.localStorage.getItem(key); }
            if (val === null) { w.localStorage.removeItem(key); } else { w.localStorage.setItem(key, val); }
        } catch (e) { /* private mode: nothing is remembered */ }
        return null;
    }
    function storeJSON(key, val) {
        if (val === undefined) {
            try { return JSON.parse(store(key) || 'null'); } catch (e) { return null; }
        }
        store(key, JSON.stringify(val));
        return null;
    }
    function debounce(fn, ms) {
        var t;
        return function () {
            var a = arguments, self = this;
            clearTimeout(t);
            t = setTimeout(function () { fn.apply(self, a); }, ms);
        };
    }
    function isTyping(target) {
        if (!target) { return false; }
        var t = (target.tagName || '').toLowerCase();
        return t === 'input' || t === 'textarea' || t === 'select' || target.isContentEditable;
    }
    function pathKey() { return w.location.pathname + w.location.search; }

    /* ------------------------------------------------------------------ */
    /*  Toasts                                                             */
    /* ------------------------------------------------------------------ */
    var toastBox = null;
    function toast(message, tone) {
        if (!toastBox) {
            toastBox = make('div', 'ls-toasts');
            toastBox.setAttribute('role', 'status');
            toastBox.setAttribute('aria-live', 'polite');
            d.body.appendChild(toastBox);
        }
        var t = make('div', 'ls-toast ls-toast--' + (tone || 'ok'), esc(message));
        toastBox.appendChild(t);
        requestAnimationFrame(function () { t.classList.add('is-in'); });
        setTimeout(function () {
            t.classList.remove('is-in');
            setTimeout(function () { if (t.parentNode) { t.parentNode.removeChild(t); } }, 300);
        }, 3200);
    }
    w.LSPanel = { toast: toast };

    /* ------------------------------------------------------------------ */
    /*  Keyboard hints: "Ctrl K" reads "⌘ K" on a Mac                      */
    /* ------------------------------------------------------------------ */
    $$('[data-ls-kbd]').forEach(function (k) {
        k.textContent = (IS_MAC ? '⌘ ' : 'Ctrl ') + k.getAttribute('data-ls-kbd');
    });

    /* ------------------------------------------------------------------ */
    /*  Layers: palette, help dialog, create sheet                         */
    /* ------------------------------------------------------------------ */
    var openLayerEl = null;
    var lastFocus = null;

    function focusables(root) {
        return $$('a[href], button:not([disabled]), input:not([disabled]), select, textarea, [tabindex]:not([tabindex="-1"])', root)
            .filter(function (n) { return n.offsetParent !== null; });
    }
    function openLayer(node, focusSel) {
        if (!node) { return; }
        if (openLayerEl && openLayerEl !== node) { closeLayer(openLayerEl, true); }
        lastFocus = d.activeElement;
        node.hidden = false;
        d.body.classList.add('ls-layer-open');
        openLayerEl = node;
        requestAnimationFrame(function () {
            node.classList.add('is-open');
            var f = focusSel ? $(focusSel, node) : focusables(node)[0];
            if (f) { f.focus(); }
        });
    }
    function closeLayer(node, quiet) {
        node = node || openLayerEl;
        if (!node) { return; }
        if (node.__onClose) { var cb = node.__onClose; node.__onClose = null; cb(); }
        node.classList.remove('is-open');
        node.hidden = true;
        d.body.classList.remove('ls-layer-open');
        if (openLayerEl === node) { openLayerEl = null; }
        if (!quiet && lastFocus && lastFocus.focus) { try { lastFocus.focus(); } catch (e) { /* element gone */ } }
    }

    d.addEventListener('click', function (e) {
        var closer = e.target.closest ? e.target.closest('[data-ls-close]') : null;
        if (closer) { closeLayer(closer.closest('.ls-palette, .ls-dialog, .ls-sheet')); return; }

        var opener = e.target.closest ? e.target.closest('[data-ls-open]') : null;
        if (!opener) { return; }
        var what = opener.getAttribute('data-ls-open');
        e.preventDefault();
        if (what === 'palette') { openPalette(''); }
        else if (what === 'shortcuts') { openLayer($('#lsShortcuts')); }
        else if (what === 'create') { openLayer($('#lsCreateSheet')); }
        else if (what === 'menu') { var t = $('#mobile-collapse'); if (t) { t.click(); } }
    });

    d.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && openLayerEl) { e.preventDefault(); closeLayer(); return; }
        if (e.key === 'Tab' && openLayerEl) {
            var f = focusables(openLayerEl);
            if (!f.length) { return; }
            var first = f[0], last = f[f.length - 1];
            if (e.shiftKey && d.activeElement === first) { e.preventDefault(); last.focus(); }
            else if (!e.shiftKey && d.activeElement === last) { e.preventDefault(); first.focus(); }
        }
    });

    /* ------------------------------------------------------------------ */
    /*  Search palette                                                     */
    /* ------------------------------------------------------------------ */
    var palette = $('#lsPalette');
    var pInput = $('#lsPaletteInput');
    var pBody = $('#lsPaletteBody');
    var pItems = [];
    var pActive = -1;
    var pAbort = null;
    var pSeq = 0;

    function recents() { return storeJSON('ls.recent') || []; }
    function favourites() { return storeJSON('ls.fav') || []; }

    function pageMatches(q) {
        var terms = q.toLowerCase().split(/\s+/).filter(Boolean);
        var out = [];
        (DATA.index || []).forEach(function (row) {
            var hay = (row.label + ' ' + row.group).toLowerCase();
            var ok = terms.every(function (t) { return hay.indexOf(t) > -1; });
            if (!ok) { return; }
            var score = row.label.toLowerCase().indexOf(terms[0]) === 0 ? 0 : 1;
            out.push({ row: row, score: score });
        });
        out.sort(function (a, b) { return a.score - b.score || a.row.label.localeCompare(b.row.label); });
        return out.slice(0, 8).map(function (o) { return o.row; });
    }

    function rowHtml(item, idx) {
        return '<a class="ls-result" role="option" id="lsr' + idx + '" href="' + esc(item.url || '#') + '" data-idx="' + idx + '">' +
            '<span class="ls-result__icon">' + icon(item.icon || 'arrow-right') + '</span>' +
            '<span class="ls-result__text"><strong>' + esc(item.title) + '</strong>' +
            (item.sub ? '<small>' + esc(item.sub) + '</small>' : '') + '</span>' +
            (item.badge ? '<span class="ls-result__badge ls-result__badge--' + esc(String(item.badge).toLowerCase()) + '">' + esc(item.badge) + '</span>' : '') +
            '<i class="feather-corner-down-left ls-result__enter" aria-hidden="true"></i></a>';
    }

    function renderPalette(sections, note) {
        var html = '';
        pItems = [];
        sections.forEach(function (s) {
            if (!s.items.length) { return; }
            html += '<div class="ls-result-group" role="presentation">' + esc(s.title) + '</div>';
            s.items.forEach(function (it) {
                html += rowHtml(it, pItems.length);
                pItems.push(it);
            });
        });
        if (note) { html += '<div class="ls-result-note">' + note + '</div>'; }
        if (!pItems.length && !note) {
            html = '<div class="ls-result-note">Nothing to show yet.</div>';
        }
        pBody.innerHTML = html;
        pActive = pItems.length ? 0 : -1;
        highlight();
    }

    function highlight() {
        $$('.ls-result', pBody).forEach(function (n) {
            var on = Number(n.getAttribute('data-idx')) === pActive;
            n.classList.toggle('is-active', on);
            n.setAttribute('aria-selected', on ? 'true' : 'false');
            if (on) {
                pInput.setAttribute('aria-activedescendant', n.id);
                n.scrollIntoView({ block: 'nearest' });
            }
        });
    }

    function asItem(row) { return { title: row.label, sub: row.group, url: row.url, icon: row.icon }; }

    /* things to do rather than pages to open */
    var ACTIONS = [
        { title: 'Switch dark / light mode', sub: 'Display', icon: 'moon', keys: 'dark light theme night mode', run: function () {
            var b = $$('.dark-light-theme a').filter(function (a) { return a.offsetParent !== null; })[0];
            if (b) { b.click(); }
        } },
        { title: 'Keyboard shortcuts and help', sub: 'Help', icon: 'help-circle', keys: 'help keys shortcuts', run: function () { openLayer($('#lsShortcuts')); } },
        { title: 'Open the website', sub: 'Website', icon: 'globe', keys: 'website public site home', url: DATA.site || '/', external: true },
        { title: 'Log out', sub: 'Account', icon: 'log-out', keys: 'logout sign out exit', run: function () { var f = $('#logout-form'); if (f) { f.submit(); } } }
    ];
    function actionMatches(q) {
        var terms = q.toLowerCase().split(/\s+/).filter(Boolean);
        return ACTIONS.filter(function (a) {
            var hay = (a.title + ' ' + a.keys).toLowerCase();
            return terms.every(function (t) { return hay.indexOf(t) > -1; });
        });
    }
    function activate(item, e) {
        if (!item) { return; }
        if (item.run) {
            if (e) { e.preventDefault(); }
            closeLayer(palette, true);
            item.run();
        } else if (item.external) {
            if (e) { e.preventDefault(); }
            w.open(item.url, '_blank', 'noopener');
        } else if (!e) {
            w.location.href = item.url;
        }
    }

    function idleSections() {
        var sections = [];
        var fav = favourites().map(function (f) { return { title: f.title, sub: 'Pinned', url: f.url, icon: 'star' }; });
        var rec = recents().filter(function (r) { return r.url !== pathKey(); }).slice(0, 5)
            .map(function (r) { return { title: r.title, sub: 'Recently opened', url: r.url, icon: 'clock' }; });
        var wanted = (DATA.keys && DATA.keys.jump) || ['Dashboard', 'Students', 'Admissions', 'Payments', 'ID Cards', 'Contact Messages', 'Admission Enquiries', 'Courses'];
        var seen = {};
        var jump = [];
        wanted.forEach(function (label) {
            (DATA.index || []).some(function (r) {
                if (r.label === label && !seen[label]) { seen[label] = 1; jump.push(asItem(r)); return true; }
                return false;
            });
        });
        var create = (DATA.index || []).filter(function (r) { return r.group === 'Create'; }).slice(0, 5).map(asItem);
        if (fav.length) { sections.push({ title: 'Pinned', items: fav }); }
        if (rec.length) { sections.push({ title: 'Recent', items: rec }); }
        sections.push({ title: 'Go to', items: jump });
        sections.push({ title: 'Create', items: create });
        sections.push({ title: 'Actions', items: ACTIONS });
        return sections;
    }

    var liveSearch = debounce(function (q) {
        if (!ENDPOINTS.search || q.length < 2) { return; }
        var seq = ++pSeq;
        if (pAbort && pAbort.abort) { pAbort.abort(); }
        pAbort = w.AbortController ? new AbortController() : null;
        var url = ENDPOINTS.search + '?q=' + encodeURIComponent(q);
        fetch(url, { credentials: 'same-origin', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, signal: pAbort ? pAbort.signal : undefined })
            .then(function (r) { if (!r.ok) { throw new Error('http ' + r.status); } return r.json(); })
            .then(function (json) {
                if (seq !== pSeq || pInput.value.trim() !== q) { return; }
                var sections = [];
                var pages = pageMatches(q).map(asItem);
                var acts = actionMatches(q);
                if (pages.length) { sections.push({ title: 'Pages', items: pages }); }
                (json.groups || []).forEach(function (g) {
                    sections.push({
                        title: g.group,
                        items: g.items.map(function (it) { return { title: it.title, sub: it.sub, url: it.url, badge: it.badge, icon: g.icon }; })
                    });
                });
                if (acts.length) { sections.push({ title: 'Actions', items: acts }); }
                var found = sections.reduce(function (n, s) { return n + s.items.length; }, 0);
                renderPalette(sections, found ? '' : 'No match for <strong>' + esc(q) + '</strong>. Try a name, email, phone, invoice or admission number.');
            })
            .catch(function (err) {
                if (err && err.name === 'AbortError') { return; }
                if (seq !== pSeq) { return; }
                var pages = pageMatches(q).map(asItem);
                renderPalette([{ title: 'Pages', items: pages }], 'Record search is not available right now. Pages still work.');
            });
    }, 220);

    function onPaletteInput() {
        var q = pInput.value.trim();
        if (!q) { pSeq++; renderPalette(idleSections()); return; }
        var pages = pageMatches(q).map(asItem);
        var acts = actionMatches(q);
        var live = !!ENDPOINTS.search;
        var found = pages.length + acts.length;
        renderPalette((pages.length ? [{ title: 'Pages', items: pages }] : []).concat(acts.length ? [{ title: 'Actions', items: acts }] : []),
            !live ? (found ? '' : 'No page matches <strong>' + esc(q) + '</strong>.')
                : (q.length >= 2 ? '<span class="ls-spinner" aria-hidden="true"></span> Searching records…' : 'Keep typing to search records…'));
        if (live) { liveSearch(q); }
    }

    function openPalette(q) {
        if (!palette) { return; }
        openLayer(palette, '#lsPaletteInput');
        pInput.value = q || '';
        onPaletteInput();
        setTimeout(function () { pInput.focus(); pInput.select(); }, 30);
    }

    if (palette) {
        pInput.addEventListener('input', onPaletteInput);
        pInput.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowDown') { e.preventDefault(); if (pItems.length) { pActive = (pActive + 1) % pItems.length; highlight(); } }
            else if (e.key === 'ArrowUp') { e.preventDefault(); if (pItems.length) { pActive = (pActive - 1 + pItems.length) % pItems.length; highlight(); } }
            else if (e.key === 'Enter') {
                e.preventDefault();
                var it = pItems[pActive];
                if (it) { activate(it); }
            }
        });
        pBody.addEventListener('mousemove', function (e) {
            var r = e.target.closest ? e.target.closest('.ls-result') : null;
            if (r) {
                var i = Number(r.getAttribute('data-idx'));
                if (i !== pActive) { pActive = i; highlight(); }
            }
        });
        pBody.addEventListener('click', function (e) {
            var r = e.target.closest ? e.target.closest('.ls-result') : null;
            if (r) {
                var item = pItems[Number(r.getAttribute('data-idx'))];
                if (item && (item.run || item.external)) { activate(item, e); return; }
            }
            closeLayer(palette, true);
        });
    }

    /* ------------------------------------------------------------------ */
    /*  Global shortcuts                                                   */
    /* ------------------------------------------------------------------ */
    var goPending = false;
    var goTimer = null;
    /* "g" then a letter jumps to a page; each panel names its own (label in the search index) */
    var GO_LABEL = (DATA.keys && DATA.keys.go) || { d: 'Dashboard', s: 'Students', a: 'Admissions', p: 'Payments' };
    var NEW_LABEL = (DATA.keys && DATA.keys.create) || 'Add student';

    function urlFor(label) {
        var found = null;
        (DATA.index || []).forEach(function (r) {
            if (!found && (r.label === label || (label === 'Students' && r.label === 'Students'))) { found = r.url; }
        });
        return found;
    }

    d.addEventListener('keydown', function (e) {
        var key = (e.key || '').toLowerCase();
        if ((e.ctrlKey || e.metaKey) && key === 'k') { e.preventDefault(); openPalette(''); return; }
        if (e.ctrlKey || e.metaKey || e.altKey || isTyping(e.target) || openLayerEl) { return; }
        if (d.body.classList.contains('modal-open')) { return; }

        if (goPending) {
            goPending = false;
            clearTimeout(goTimer);
            if (GO_LABEL[key]) {
                var u = urlFor(GO_LABEL[key]);
                if (u) { e.preventDefault(); w.location.href = u; }
            }
            return;
        }
        if (key === '/') { e.preventDefault(); openPalette(''); }
        else if (key === '?') { e.preventDefault(); openLayer($('#lsShortcuts')); }
        else if (key === 'g') { goPending = true; goTimer = setTimeout(function () { goPending = false; }, 1200); }
        else if (key === 'n') {
            var n = NEW_LABEL ? urlFor(NEW_LABEL) : null;
            if (n) { e.preventDefault(); w.location.href = n; }
        }
    });

    /* ------------------------------------------------------------------ */
    /*  Display settings (row spacing, text size, calm motion)             */
    /* ------------------------------------------------------------------ */
    var DEFAULTS = { density: 'comfortable', fs: 'm', calm: 'off' };
    function currentPref(k) { return d.documentElement.getAttribute('data-ls-' + k) || DEFAULTS[k]; }
    function paintPrefs() {
        $$('[data-ls-pref]').forEach(function (b) {
            var on = currentPref(b.getAttribute('data-ls-pref')) === b.getAttribute('data-value');
            b.classList.toggle('is-on', on);
            b.setAttribute('aria-pressed', on ? 'true' : 'false');
        });
    }
    d.addEventListener('click', function (e) {
        var b = e.target.closest ? e.target.closest('[data-ls-pref]') : null;
        if (!b) { return; }
        var k = b.getAttribute('data-ls-pref'), v = b.getAttribute('data-value');
        d.documentElement.setAttribute('data-ls-' + k, v);
        store('ls.' + k, v);
        paintPrefs();
    });
    paintPrefs();

    /* ------------------------------------------------------------------ */
    /*  Menu: find box, pinned pages, current page in view                 */
    /* ------------------------------------------------------------------ */
    var navbar = $('#lsNavbar');
    var navFilter = $('#lsNavFilter');

    function buildPinned() {
        if (!navbar) { return; }
        $$('.ls-pinned', navbar).forEach(function (n) { n.parentNode.removeChild(n); });
        var fav = favourites();
        if (!fav.length) { return; }
        var first = navbar.firstElementChild;
        var frag = d.createDocumentFragment();
        var cap = make('li', 'nxl-item nxl-caption ls-pinned', '<label>Pinned</label>');
        frag.appendChild(cap);
        fav.slice(0, 8).forEach(function (f) {
            var li = make('li', 'nxl-item ls-pinned' + (f.url === pathKey() ? ' active' : ''));
            var a = make('a', 'nxl-link');
            a.href = f.url;
            a.innerHTML = '<span class="nxl-micon"><i class="feather-star" aria-hidden="true"></i></span><span class="nxl-mtext"></span>';
            $('.nxl-mtext', a).textContent = f.title;
            li.appendChild(a);
            frag.appendChild(li);
        });
        navbar.insertBefore(frag, first);
    }

    function filterNav(q) {
        q = q.trim().toLowerCase();
        var items = $$('#lsNavbar > li');
        var captionHasMatch = null;
        var lastCaption = null;
        items.forEach(function (li) {
            if (li.classList.contains('nxl-caption')) {
                lastCaption = li;
                li.hidden = !!q;
                li.__hits = 0;
                return;
            }
            if (!q) {
                li.hidden = false;
                $$('.nxl-submenu > li', li).forEach(function (c) { c.hidden = false; });
                var sub = $('.nxl-submenu', li);
                if (sub && sub.__lsOpen) { sub.style.display = sub.__lsDisplay || ''; sub.__lsOpen = false; }
                return;
            }
            var label = (li.textContent || '').toLowerCase();
            var childLis = $$('.nxl-submenu > li', li);
            var ownLabel = ($('.nxl-mtext', li) || {}).textContent;
            var ownHit = (ownLabel || '').toLowerCase().indexOf(q) > -1;
            var anyChild = false;
            childLis.forEach(function (c) {
                var hit = ownHit || (c.textContent || '').toLowerCase().indexOf(q) > -1;
                c.hidden = !hit;
                if (hit) { anyChild = true; }
            });
            var show = childLis.length ? anyChild : label.indexOf(q) > -1;
            li.hidden = !show;
            var submenu = $('.nxl-submenu', li);
            if (submenu && show) {
                if (!submenu.__lsOpen) { submenu.__lsDisplay = submenu.style.display; }
                submenu.__lsOpen = true;
                submenu.style.display = 'block';
            }
            if (show && lastCaption) { lastCaption.hidden = false; }
        });
    }
    if (navFilter) { navFilter.addEventListener('input', debounce(function () { filterNav(navFilter.value); }, 80)); }

    buildPinned();

    setTimeout(function () {
        var active = $('#lsNavbar .nxl-submenu .nxl-item.active > a, #lsNavbar > .nxl-item.active > a');
        var scroller = $('.navbar-content');
        if (active && scroller && scroller.scrollTo) {
            var box = scroller.getBoundingClientRect();
            var at = active.getBoundingClientRect();
            /* only when the current page is out of view, and then with some menu above it */
            if (at.bottom > box.bottom - 60) {
                scroller.scrollTo(0, at.top - box.top + scroller.scrollTop - box.height / 3);
            }
        }
    }, 450);

    /* ------------------------------------------------------------------ */
    /*  Recently opened pages                                              */
    /* ------------------------------------------------------------------ */
    (function trackRecent() {
        if (!PAGE.title || PAGE.kind === 'dashboard') { return; }
        var list = recents().filter(function (r) { return r.url !== pathKey(); });
        list.unshift({ title: PAGE.title, url: pathKey() });
        storeJSON('ls.recent', list.slice(0, 8));
    })();

    /* ------------------------------------------------------------------ */
    /*  Page bar: title, breadcrumb, related buttons, pin star             */
    /* ------------------------------------------------------------------ */
    function normLabel(s) { return String(s || '').replace(/\s+/g, ' ').trim().toLowerCase(); }

    function crumbsHtml() {
        return PAGE.crumbs.map(function (c, i) {
            var last = i === PAGE.crumbs.length - 1;
            return '<li class="breadcrumb-item' + (last ? ' active' : '') + '"' + (last ? ' aria-current="page"' : '') + '>' +
                (c.url && !last ? '<a href="' + esc(c.url) + '">' + esc(c.label) + '</a>' : esc(c.label)) + '</li>';
        }).join('');
    }

    function pinStar() {
        var star = make('button', 'ls-star', icon('star'));
        star.type = 'button';
        var paint = function () {
            var on = favourites().some(function (f) { return f.url === pathKey(); });
            star.classList.toggle('is-on', on);
            star.setAttribute('aria-pressed', on ? 'true' : 'false');
            star.setAttribute('aria-label', on ? 'Unpin this page from the menu' : 'Pin this page to the menu');
            star.title = on ? 'Pinned. Click to unpin' : 'Pin this page to the menu';
        };
        star.addEventListener('click', function () {
            var fav = favourites();
            var idx = -1;
            fav.forEach(function (f, i) { if (f.url === pathKey()) { idx = i; } });
            if (idx > -1) { fav.splice(idx, 1); toast('Removed from pinned pages'); }
            else { fav.unshift({ title: PAGE.title, url: pathKey() }); toast('Pinned to the menu'); }
            storeJSON('ls.fav', fav.slice(0, 8));
            paint();
            buildPinned();
        });
        paint();
        return star;
    }

    /* buttons the page does not already show: the page's own first, ours added */
    function actionsGroup(scope) {
        var existing = $$('a[href], button', scope).map(function (n) {
            return { href: n.getAttribute('href') || '', label: normLabel(n.textContent) };
        });
        var group = make('div', 'ls-actions');
        (PAGE.actions || []).forEach(function (a) {
            var dupe = existing.some(function (x) {
                return (x.href && a.url && x.href.replace(/#.*$/, '') === a.url) || (x.label && x.label === normLabel(a.label));
            });
            if (dupe) { return; }
            var link = make('a', 'btn btn-sm ' + (a.primary ? 'btn-primary' : (a.back ? 'ls-btn-back' : 'btn-light-brand')),
                icon(a.icon || 'arrow-right') + '<span>' + esc(a.label) + '</span>');
            link.href = a.url;
            group.appendChild(link);
        });
        return group;
    }

    function pageBar() {
        var content = $('.nxl-container .nxl-content');
        if (!content) { return; }
        var header = $('.page-header', content);
        var kind = PAGE.kind;
        if (kind === 'custom') { return; }
        if (kind === 'dashboard') {
            /* the dashboard keeps its own layout; only the word "Student" / "Admin" becomes the page name */
            var dh = header && ($('.page-header-title h5', header) || $('h5', header));
            var dcrumbs = header && $('.breadcrumb', header);
            if (dh && /^(admin|student)$/i.test(normLabel(dh.textContent)) && PAGE.title) { dh.textContent = PAGE.title; }
            if (dcrumbs && DATA.route && /^student\./.test(DATA.route)) { dcrumbs.innerHTML = '<li class="breadcrumb-item active" aria-current="page">Overview</li>'; }
            return;
        }
        if (!header) { appBar(content); return; }

        /* real title instead of the word "Admin" */
        var h = $('.page-header-title h5', header) || $('h5', header);
        if (h && PAGE.title) {
            var cur = normLabel(h.textContent);
            if (!cur || cur === 'admin' || cur === 'student') { h.textContent = PAGE.title; }
            h.setAttribute('role', 'heading');
            h.setAttribute('aria-level', '1');
        }

        /* breadcrumb with links */
        var crumbs = $('.breadcrumb', header);
        if (crumbs && PAGE.crumbs && PAGE.crumbs.length) {
            crumbs.classList.add('ls-crumbs');
            crumbs.innerHTML = crumbsHtml();
        }

        /* pin star next to the title */
        var titleWrap = $('.page-header-title', header);
        if (titleWrap && PAGE.title) { titleWrap.appendChild(pinStar()); }

        /* buttons */
        if (PAGE.actions && PAGE.actions.length) {
            var right = $('.page-header-right', header);
            if (!right) {
                right = make('div', 'page-header-right ms-auto');
                header.appendChild(right);
            }
            var group = actionsGroup(right);
            if (group.children.length) {
                var wrap = $('.page-header-right-items', right) || right;
                wrap.insertBefore(group, wrap.firstChild);
            }
        }

        /* related records of the same student / message */
        if (PAGE.related && PAGE.related.length) {
            content.insertBefore(relatedBar(PAGE.related, PAGE.summary), header.nextSibling);
        }
    }

    /* app-style pages with no toolbar at all (a student's My Courses): put the title bar at the top of the page body */
    function blockBar(content) {
        var body = $('.content-area-body', content);
        if (!body) { return; }
        var bar = make('div', 'ls-appbar ls-appbar--top');
        var row = make('div', 'ls-appbar__row');
        var h = make('h1', 'ls-appbar__title');
        h.textContent = PAGE.title;
        row.appendChild(h);
        row.appendChild(pinStar());
        bar.appendChild(row);
        if (PAGE.crumbs && PAGE.crumbs.length) { bar.appendChild(make('ul', 'breadcrumb ls-crumbs', crumbsHtml())); }
        var group = actionsGroup(body);
        if (group.children.length) { bar.appendChild(group); }
        body.insertBefore(bar, body.firstChild);
        var next = bar.nextSibling;
        if (PAGE.related && PAGE.related.length) { body.insertBefore(relatedBar(PAGE.related, PAGE.summary), next); }
        /* the page's own heading repeats the title */
        $$('h5, h4, h3', body).slice(0, 3).forEach(function (n) {
            if (!bar.contains(n) && normLabel(n.textContent) === normLabel(PAGE.title)) { n.hidden = true; }
        });
    }

    /* pages laid out as an app (courses, notes): they have a slim toolbar and no title */
    function appBar(content) {
        var head = $('.content-area-header', content);
        if (!head && PAGE.title) { blockBar(content); return; }
        if (!head || !PAGE.title) { return; }
        var left = make('div', 'ls-appbar');
        var titleRow = make('div', 'ls-appbar__row');
        var h = make('h1', 'ls-appbar__title');
        h.textContent = PAGE.title;
        titleRow.appendChild(h);
        titleRow.appendChild(pinStar());
        left.appendChild(titleRow);
        if (PAGE.crumbs && PAGE.crumbs.length) {
            left.appendChild(make('ul', 'breadcrumb ls-crumbs', crumbsHtml()));
        }
        head.classList.add('ls-has-appbar');
        head.insertBefore(left, head.firstChild);
        /* the toolbar's own heading repeats the title */
        $$('h1, h2, h3, h4, h5, h6', head).forEach(function (n) {
            if (!left.contains(n) && normLabel(n.textContent) === normLabel(PAGE.title)) { n.hidden = true; }
        });

        if (PAGE.actions && PAGE.actions.length) {
            var right = $('.page-header-right', head);
            if (!right) {
                right = make('div', 'page-header-right ms-auto');
                head.appendChild(right);
            }
            var group = actionsGroup(head);
            if (group.children.length) { right.insertBefore(group, right.firstChild); }
        }
    }

    function relatedBar(items, summary) {
        var bar = make('nav', 'ls-related');
        bar.setAttribute('aria-label', 'Related records');
        if (summary) { bar.classList.add('has-summary'); }
        var main = items.filter(function (i) { return !i.contact && !i.confirm; });
        var side = items.filter(function (i) { return i.contact || i.confirm; });
        var html = '';
        if (summary) {
            html += '<div class="ls-who"><span class="ls-who__avatar" aria-hidden="true">' + esc((summary.name || '?').charAt(0).toUpperCase()) + '</span>' +
                '<div class="ls-who__text"><strong>' + esc(summary.name || '') + '</strong>' +
                '<small>' + esc([summary.admno, summary.username].filter(Boolean).join(' · ')) + '</small></div>' +
                (summary.status ? '<span class="ls-pill ls-pill--' + esc(summary.status_tone || 'warn') + '">' + esc(summary.status) + '</span>' : '') +
                (summary.fee ? '<div class="ls-who__fee" title="Invoice"><div class="ls-meter__bar"><span style="width:' + Number(summary.fee.percent || 0) + '%"></span></div>' +
                    '<small>' + esc(summary.fee.label || 'Latest invoice') + ': ' + esc(summary.fee.paid) + ' of ' + esc(summary.fee.total) + (summary.fee.due ? ' · <b>' + esc(summary.fee.due) + ' due</b>' : ' · paid in full') + '</small></div>' : '') +
                '</div>';
        }
        html += '<span class="ls-related__label">' + esc(PAGE.related_label || 'Related') + '</span><div class="ls-related__list">';
        main.forEach(function (i) { html += chip(i); });
        html += '</div>';
        if (side.length) {
            html += '<div class="ls-related__list ls-related__list--contact">';
            side.forEach(function (i) { html += chip(i); });
            html += '</div>';
        }
        bar.innerHTML = html;
        return bar;
    }

    function chip(i) {
        return '<a class="ls-chip' + (i.current ? ' is-current' : '') + '" href="' + esc(i.url) + '"' +
            (i.current ? ' aria-current="page"' : '') +
            (i.external ? ' target="_blank" rel="noopener"' : '') +
            (i.confirm ? ' data-ls-confirm="' + esc(i.confirm) + '"' : '') + '>' +
            icon(i.icon) + '<span>' + esc(i.label) + '</span></a>';
    }

    d.addEventListener('click', function (e) {
        var a = e.target.closest ? e.target.closest('[data-ls-confirm]') : null;
        if (!a) { return; }
        if (a.__lsOK) { a.__lsOK = false; return; }
        e.preventDefault();
        ask(a.getAttribute('data-ls-confirm')).then(function (ok) {
            if (ok) { a.__lsOK = true; a.click(); }
        });
    });

    pageBar();

    /* ------------------------------------------------------------------ */
    /*  List tools                                                         */
    /* ------------------------------------------------------------------ */
    var NUM = /^[\s₹$€£]*-?\d[\d,]*(\.\d+)?\s*%?$/;
    var ISO = /^(\d{4})-(\d{2})-(\d{2})(?:[,\sT]+(\d{1,2}):(\d{2})\s*([AP]M)?)?/i;
    var MONTHS = /\b(jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)[a-z]*\b/i;

    function cellText(cell) { return (cell.textContent || '').replace(/\s+/g, ' ').trim(); }

    function sortKey(text) {
        var t = text.trim();
        if (!t) { return { t: 0, v: '' }; }
        var iso = t.match(ISO);
        if (iso) {
            var h = Number(iso[4] || 0);
            if (iso[6]) { h = (h % 12) + (/pm/i.test(iso[6]) ? 12 : 0); }
            return { t: 1, v: Date.UTC(+iso[1], +iso[2] - 1, +iso[3], h, +(iso[5] || 0)) };
        }
        if (NUM.test(t)) { return { t: 1, v: parseFloat(t.replace(/[^\d.\-]/g, '')) }; }
        if (MONTHS.test(t) && /\d/.test(t)) {
            var p = Date.parse(t);
            if (!isNaN(p)) { return { t: 1, v: p }; }
        }
        return { t: 2, v: t.toLowerCase() };
    }

    function compare(a, b) {
        if (a.t !== b.t) { return a.t - b.t; }
        if (typeof a.v === 'number' && typeof b.v === 'number') { return a.v - b.v; }
        return String(a.v).localeCompare(String(b.v), undefined, { numeric: true, sensitivity: 'base' });
    }

    function csvCell(v) {
        v = String(v == null ? '' : v);
        if (/^[=+\-@]/.test(v) && !NUM.test(v)) { v = "'" + v; }
        return /[",\r\n]/.test(v) ? '"' + v.replace(/"/g, '""') + '"' : v;
    }

    function fileStamp() {
        var n = new Date();
        return n.getFullYear() + '-' + ('0' + (n.getMonth() + 1)).slice(-2) + '-' + ('0' + n.getDate()).slice(-2);
    }

    function slug(s) { return String(s || 'list').toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') || 'list'; }

    function setupTable(table, index) {
        if (table.getAttribute('data-ls-tools') === 'off' || table.classList.contains('ls-no-tools')) { return; }
        var basic = table.getAttribute('data-ls-tools') === 'basic';
        if (table.closest('.modal, .ls-no-tools, [data-ls-tools="off"]')) { return; }
        var thead = table.tHead;
        var headRow = thead && thead.rows.length ? thead.rows[thead.rows.length - 1] : null;
        if (!headRow || headRow.cells.length < 3 || !table.tBodies.length) { return; }
        var wrapper = table.closest('.table-responsive');
        if (!wrapper || !wrapper.parentNode) { return; }

        var tbody = table.tBodies[0];
        var heads = $$('th', headRow);
        var labels = heads.map(cellText);
        var isSpecial = function (i) { return /^#?$|^#$|^action|^select$/i.test(labels[i]); };
        var isAction = function (i) { return /^action/i.test(labels[i]); };
        var hasTree = !!$('tr[data-depth]', tbody);
        var rows = function () {
            return $$('tr', tbody).filter(function (tr) {
                return !(tr.cells.length === 1 && tr.cells[0].colSpan > 1);
            });
        };
        var original = rows();
        original.forEach(function (tr, i) { tr.__lsIndex = i; });

        /* status chips from a column of badges */
        var statusCol = -1;
        if (original.length >= 2) {
            for (var c = 0; c < heads.length && statusCol < 0; c++) {
                var withBadge = original.filter(function (tr) { return tr.cells[c] && tr.cells[c].querySelector('.badge'); }).length;
                if (withBadge >= Math.max(2, Math.ceil(original.length * 0.6))) { statusCol = c; }
            }
        }
        var statuses = [];
        if (statusCol > -1) {
            original.forEach(function (tr) {
                var cell = tr.cells[statusCol];
                var b = cell && cell.querySelector('.badge');
                var t = b ? cellText(b) : '';
                if (t && statuses.indexOf(t) < 0) { statuses.push(t); }
            });
            if (statuses.length < 2 || statuses.length > 6) { statuses = []; statusCol = -1; }
        }

        var state = { q: '', status: '', sortCol: -1, sortDir: 0, hidden: {} };
        var colKey = 'ls.cols.' + (DATA.route || 'page') + '.' + index;
        var savedCols = storeJSON(colKey);
        if (savedCols && savedCols.length === heads.length) {
            savedCols.forEach(function (v, i) { if (v) { state.hidden[i] = true; } });
        }

        /* toolbar */
        var bar = make('div', 'ls-tools');
        bar.setAttribute('role', 'toolbar');
        bar.setAttribute('aria-label', 'List tools');
        var hasPager = !!(wrapper.querySelector('.pagination') || (wrapper.parentNode && wrapper.parentNode.querySelector('.pagination')));
        bar.innerHTML =
            '<div class="ls-tools__row">' +
            '<label class="ls-find"' + (basic ? ' hidden' : '') + '><span class="visually-hidden">Filter this page</span>' + icon('filter') +
            '<input type="search" placeholder="Filter this page" autocomplete="off" spellcheck="false">' +
            '<button type="button" class="ls-find__clear" aria-label="Clear filter" hidden>' + icon('x') + '</button></label>' +
            '<div class="ls-tools__chips" role="group" aria-label="Status"></div>' +
            '<div class="ls-tools__right">' +
            '<div class="ls-menu"><button type="button" class="ls-tbtn" data-menu="cols" aria-haspopup="true" aria-expanded="false">' + icon('columns') + '<span>Columns</span></button><div class="ls-menu__pop" role="menu" hidden></div></div>' +
            '<div class="ls-menu"><button type="button" class="ls-tbtn" data-menu="export" aria-haspopup="true" aria-expanded="false">' + icon('download') + '<span>Export</span></button>' +
            '<div class="ls-menu__pop" role="menu" hidden>' +
            '<button type="button" role="menuitem" data-act="csv">' + icon('download') + 'Save as spreadsheet (CSV)</button>' +
            '<button type="button" role="menuitem" data-act="print">' + icon('printer') + 'Print this list</button>' +
            '<button type="button" role="menuitem" data-act="copy">' + icon('copy') + 'Copy to clipboard</button></div></div>' +
            '</div></div>' +
            '<div class="ls-tools__meta"><span class="ls-count" aria-live="polite"></span>' +
            (hasPager && !basic ? '<button type="button" class="ls-linkbtn" data-act="all">' + icon('search') + '<span>Search all records</span></button>' : '') +
            '</div>';
        wrapper.parentNode.insertBefore(bar, wrapper);

        var input = $('input', bar);
        var clear = $('.ls-find__clear', bar);
        var count = $('.ls-count', bar);
        var chipsBox = $('.ls-tools__chips', bar);

        if (statuses.length && !basic) {
            chipsBox.innerHTML = '<button type="button" class="ls-fchip is-on" data-status="">All</button>' +
                statuses.map(function (s) { return '<button type="button" class="ls-fchip" data-status="' + esc(s) + '">' + esc(s) + '</button>'; }).join('');
        } else {
            chipsBox.hidden = true;
        }

        function visibleRows() { return rows().filter(function (tr) { return !tr.classList.contains('ls-row-off'); }); }

        function apply() {
            var terms = state.q.toLowerCase().split(/\s+/).filter(Boolean);
            var shown = 0;
            var all = rows();
            all.forEach(function (tr) {
                var ok = true;
                if (terms.length) {
                    var hay = tr.__lsHay || (tr.__lsHay = (tr.textContent || '').replace(/\s+/g, ' ').toLowerCase());
                    ok = terms.every(function (t) { return hay.indexOf(t) > -1; });
                }
                if (ok && state.status && statusCol > -1) {
                    var cell = tr.cells[statusCol];
                    var b = cell && cell.querySelector('.badge');
                    ok = b && cellText(b) === state.status;
                }
                tr.classList.toggle('ls-row-off', !ok);
                if (ok) { shown++; }
            });
            var none = tbody.querySelector('.ls-none-row');
            if (all.length && shown === 0) {
                if (!none) {
                    none = tbody.insertRow(-1);
                    none.className = 'ls-none-row';
                    var td = none.insertCell(0);
                    td.colSpan = heads.length;
                    td.className = 'rt-full';
                    td.innerHTML = '<div class="ls-none">' + icon('search') + '<strong>No rows match</strong><span>Try fewer words, or use <b>Search all records</b> to look beyond this page.</span></div>';
                }
            } else if (none) {
                none.parentNode.removeChild(none);
            }
            clear.hidden = !state.q;
            var word = hasPager ? 'on this page' : 'in total';
            count.textContent = all.length ? ('Showing ' + shown + ' of ' + all.length + ' ' + word) : '';
        }

        function applyCols() {
            var offList = [];
            heads.forEach(function (th, i) {
                var off = !!state.hidden[i];
                offList.push(off ? 1 : 0);
                th.classList.toggle('ls-col-off', off);
                $$('tr', tbody).forEach(function (tr) {
                    if (tr.cells.length === heads.length && tr.cells[i]) { tr.cells[i].classList.toggle('ls-col-off', off); }
                });
            });
            storeJSON(colKey, offList);
        }

        input.addEventListener('input', debounce(function () { state.q = input.value; apply(); }, 90));
        clear.addEventListener('click', function () { input.value = ''; state.q = ''; apply(); input.focus(); });
        chipsBox.addEventListener('click', function (e) {
            var b = e.target.closest ? e.target.closest('.ls-fchip') : null;
            if (!b) { return; }
            state.status = b.getAttribute('data-status');
            $$('.ls-fchip', chipsBox).forEach(function (n) { n.classList.toggle('is-on', n === b); });
            apply();
        });

        /* sorting */
        if (!hasTree) {
            heads.forEach(function (th, i) {
                if (isSpecial(i)) { return; }
                th.classList.add('ls-sortable');
                th.setAttribute('tabindex', '0');
                th.setAttribute('role', 'columnheader');
                th.setAttribute('aria-sort', 'none');
                var run = function () {
                    state.sortDir = state.sortCol === i ? (state.sortDir === 1 ? -1 : (state.sortDir === -1 ? 0 : 1)) : 1;
                    state.sortCol = state.sortDir === 0 ? -1 : i;
                    heads.forEach(function (h2, j) {
                        h2.classList.remove('is-asc', 'is-desc');
                        if (h2.classList.contains('ls-sortable')) { h2.setAttribute('aria-sort', 'none'); }
                        if (j === state.sortCol) {
                            h2.classList.add(state.sortDir === 1 ? 'is-asc' : 'is-desc');
                            h2.setAttribute('aria-sort', state.sortDir === 1 ? 'ascending' : 'descending');
                        }
                    });
                    var list = rows();
                    var none = tbody.querySelector('.ls-none-row');
                    if (state.sortDir === 0) {
                        list.sort(function (a, b) { return a.__lsIndex - b.__lsIndex; });
                    } else {
                        list.forEach(function (tr) { tr.__lsKey = sortKey(cellText(tr.cells[i] || { textContent: '' })); });
                        list.sort(function (a, b) { return state.sortDir * compare(a.__lsKey, b.__lsKey) || a.__lsIndex - b.__lsIndex; });
                    }
                    list.forEach(function (tr) { tbody.insertBefore(tr, none || null); });
                };
                th.addEventListener('click', run);
                th.addEventListener('keydown', function (e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); run(); } });
            });
        }

        /* menus */
        var colsPop = $('[data-menu="cols"]', bar).nextElementSibling;
        colsPop.innerHTML = heads.map(function (th, i) {
            if (isAction(i)) { return ''; }
            var label = labels[i] || ('Column ' + (i + 1));
            return '<label class="ls-menu__check"><input type="checkbox" data-col="' + i + '"' + (state.hidden[i] ? '' : ' checked') + '><span>' + esc(label) + '</span></label>';
        }).join('') + '<button type="button" class="ls-menu__reset" data-act="cols-reset">Show all columns</button>';
        colsPop.addEventListener('change', function (e) {
            var cb = e.target;
            if (cb && cb.getAttribute && cb.getAttribute('data-col') != null) {
                state.hidden[Number(cb.getAttribute('data-col'))] = !cb.checked;
                applyCols();
            }
        });

        bar.addEventListener('click', function (e) {
            var t = e.target.closest ? e.target.closest('[data-menu], [data-act]') : null;
            if (!t) { return; }
            if (t.hasAttribute('data-menu')) {
                var pop = t.nextElementSibling;
                var open = pop.hidden;
                closeMenus();
                pop.hidden = !open;
                t.setAttribute('aria-expanded', open ? 'true' : 'false');
                return;
            }
            var act = t.getAttribute('data-act');
            if (act === 'cols-reset') {
                state.hidden = {};
                $$('input[data-col]', colsPop).forEach(function (cb) { cb.checked = true; });
                applyCols();
            } else if (act === 'all') {
                closeMenus();
                openPalette(state.q);
            } else if (act === 'csv' || act === 'print' || act === 'copy') {
                closeMenus();
                exportRows(act);
            }
        });

        function exportData() {
            var idx = [];
            heads.forEach(function (th, i) { if (!isAction(i) && !state.hidden[i] && !/^#?$/.test(labels[i])) { idx.push(i); } });
            var head = idx.map(function (i) { return labels[i]; });
            var body = visibleRows().map(function (tr) {
                return idx.map(function (i) { return tr.cells[i] ? cellText(tr.cells[i]) : ''; });
            });
            return { head: head, body: body };
        }

        function exportRows(kind) {
            var data = exportData();
            if (!data.body.length) { toast('There are no rows to export', 'warn'); return; }
            var title = PAGE.title || d.title || 'List';
            if (kind === 'csv') {
                var csv = [data.head].concat(data.body).map(function (r) { return r.map(csvCell).join(','); }).join('\r\n');
                var blob = new Blob(['﻿' + csv], { type: 'text/csv;charset=utf-8' });
                var a = make('a');
                a.href = URL.createObjectURL(blob);
                a.download = slug(title) + '-' + fileStamp() + '.csv';
                d.body.appendChild(a);
                a.click();
                setTimeout(function () { URL.revokeObjectURL(a.href); d.body.removeChild(a); }, 500);
                toast('Saved ' + data.body.length + ' row' + (data.body.length === 1 ? '' : 's') + ' to a spreadsheet file');
            } else if (kind === 'copy') {
                var tsv = [data.head].concat(data.body).map(function (r) { return r.join('\t'); }).join('\n');
                var done = function () { toast('Copied ' + data.body.length + ' row' + (data.body.length === 1 ? '' : 's')); };
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(tsv).then(done, function () { fallbackCopy(tsv); done(); });
                } else { fallbackCopy(tsv); done(); }
            } else {
                printRows(title, data);
            }
        }

        apply();
        applyCols();
        table.classList.add('ls-has-tools');
        table.__lsApply = apply;
    }

    function fallbackCopy(text) {
        var ta = make('textarea');
        ta.value = text;
        ta.style.cssText = 'position:fixed;left:-9999px;top:0';
        d.body.appendChild(ta);
        ta.select();
        try { d.execCommand('copy'); } catch (e) { /* nothing more to try */ }
        d.body.removeChild(ta);
    }

    function printRows(title, data) {
        var frame = make('iframe');
        frame.setAttribute('aria-hidden', 'true');
        frame.style.cssText = 'position:fixed;right:0;bottom:0;width:0;height:0;border:0';
        d.body.appendChild(frame);
        var doc = frame.contentWindow.document;
        var rowsHtml = data.body.map(function (r) { return '<tr>' + r.map(function (c) { return '<td>' + esc(c) + '</td>'; }).join('') + '</tr>'; }).join('');
        doc.open();
        doc.write('<!doctype html><html><head><meta charset="utf-8"><title>' + esc(title) + '</title><style>' +
            'body{font:12px/1.45 Arial,Helvetica,sans-serif;color:#1f1c16;margin:24px}' +
            'h1{font:700 20px Georgia,serif;margin:0 0 2px}p{margin:0 0 14px;color:#6b6455}' +
            'table{border-collapse:collapse;width:100%}th,td{border:1px solid #d8cba4;padding:6px 8px;text-align:left;vertical-align:top}' +
            'th{background:#faf3dd}tr:nth-child(even) td{background:#fcfaf2}' +
            '@media print{body{margin:10mm}}</style></head><body>' +
            '<h1>Law Students · ' + esc(title) + '</h1><p>' + esc(new Date().toLocaleString()) + ' · ' + data.body.length + ' row' + (data.body.length === 1 ? '' : 's') + '</p>' +
            '<table><thead><tr>' + data.head.map(function (h) { return '<th>' + esc(h) + '</th>'; }).join('') + '</tr></thead><tbody>' + rowsHtml + '</tbody></table></body></html>');
        doc.close();
        setTimeout(function () {
            try { frame.contentWindow.focus(); frame.contentWindow.print(); } catch (e) { toast('Printing is not available in this browser', 'warn'); }
            setTimeout(function () { if (frame.parentNode) { frame.parentNode.removeChild(frame); } }, 2000);
        }, 200);
    }

    function closeMenus() {
        $$('.ls-menu__pop').forEach(function (p) {
            if (!p.hidden) {
                p.hidden = true;
                var b = p.previousElementSibling;
                if (b) { b.setAttribute('aria-expanded', 'false'); }
            }
        });
    }
    d.addEventListener('click', function (e) { if (!e.target.closest || !e.target.closest('.ls-menu')) { closeMenus(); } });
    d.addEventListener('keydown', function (e) { if (e.key === 'Escape') { closeMenus(); closePop(); } });

    /* long text in a cell is cut to two lines (the full text is on hover and in exports) */
    function clampCells(table) {
        $$('tbody td', table).forEach(function (td) {
            if (td.colSpan > 1 || td.querySelector('.ls-clamp, .badge, form, button, img, input, select, textarea')) { return; }
            var text = (td.textContent || '').replace(/\s+/g, ' ').trim();
            if (text.length < 70) { return; }
            var box = make('div', 'ls-clamp');
            while (td.firstChild) { box.appendChild(td.firstChild); }
            box.title = text;
            td.appendChild(box);
        });
    }

    /* wide tables keep their Actions column in view while the rest scrolls sideways */
    function stickActions(table) {
        var heads = table.tHead && table.tHead.rows.length ? table.tHead.rows[table.tHead.rows.length - 1].cells : null;
        if (!heads || !heads.length || !/^actions?$/i.test(cellText(heads[heads.length - 1]))) { return; }
        table.classList.add('ls-sticky-actions');
        var wrapper = table.closest('.table-responsive');
        var check = function () {
            table.classList.toggle('is-overflowing', !!wrapper && wrapper.scrollWidth > wrapper.clientWidth + 2);
        };
        check();
        w.addEventListener('resize', debounce(check, 120));
        w.addEventListener('load', check);
    }

    /* empty lists: a friendly line and the main "add" button */
    function friendlyEmpty(table) {
        var primary = (PAGE.actions || []).filter(function (a) { return a.primary; })[0];
        $$('tbody tr', table).forEach(function (tr) {
            if (tr.cells.length !== 1 || tr.cells[0].colSpan < 2) { return; }
            var cell = tr.cells[0];
            if (cell.querySelector('.ls-none, .ls-empty') || !/^\s*no\b/i.test(cell.textContent)) { return; }
            var msg = cell.textContent.trim();
            cell.innerHTML = '<div class="ls-empty">' + icon('inbox') + '<strong>' + esc(msg) + '</strong>' +
                (primary ? '<a class="btn btn-sm btn-primary" href="' + esc(primary.url) + '">' + icon('plus') + '<span>' + esc(primary.label) + '</span></a>' : '') + '</div>';
            cell.classList.add('rt-full');
        });
    }

    /* ---------- row "more" menu: the student's other records ---------- */
    var ENTITY = [
        { re: /\/(?:view|edit)-student\/(\d+)/, type: 'student' },
        { re: /\/view-student-activity\/(\d+)/, type: 'student' },
        { re: /\/(?:show|edit)-admission\/(\d+)/, type: 'admission' },
        { re: /\/(?:view|edit)-payment\/(\d+)/, type: 'payment' },
        { re: /\/view-idcard\/(\d+)/, type: 'payment' },
        { re: /\/contact-view\/(\d+)/, type: 'contact' }
    ];
    var relatedCache = {};
    var pop = null;
    var popBtn = null;

    function entityOf(tr) {
        var links = $$('a[href]', tr);
        for (var i = 0; i < links.length; i++) {
            var href = links[i].getAttribute('href') || '';
            for (var j = 0; j < ENTITY.length; j++) {
                var m = href.match(ENTITY[j].re);
                if (m) { return { type: ENTITY[j].type, id: m[1] }; }
            }
        }
        return null;
    }

    function addMoreButtons(table) {
        if (!ENDPOINTS.related) { return; }
        $$('tbody tr', table).forEach(function (tr) {
            if (tr.querySelector('.ls-more')) { return; }
            var actions = tr.cells[tr.cells.length - 1];
            var group = actions && (actions.querySelector('.hstack') || actions);
            var ent = entityOf(tr);
            if (!ent || !group) { return; }
            var b = make('button', 'avatar-text avatar-md ls-more', icon('more-horizontal'));
            b.type = 'button';
            b.title = 'More actions';
            b.setAttribute('aria-label', 'More actions');
            b.setAttribute('aria-haspopup', 'menu');
            b.setAttribute('data-rt-label', 'More');
            b.setAttribute('data-type', ent.type);
            b.setAttribute('data-id', ent.id);
            group.appendChild(b);
        });
    }

    function closePop() {
        if (pop) { pop.hidden = true; pop.classList.remove('is-open'); }
        if (popBtn) { popBtn.setAttribute('aria-expanded', 'false'); popBtn = null; }
        d.body.classList.remove('ls-pop-open');
    }

    function renderPop(items) {
        if (!items.length) { pop.innerHTML = '<div class="ls-pop__empty">No related records found.</div>'; return; }
        pop.innerHTML = '<div class="ls-pop__title">Related records</div>' + items.map(function (i) {
            return '<a role="menuitem" class="ls-pop__item' + (i.current ? ' is-current' : '') + '" href="' + esc(i.url) + '"' +
                (i.external ? ' target="_blank" rel="noopener"' : '') +
                (i.confirm ? ' data-ls-confirm="' + esc(i.confirm) + '"' : '') + '>' + icon(i.icon) + '<span>' + esc(i.label) + '</span></a>';
        }).join('');
    }

    function openPop(btn) {
        if (!pop) {
            pop = make('div', 'ls-pop');
            pop.setAttribute('role', 'menu');
            pop.hidden = true;
            d.body.appendChild(pop);
        }
        if (popBtn === btn) { closePop(); return; }
        closePop();
        popBtn = btn;
        btn.setAttribute('aria-expanded', 'true');
        var key = btn.getAttribute('data-type') + ':' + btn.getAttribute('data-id');
        pop.innerHTML = '<div class="ls-pop__empty"><span class="ls-spinner" aria-hidden="true"></span> Loading…</div>';
        pop.hidden = false;
        d.body.classList.add('ls-pop-open');
        position(btn);
        requestAnimationFrame(function () { pop.classList.add('is-open'); });
        var show = function (items) { if (popBtn === btn) { renderPop(items); position(btn); var f = $('a', pop); if (f && w.innerWidth > 767) { f.focus(); } } };
        if (relatedCache[key]) { show(relatedCache[key]); return; }
        fetch(ENDPOINTS.related + '?type=' + encodeURIComponent(btn.getAttribute('data-type')) + '&id=' + encodeURIComponent(btn.getAttribute('data-id')),
            { credentials: 'same-origin', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (r) { if (!r.ok) { throw new Error('http'); } return r.json(); })
            .then(function (j) { relatedCache[key] = j.items || []; show(relatedCache[key]); })
            .catch(function () { if (popBtn === btn) { pop.innerHTML = '<div class="ls-pop__empty">Could not load. Please try again.</div>'; } });
    }

    function position(btn) {
        if (w.innerWidth <= 767) { pop.style.left = pop.style.top = ''; return; }
        var r = btn.getBoundingClientRect();
        var pw = pop.offsetWidth || 240, ph = pop.offsetHeight || 200;
        var left = Math.min(Math.max(8, r.right - pw), w.innerWidth - pw - 8);
        var top = r.bottom + 6;
        if (top + ph > w.innerHeight - 8) {
            /* not enough room below: open upwards, or sit at the bottom edge if it does not fit above either */
            top = r.top - ph - 6 >= 8 ? r.top - ph - 6 : Math.max(8, w.innerHeight - ph - 8);
        }
        pop.style.left = left + 'px';
        pop.style.top = top + 'px';
    }

    d.addEventListener('click', function (e) {
        var b = e.target.closest ? e.target.closest('.ls-more') : null;
        if (b) { e.preventDefault(); openPop(b); return; }
        if (pop && !pop.hidden && !(e.target.closest && e.target.closest('.ls-pop'))) { closePop(); }
    });
    w.addEventListener('resize', closePop);
    d.addEventListener('scroll', function () { if (pop && !pop.hidden && w.innerWidth > 767) { closePop(); } }, true);

    /* status words get the colour they mean (a "pending" admission was shown in the success green) */
    var TONES = {
        success: /^(approved|paid|completed|complete|active|verified|published|visible|enrolled)$/i,
        warning: /^(pending|partial|part paid|waiting|awaiting|processing|draft|in progress|under review)$/i,
        danger: /^(rejected|failed|cancelled|canceled|unpaid|inactive|overdue|blocked|declined|not approved)$/i
    };
    function tuneBadges() {
        $$('.nxl-container .main-content .badge').forEach(function (b) {
            var text = (b.textContent || '').replace(/\s+/g, ' ').trim();
            if (!text || b.children.length) { return; }
            var tone = null;
            Object.keys(TONES).forEach(function (t) { if (TONES[t].test(text)) { tone = t; } });
            if (!tone) { return; }
            ['success', 'warning', 'danger', 'info', 'primary', 'secondary', 'light', 'dark'].forEach(function (t) {
                b.classList.remove('bg-soft-' + t, 'text-' + t, 'bg-' + t);
            });
            b.classList.add('bg-soft-' + tone, 'text-' + tone, 'ls-status');
        });
    }
    tuneBadges();

    /* tables on this page */
    (function initTables() {
        if (PAGE.kind === 'doc' || PAGE.kind === 'custom') { return; }
        $$('.nxl-container .table-responsive table.table').forEach(function (table, i) {
            friendlyEmpty(table);
            clampCells(table);
            setupTable(table, i);
            addMoreButtons(table);
            stickActions(table);
        });
    })();

    /* ------------------------------------------------------------------ */
    /*  Forms                                                              */
    /* ------------------------------------------------------------------ */
    (function forms() {
        var scope = $('.nxl-container');
        if (!scope || PAGE.kind === 'doc') { return; }

        /* required fields get a star on their label */
        $$('input[required], select[required], textarea[required]', scope).forEach(function (f) {
            if (f.type === 'hidden' || f.closest('.modal')) { return; }
            var label = f.id ? $('label[for="' + f.id.replace(/"/g, '') + '"]', scope) : null;
            if (!label) {
                var prev = f.previousElementSibling;
                if (prev && prev.tagName === 'LABEL') { label = prev; }
            }
            if (!label) {
                var group = f.closest('.mb-3, .form-group, .col-md-6, .col-md-4, .col-lg-6, .col-12');
                label = group ? $('label', group) : null;
            }
            if (label && !label.querySelector('.text-danger')) { label.classList.add('ls-req'); }
        });

        var forms = $$('form[method="POST" i], form[method="post"]', scope).filter(function (f) {
            return f.id !== 'logout-form' && !f.closest('.modal') && $('input:not([type=hidden]):not([type=checkbox]):not([type=radio]):not([type=submit]), textarea, select', f);
        });
        var dirty = false;
        var submitting = false;

        forms.forEach(function (form) {
            form.addEventListener('input', function () { dirty = true; });
            form.addEventListener('change', function () { dirty = true; });
            form.addEventListener('submit', function (e) {
                var btn = e.submitter || $('button[type=submit], input[type=submit]', form);
                setTimeout(function () {
                    if (e.defaultPrevented) { return; }
                    submitting = true;
                    if (btn && btn.classList) {
                        btn.classList.add('is-busy');
                        btn.setAttribute('aria-busy', 'true');
                    }
                    form.classList.add('is-submitting');
                }, 0);
            });
            /* second click while saving does nothing */
            form.addEventListener('click', function (e) {
                var b = e.target.closest ? e.target.closest('.is-busy') : null;
                if (b) { e.preventDefault(); e.stopPropagation(); }
            }, true);
        });

        w.addEventListener('beforeunload', function (e) {
            if (dirty && !submitting) { e.preventDefault(); e.returnValue = ''; }
        });
        w.addEventListener('pageshow', function () {
            submitting = false;
            $$('.is-busy').forEach(function (b) { b.classList.remove('is-busy'); b.removeAttribute('aria-busy'); });
            $$('.is-submitting').forEach(function (f) { f.classList.remove('is-submitting'); });
        });

        /* long forms: a "Go to save" pill while the save button is out of sight */
        var target = null;
        forms.forEach(function (form) {
            var btns = $$('button[type=submit], input[type=submit], button:not([type])', form).filter(function (b) {
                return !b.closest('.modal') && !/delete|remove|logout/i.test(b.className + ' ' + b.textContent) && b.offsetParent !== null;
            });
            if (btns.length && form.scrollHeight > w.innerHeight * 1.4) { target = btns[btns.length - 1]; }
        });
        if (target && 'IntersectionObserver' in w) {
            var pill = make('button', 'ls-jump', icon('arrow-down') + '<span>Go to save</span>');
            pill.type = 'button';
            pill.hidden = true;
            pill.addEventListener('click', function () { target.scrollIntoView({ behavior: 'smooth', block: 'center' }); });
            d.body.appendChild(pill);
            new IntersectionObserver(function (entries) {
                pill.hidden = entries[0].isIntersecting;
            }, { threshold: 0.6 }).observe(target);
        }
    })();

    /* ------------------------------------------------------------------ */
    /*  Messages: success notes fade away by themselves                    */
    /* ------------------------------------------------------------------ */
    $$('.alert.alert-success').forEach(function (a) {
        if (a.closest('.modal')) { return; }
        setTimeout(function () {
            if (!a.parentNode) { return; }
            try {
                if (w.bootstrap && w.bootstrap.Alert) { w.bootstrap.Alert.getOrCreateInstance(a).close(); return; }
            } catch (e) { /* fall through */ }
            a.style.transition = 'opacity .4s';
            a.style.opacity = '0';
            setTimeout(function () { if (a.parentNode) { a.parentNode.removeChild(a); } }, 450);
        }, 8000);
    });

    /* ------------------------------------------------------------------ */
    /*  Confirmations: the page's own "Are you sure?" questions, in a       */
    /*  dialog that reads well on a phone. The question, the button that    */
    /*  asks it and what happens after "yes" are exactly the page's own.    */
    /* ------------------------------------------------------------------ */
    var askBox = null;
    function ask(message) {
        return new Promise(function (resolve) {
            if (!askBox) {
                askBox = make('div', 'ls-dialog ls-confirm');
                askBox.setAttribute('role', 'alertdialog');
                askBox.setAttribute('aria-modal', 'true');
                askBox.setAttribute('aria-labelledby', 'lsAskTitle');
                askBox.setAttribute('aria-describedby', 'lsAskText');
                askBox.hidden = true;
                askBox.innerHTML = '<div class="ls-dialog__backdrop" data-ls-close></div>' +
                    '<div class="ls-dialog__panel ls-confirm__panel"><span class="ls-confirm__icon" aria-hidden="true"></span>' +
                    '<h2 id="lsAskTitle" class="ls-confirm__title"></h2><p id="lsAskText" class="ls-confirm__text"></p>' +
                    '<div class="ls-confirm__actions"><button type="button" class="btn btn-light-brand" data-ls-no>Cancel</button>' +
                    '<button type="button" class="btn" data-ls-yes></button></div></div>';
                d.body.appendChild(askBox);
            }
            var danger = /delete|remove|discard/i.test(message);
            var mail = /send|email|mail/i.test(message);
            $('.ls-confirm__icon', askBox).innerHTML = icon(danger ? 'trash-2' : (mail ? 'send' : 'help-circle'));
            askBox.classList.toggle('is-danger', danger);
            $('.ls-confirm__title', askBox).textContent = danger ? 'Delete this?' : (mail ? 'Send now?' : 'Please confirm');
            $('.ls-confirm__text', askBox).textContent = message;
            var yes = $('[data-ls-yes]', askBox);
            yes.className = 'btn ' + (danger ? 'btn-danger' : 'btn-primary');
            yes.textContent = danger ? 'Yes, delete' : (mail ? 'Yes, send' : 'Yes, continue');
            var done = false;
            var finish = function (ok) {
                if (done) { return; }
                done = true;
                askBox.__onClose = null;
                if (ok) { closeLayer(askBox, true); } else { closeLayer(askBox); }
                resolve(ok);
            };
            askBox.__onClose = function () { if (!done) { done = true; resolve(false); } };
            $('[data-ls-no]', askBox).onclick = function () { finish(false); };
            yes.onclick = function () { finish(true); };
            openLayer(askBox, '[data-ls-no]');
        });
    }
    w.LSPanel.confirm = ask;

    var ASK_RE = /^\s*return\s+confirm\(\s*(['"])([\s\S]*?)\1\s*\)\s*;?\s*$/;

    /* Takes the page's "return confirm('…')" off the element and remembers the question, so
       the same question is asked once, in the dialog. Anything else in the handler is left alone. */
    function takeQuestion(el, attr) {
        var kept = el.getAttribute('data-ls-ask');
        if (kept !== null) { return kept; }
        var code = el.getAttribute(attr);
        var m = code && ASK_RE.exec(code);
        if (!m) { return null; }
        el.removeAttribute(attr);
        el.setAttribute('data-ls-ask', m[2]);
        return m[2];
    }

    /* buttons and links that ask before they act */
    d.addEventListener('click', function (e) {
        var el = e.target.closest ? e.target.closest('[onclick], [data-ls-ask]') : null;
        if (!el) { return; }
        if (el.__lsOK) { el.__lsOK = false; return; }
        var msg = takeQuestion(el, 'onclick');
        if (msg === null) { return; }
        e.preventDefault();
        e.stopPropagation();
        ask(msg).then(function (ok) {
            if (!ok) { return; }
            el.__lsOK = true;
            el.click();
        });
    }, true);

    /* forms that ask before they send */
    d.addEventListener('submit', function (e) {
        var form = e.target;
        if (!form || !form.getAttribute) { return; }
        if (form.__lsOK) { form.__lsOK = false; return; }
        var msg = takeQuestion(form, 'onsubmit');
        if (msg === null) { return; }
        e.preventDefault();
        e.stopPropagation();
        var submitter = e.submitter || null;
        ask(msg).then(function (ok) {
            if (!ok) { return; }
            form.__lsOK = true;
            if (form.requestSubmit) { form.requestSubmit(submitter || undefined); } else { form.submit(); }
        });
    }, true);

    /* ------------------------------------------------------------------ */
    /*  "#find=word" in the address fills the page's own search box        */
    /* ------------------------------------------------------------------ */
    (function deepFind() {
        var m = /[#&]find=([^&]+)/.exec(w.location.hash || '');
        if (!m) { return; }
        var q;
        try { q = decodeURIComponent(m[1]); } catch (e) { return; }
        var box = $('#notesSearch') || $('.content-area-header input[type="search"]') || $('.ls-find input');
        if (!box) { return; }
        setTimeout(function () {
            box.value = q;
            ['input', 'keyup', 'change'].forEach(function (n) { box.dispatchEvent(new Event(n, { bubbles: true })); });
        }, 500);
    })();

    /* ------------------------------------------------------------------ */
    /*  Page furniture: skip target, footer, back to top                   */
    /* ------------------------------------------------------------------ */
    (function furniture() {
        var main = $('.nxl-container');
        if (!main) { return; }
        if (!main.id) { main.id = 'lsMain'; }
        main.setAttribute('tabindex', '-1');

        if (!$('.ls-footer', main) && PAGE.kind !== 'doc') {
            var f = make('footer', 'ls-footer',
                '<span>© ' + new Date().getFullYear() + ' Law Students · ' + esc(DATA.console || 'Admin Console') + '</span>' +
                '<span class="ls-footer__links"><a href="' + esc(DATA.site || '/') + '" target="_blank" rel="noopener">View website</a>' +
                '<button type="button" data-ls-open="shortcuts">Shortcuts &amp; help</button></span>');
            main.appendChild(f);
        }

        var top = make('button', 'ls-top', icon('chevron-up'));
        top.type = 'button';
        top.hidden = true;
        top.setAttribute('aria-label', 'Back to top');
        top.addEventListener('click', function () { w.scrollTo({ top: 0, behavior: 'smooth' }); });
        d.body.appendChild(top);
        w.addEventListener('scroll', debounce(function () { top.hidden = (w.pageYOffset || d.documentElement.scrollTop) < 700; }, 60), { passive: true });
    })();

})(window, document);
