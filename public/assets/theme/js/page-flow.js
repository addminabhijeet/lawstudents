/* Page flow, every page (layouts/landing). Runs right after the page markup,
   before inner.js and readable.js set the page up. Only adds behaviour; no
   existing script is edited. Styles are in page-flow.css. */
(function(){
  'use strict';
  var d = document, main = d.getElementById('main');
  if(!main) return;

  /* ---------- 1. content first on list and form pages ----------
     The page intro sat between the page title and the list or form people came
     for, 1,200–2,700px down. On these pages the content moves up under the
     title and the intro follows it. Its button (which jumped to the content) is
     hidden by page-flow.css. The Gallery page already does this (gallery.js). */
  var FIRST = ['acts', 'rules', 'copys', 'govtexams', 'legalknowledgelibrary', 'course', 'contact', 'clientele', 'legal-knowledge', 'gallery'];
  var intro = main.querySelector(':scope > .page-intro');
  if(intro){
    var page = (intro.className.match(/\bpage-intro--([a-z-]+)/) || [])[1];
    var btn = intro.querySelector('.page-intro__copy > a.btn[href^="#"]');
    var target = btn && d.getElementById(btn.getAttribute('href').slice(1));
    if(page && FIRST.indexOf(page) > -1 && target && target.parentNode === main){
      if(intro.compareDocumentPosition(target) & Node.DOCUMENT_POSITION_FOLLOWING) main.insertBefore(target, intro);
      intro.classList.add('page-intro--after');
    }
  }

  /* ---------- 2. phones: swipeable card rows ----------
     page-flow.css lays the option cards and steps out in a row that scrolls
     sideways on phones. A row that does scroll gets a one-line hint above it,
     and a row with no link in it can be scrolled from the keyboard. */
  var rows = Array.prototype.slice.call(main.querySelectorAll('.academic-card-grid, .academic-step-grid'));
  function heading(row){
    var s = row.closest('section'), h = s && s.querySelector('h2');
    return h ? h.textContent.replace(/\s+/g, ' ').trim() : 'Cards';
  }
  function update(){
    rows.forEach(function(row){
      var scrolls = row.scrollWidth > row.clientWidth + 4;
      var hint = row.previousElementSibling && row.previousElementSibling.classList.contains('pf-swipe-hint') ? row.previousElementSibling : null;
      if(scrolls && !hint){
        hint = d.createElement('p');
        hint.className = 'pf-swipe-hint';
        hint.setAttribute('aria-hidden', 'true');
        hint.textContent = 'Swipe sideways for more →';
        row.parentNode.insertBefore(hint, row);
      }
      if(hint) hint.hidden = !scrolls;
      if(scrolls && !row.querySelector('a[href], button')){
        row.setAttribute('tabindex', '0');
        row.setAttribute('aria-label', heading(row) + ' (scrolls sideways)');
      } else if(row.getAttribute('tabindex') === '0'){
        row.removeAttribute('tabindex');
        row.removeAttribute('aria-label');
      }
    });
  }
  if(rows.length){
    update();
    var t;
    window.addEventListener('resize', function(){ clearTimeout(t); t = setTimeout(update, 150); });
    window.addEventListener('load', update);
  }
})();
