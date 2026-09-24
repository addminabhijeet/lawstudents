/*
 * Responsive helpers for the admin and student panels (styles in assets/css/responsive-fixes.css).
 * Presentation only: no request, form or data handling is changed here.
 */
(function () {
    'use strict';

    // Label each cell of a list table with its column heading, so on phones the rows
    // can be shown as cards ("Name: ...", "Email: ...") instead of scrolling sideways.
    function prepareTables() {
        var tables = document.querySelectorAll('.nxl-container .table-responsive table.table');

        Array.prototype.forEach.call(tables, function (table) {
            if (table.classList.contains('rt-stack') || table.classList.contains('rt-no-stack')) {
                return;
            }

            var head = table.tHead;
            var headRow = head && head.rows.length ? head.rows[head.rows.length - 1] : null;
            if (!headRow || headRow.cells.length < 3) {
                return;
            }

            var labels = [];
            Array.prototype.forEach.call(headRow.cells, function (th) {
                var text = (th.textContent || '').replace(/\s+/g, ' ').trim();
                for (var i = 0; i < (th.colSpan || 1); i++) {
                    labels.push(text);
                }
            });
            var lastColumn = labels.length - 1;

            Array.prototype.forEach.call(table.tBodies, function (tbody) {
                Array.prototype.forEach.call(tbody.rows, function (row) {
                    var column = 0;
                    Array.prototype.forEach.call(row.cells, function (cell) {
                        var span = cell.colSpan || 1;
                        var label = labels[column] || '';

                        if (span > 1) {
                            cell.classList.add('rt-full');
                        } else if (label) {
                            cell.setAttribute('data-label', label);
                            if (column === lastColumn && /action/i.test(label)) {
                                cell.classList.add('rt-actions');
                            }
                        } else {
                            cell.classList.add('rt-nolabel');
                        }

                        column += span;
                    });
                });
            });

            table.classList.add('rt-stack');
        });
    }

    // Phones always get the card layout. Tablets keep the normal table when it fits
    // (cell text wraps) and switch to cards only when it would still scroll sideways.
    var PHONE_MAX = 767.98;
    var TABLET_MAX = 1024;

    function layoutTables() {
        var width = window.innerWidth;
        var tables = document.querySelectorAll('.table-responsive table.rt-stack');

        Array.prototype.forEach.call(tables, function (table) {
            var wrapper = table.closest('.table-responsive');

            if (width > TABLET_MAX) {
                table.classList.remove('rt-cards');
            } else if (width <= PHONE_MAX) {
                table.classList.add('rt-cards');
            } else {
                table.classList.remove('rt-cards');
                if (wrapper && wrapper.scrollWidth > wrapper.clientWidth + 1) {
                    table.classList.add('rt-cards');
                }
            }
        });
    }

    // Long page-number bars: mark far-away page numbers so phones show only the first,
    // last and nearby pages with "…" between them (see .rt-page-hidden in the CSS).
    function condensePagers() {
        var pagers = document.querySelectorAll('.nxl-container ul.pagination');

        Array.prototype.forEach.call(pagers, function (ul) {
            if (ul.getAttribute('data-rt-condensed')) {
                return;
            }

            var numbered = Array.prototype.filter.call(ul.children, function (li) {
                return /^\d+$/.test((li.textContent || '').trim());
            });
            if (numbered.length <= 7) {
                return;
            }

            var active = 0;
            numbered.forEach(function (li, i) {
                if (li.classList.contains('active') || li.querySelector('[aria-current]')) {
                    active = i;
                }
            });

            var keep = [0, numbered.length - 1, active - 1, active, active + 1];
            var lastKept = -1;
            numbered.forEach(function (li, i) {
                if (keep.indexOf(i) === -1) {
                    li.classList.add('rt-page-hidden');
                    return;
                }
                if (lastKept !== -1 && i - lastKept > 1) {
                    var gap = document.createElement('li');
                    gap.className = 'page-item disabled rt-page-gap';
                    gap.setAttribute('aria-hidden', 'true');
                    gap.innerHTML = '<span class="page-link">&hellip;</span>';
                    ul.insertBefore(gap, li);
                }
                lastKept = i;
            });

            ul.setAttribute('data-rt-condensed', '1');
        });
    }

    // Pop-ups placed inside the page area are covered by their own dark backdrop: the theme
    // blurs .nxl-container while a pop-up is open, which traps the pop-up underneath it.
    // Bootstrap expects pop-ups to be direct children of <body>, so move them there.
    function moveModalsToBody() {
        var modals = document.querySelectorAll('.nxl-container .modal');
        Array.prototype.forEach.call(modals, function (modal) {
            document.body.appendChild(modal);
        });
    }

    // Icon-only row buttons: give them a name for screen readers and, in the phone card
    // layout, a visible text label (touch screens never show hover tooltips).
    var ICON_LABELS = [
        ['feather-eye', 'View'],
        ['feather-edit', 'Edit'],
        ['feather-trash-2', 'Delete'],
        ['fa-id-card', 'ID card']
    ];

    function labelIconButtons() {
        var buttons = document.querySelectorAll('.table.rt-stack td.rt-actions .avatar-text');

        Array.prototype.forEach.call(buttons, function (button) {
            if (button.classList.contains('toggle-viewid-btn') || button.textContent.trim() !== '') {
                return;
            }
            for (var i = 0; i < ICON_LABELS.length; i++) {
                if (button.querySelector('.' + ICON_LABELS[i][0])) {
                    button.setAttribute('data-rt-label', ICON_LABELS[i][1]);
                    if (!button.getAttribute('aria-label')) {
                        button.setAttribute('aria-label', ICON_LABELS[i][1]);
                    }
                    return;
                }
            }
        });
    }

    var resizeTimer = null;
    function onResize() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(layoutTables, 100);
    }

    function init() {
        moveModalsToBody();
        prepareTables();
        labelIconButtons();
        layoutTables();
        condensePagers();
        window.addEventListener('resize', onResize);
        window.addEventListener('orientationchange', onResize);
        window.addEventListener('load', layoutTables);
    }

    // Notes pages: on small screens the category list is a slide-in panel; close it
    // once a category has been picked so the filtered notes are visible.
    document.addEventListener('click', function (event) {
        var link = event.target.closest ? event.target.closest('.content-sidebar .note-link') : null;
        if (link && window.innerWidth < 1200) {
            var sidebar = link.closest('.content-sidebar');
            if (sidebar) {
                sidebar.classList.remove('app-sidebar-open');
            }
        }
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
