/* Student panel layer (dashboard-extras.blade.php, student-panel.css).
   Only adds to the page: the theme's scripts and the page markup are untouched. */
(function (w, d) {
  'use strict';
  var html = d.documentElement;

  /* ---------- 1. language: the template's placeholder "zxx" means "no language" ---------- */
  if (!html.lang || html.lang === 'zxx') html.lang = 'en';

  /* ---------- 2. tab titles: every page was just "Law Students" ---------- */
  if (/^\s*Law Students\s*$/.test(d.title)) {
    var active = d.querySelectorAll('.nxl-navbar .nxl-item.active > .nxl-link .nxl-mtext'),
        page = active.length ? active[active.length - 1].textContent.trim() : '';
    if (!page) {
      var crumbs = Array.prototype.map.call(d.querySelectorAll('.page-header .breadcrumb-item'), function (li) { return li.textContent.trim(); })
        .filter(function (t) { return t && !/^(details|view)$/i.test(t); });
      page = crumbs.length ? crumbs[crumbs.length - 1] : '';
    }
    if (page) d.title = page + ' · Law Students';
  }

  /* ---------- 3. menu labels on laptop screens ----------
     The theme folds the menu to bare icons on any window resize between 1024 and
     1600px wide (un-maximising the window, the full-screen button), so students on
     laptops lost the menu's words. From 1200px up it now stays open, unless the
     student folded it with the menu button themselves. */
  var MINI_KEY = 'nexel-classic-dashboard-menu-mini-theme';
  function choseMini() {
    try { return w.localStorage.getItem(MINI_KEY) === 'menu-mini-theme'; } catch (e) { return false; }
  }
  function show(sel, on) {
    if (w.jQuery) w.jQuery(sel)[on ? 'show' : 'hide']();
  }
  function keepLabels() {
    var width = html.clientWidth;
    if (width < 1200 || width > 1600 || choseMini() || !html.classList.contains('minimenu')) return;
    html.classList.remove('minimenu');
    show('.logo-full', true);
    show('.logo-abbr', false);
    show('#menu-mini-button', true);
    show('#menu-expend-button', false);
  }
  w.addEventListener('resize', keepLabels);   // after the theme's own resize handler
  w.addEventListener('load', keepLabels);

  /* ---------- 4. dashboard: overview and the five cards ---------- */
  var main = d.querySelector('.nxl-content .main-content'),
      tpl = d.getElementById('sd-overview'),
      bag = d.getElementById('sd-cards');
  if (!main || !tpl) return;

  main.insertBefore(tpl.content.cloneNode(true), main.firstChild);

  var cards = {};
  try { cards = bag ? JSON.parse(bag.textContent) : {}; } catch (e) { cards = {}; }
  var LINKS = {
    registration: 'Open registration',
    admission: 'Open admission',
    payment: 'Open payment',
    invoice: 'Open invoice',
    idcard: 'Open ID card'
  };
  Object.keys(LINKS).forEach(function (key) {
    var info = cards[key],
        link = main.querySelector('a.stretched-link[aria-label="' + LINKS[key] + '"]');
    if (!info || !link) return;
    var card = link.closest('.card'), box = link.parentNode,
        label = box.querySelector('h3'), value = box.querySelector('.fs-4');
    if (!card || !label) return;

    card.classList.add('sd-card', 'sd-state-' + info.state);
    if (key === 'invoice') label.textContent = 'Invoices';   // the value is now how many

    var detail = d.createElement('p');
    detail.className = 'sd-card-detail';
    detail.textContent = info.detail;
    label.insertAdjacentElement('afterend', detail);

    /* one clear name for the whole-card link, e.g. "Admission: Under review. Admission No …" */
    link.setAttribute('aria-label', label.textContent.trim() + ': ' + (value ? value.textContent.trim() : '') + '. ' + info.detail);
  });
})(window, document);
