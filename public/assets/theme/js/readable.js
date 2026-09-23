/* Senior-friendly layer, loaded (deferred) on every frontend page after inner.js.
   1. PDF finder on every [data-filter] list: one-tap category buttons, a live
      result count with a "Show everything" reset, a big Clear button, matching
      words highlighted, and a tap on a title opens its PDF.
   2. Travelling gold spotlight on PDF rows and course cards, like the home
      page's course grid — but nothing moves under the pointer, and it pauses
      while the visitor hovers, touches, types or has asked for reduced motion.
   inner.js still owns filtering; this file only reads the result and drives the
   same dropdown options, so the existing logic is untouched. */
(function(){
  'use strict';
  var doc = document;
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  function $(s, c){ return (c || doc).querySelector(s); }
  function $$(s, c){ return Array.prototype.slice.call((c || doc).querySelectorAll(s)); }
  function el(tag, cls, text){ var n = doc.createElement(tag); if(cls) n.className = cls; if(text) n.textContent = text; return n; }
  function words(q){ return q ? q.split(/\s+/).filter(Boolean) : []; }
  function matches(hay, q){ hay = hay || ''; return words(q).every(function(w){ return hay.indexOf(w) > -1; }); }

  /* ---------- 1. PDF finder ---------- */
  var NOUNS = {
    acts: ['act', 'acts'], rules: ['rule', 'rules'], notes: ['note', 'notes'], library: ['note', 'notes'],
    exams: ['exam notice', 'exam notices'], courses: ['course', 'courses']
  };

  function initFinder(box){
    var mode = box.getAttribute('data-filter');
    var bar = $('.filter-bar', box), menu = $('.dd-menu', box), input = $('input[type="search"]', box);
    if(!bar || !menu) return;
    var section = box.closest('section');
    var noun = NOUNS[section && section.id] || ['result', 'results'];
    var opts = $$('li[data-value]', menu);
    var items = $$(mode === 'list' ? '.list-card' : '.course-card', box);
    var titleSel = mode === 'list' ? '.list-body h4' : '.course-body h3';
    var plain = new Map();

    items.forEach(function(it, i){ it.style.setProperty('--i', i % 8); });

    /* categories with nothing in them yet: fold them to one line and move them after
       the ones that hold PDFs, so nobody scrolls past empty boxes to reach a document */
    if(mode === 'list'){
      var list = $('.res-list', box);
      $$('.res-cat', box).forEach(function(c){
        if($('.list-card', c) || !list) return;
        var head = $('.res-cat-head', c), body = $('.res-cat-body', c);
        c.classList.add('res-cat-empty');
        if(head && body){ head.setAttribute('aria-expanded', 'false'); body.hidden = true; }
        list.appendChild(c);
      });
    }

    function countFor(value){
      if(value === 'all') return items.length;
      if(mode === 'list') return $$('.res-cat[data-cat="' + value + '"] .list-card', box).length;
      return items.filter(function(c){ return c.getAttribute('data-cat') === value; }).length;
    }
    function current(){
      var li = $('li[aria-selected="true"]', menu);
      return li ? li.getAttribute('data-value') : 'all';
    }
    function pick(value){
      var li = opts.filter(function(o){ return o.getAttribute('data-value') === value; })[0];
      if(li) li.click();                     // runs inner.js's own select + filter
    }

    /* one-tap category buttons: dropdowns are fiddly, big buttons are not */
    var chips = el('div', 'cat-chips');
    chips.setAttribute('role', 'group');
    chips.setAttribute('aria-label', 'Choose a category');
    opts.forEach(function(li){
      var value = li.getAttribute('data-value'), n = countFor(value);
      if(value !== 'all' && n === 0) return;   // an empty category is a dead end
      var b = el('button', 'cat-chip');
      b.type = 'button';
      b.setAttribute('data-value', value);
      b.appendChild(doc.createTextNode(value === 'all' ? 'All' : li.textContent.trim()));
      b.appendChild(el('span', 'n', String(n)));
      b.addEventListener('click', function(){ pick(value); b.focus(); });
      chips.appendChild(b);
    });

    /* live result line + reset */
    var status = el('div', 'finder-status');
    var statusText = el('p');
    statusText.setAttribute('role', 'status');
    statusText.setAttribute('aria-live', 'polite');
    var reset = el('button', 'finder-reset', 'Show everything');
    reset.type = 'button';
    reset.hidden = true;
    reset.addEventListener('click', function(){
      if(current() !== 'all') pick('all');
      if(input && input.value){ input.value = ''; input.dispatchEvent(new Event('input', { bubbles: true })); }
      (input || chips).focus();
    });
    status.appendChild(statusText);
    status.appendChild(reset);

    bar.parentNode.insertBefore(chips, bar.nextSibling);
    chips.parentNode.insertBefore(status, chips.nextSibling);

    /* big Clear button inside the search box; Enter jumps to the results */
    if(input){
      var clear = el('button', 'search-clear', 'Clear');
      clear.type = 'button';
      clear.setAttribute('aria-label', 'Clear search');
      clear.hidden = !input.value;
      input.parentNode.appendChild(clear);
      clear.addEventListener('click', function(){
        input.value = '';
        input.dispatchEvent(new Event('input', { bubbles: true }));
        input.focus();
      });
      input.addEventListener('input', function(){ if(clear.hidden !== !input.value) clear.hidden = !input.value; });
      input.addEventListener('keydown', function(e){
        if(e.key !== 'Enter') return;
        e.preventDefault();
        if(window.matchMedia('(hover: none)').matches) input.blur();   // drop the phone keyboard
        status.scrollIntoView({ behavior: reduced ? 'auto' : 'smooth', block: 'start' });
      });
    }

    /* a tap on a title opens its PDF when there is exactly one to open */
    if(mode === 'list'){
      items.forEach(function(it){
        var views = $$('.res-actions a.primary', it), h = $(titleSel, it);
        if(views.length !== 1 || !h) return;
        it.classList.add('lc-openable');
        h.addEventListener('click', function(){ views[0].click(); });
      });
    }

    function highlight(h, ws){
      if(!plain.has(h)) plain.set(h, h.textContent);
      var text = plain.get(h), lower = text.toLowerCase(), ranges = [];
      ws.forEach(function(w){
        for(var i = lower.indexOf(w); i > -1; i = lower.indexOf(w, i + w.length)) ranges.push([i, i + w.length]);
      });
      if(!ranges.length){ if(h.childElementCount) h.textContent = text; return; }
      ranges.sort(function(a, b){ return a[0] - b[0]; });
      var frag = doc.createDocumentFragment(), at = 0;
      ranges.forEach(function(r){
        if(r[1] <= at) return;
        var s = Math.max(r[0], at);
        if(s > at) frag.appendChild(doc.createTextNode(text.slice(at, s)));
        frag.appendChild(el('mark', 'hit', text.slice(s, r[1])));
        at = r[1];
      });
      if(at < text.length) frag.appendChild(doc.createTextNode(text.slice(at)));
      h.textContent = '';
      h.appendChild(frag);
    }

    function update(){
      var q = input ? input.value.trim().toLowerCase() : '', ws = words(q), cat = current();
      var shown = mode === 'list'
        ? items.filter(function(it){ return !it.hidden && !it.closest('.res-cat').hidden; }).length
        : items.filter(function(c){ return (cat === 'all' || c.getAttribute('data-cat') === cat) && matches(c.getAttribute('data-search'), q); }).length;

      $$('.cat-chip', chips).forEach(function(b){ b.setAttribute('aria-pressed', b.getAttribute('data-value') === cat ? 'true' : 'false'); });
      items.forEach(function(it){ var h = $(titleSel, it); if(h) highlight(h, it.hidden ? [] : ws); });

      var catName = '';
      if(cat !== 'all'){ var li = $('li[aria-selected="true"]', menu); catName = li ? li.textContent.trim() : ''; }
      statusText.textContent = '';
      if(!q && cat === 'all'){
        statusText.appendChild(doc.createTextNode('Showing all '));
        statusText.appendChild(el('b', '', String(shown)));
        statusText.appendChild(doc.createTextNode(' ' + (shown === 1 ? noun[0] : noun[1]) + '. Tap a category or type a word to find one quickly.'));
      } else if(shown === 0){
        statusText.appendChild(doc.createTextNode('Nothing found' + (q ? ' for “' + input.value.trim() + '”' : '') + (catName ? ' in ' + catName : '') + '. Try a shorter word, or show everything.'));
      } else {
        statusText.appendChild(el('b', '', String(shown)));
        statusText.appendChild(doc.createTextNode(' ' + (shown === 1 ? noun[0] : noun[1]) + ' found' + (catName ? ' in ' + catName : '') + (q ? ' for “' + input.value.trim() + '”' : '') + '.'));
      }
      var hideReset = !q && cat === 'all';
      if(reset.hidden !== hideReset) reset.hidden = hideReset;   // only write on change: the observer below watches [hidden]
    }

    /* inner.js filters by toggling [hidden] and aria-selected; follow those changes */
    var queued = false;
    function schedule(){ if(queued) return; queued = true; setTimeout(function(){ queued = false; update(); }, 0); }
    new MutationObserver(schedule).observe(box, { attributes: true, subtree: true, attributeFilter: ['hidden', 'aria-selected'] });
    if(input) input.addEventListener('input', schedule);
    update();
  }

  /* ---------- 2. travelling spotlight ---------- */
  function spotlight(container, itemSel, ctaSel, nudgeClass){
    if(reduced || !('IntersectionObserver' in window)) return;
    var items = $$(itemSel, container).filter(function(it){ return $(ctaSel, it); });
    if(!items.length) return;
    var seen = new Set(), cur = null, holdUntil = 0, hovering = false, focused = false;
    var io = new IntersectionObserver(function(es){
      es.forEach(function(e){ if(e.isIntersecting) seen.add(e.target); else seen.delete(e.target); });
    }, { threshold: 0.6 });
    items.forEach(function(it){ io.observe(it); });

    function clear(){
      if(!cur) return;
      cur.classList.remove('pdf-spot');
      var c = $(ctaSel, cur); if(c) c.classList.remove(nudgeClass);
      cur = null;
    }
    function step(){
      if(doc.hidden || hovering || focused || Date.now() < holdUntil) return;
      var list = items.filter(function(it){ return seen.has(it) && it.offsetParent !== null; });
      if(!list.length){ clear(); return; }
      var next = list[(list.indexOf(cur) + 1) % list.length];
      clear();
      cur = next;
      cur.classList.add('pdf-spot');
      var c = $(ctaSel, cur); if(c) c.classList.add(nudgeClass);
    }
    var scope = container.closest('[data-filter]') || container;
    scope.addEventListener('mouseenter', function(){ hovering = true; clear(); });
    scope.addEventListener('mouseleave', function(){ hovering = false; });
    scope.addEventListener('focusin', function(){ focused = true; clear(); });
    scope.addEventListener('focusout', function(){ focused = scope.contains(doc.activeElement); });
    scope.addEventListener('touchstart', function(){ holdUntil = Date.now() + 10000; clear(); }, { passive: true });
    setTimeout(step, 1200);
    setInterval(step, 3200);
  }

  function boot(){
    $$('[data-filter]').forEach(initFinder);
    $$('[data-filter="list"] .res-list').forEach(function(l){ spotlight(l, '.list-card', '.res-actions a.primary', 'pdf-nudge'); });
    $$('[data-filter="cards"] .course-grid').forEach(function(g){ spotlight(g, '.course-card', '.course-actions .btn-gold', 'btn-nudge'); });
    $$('.list-grid').forEach(function(g){ spotlight(g, '.list-card', '.list-meta .go', 'pdf-nudge-go'); });
  }
  /* deferred scripts run before DOMContentLoaded, and inner.js builds its filters on
     that event — so wait for it, and this listener runs after inner.js's own */
  if(doc.readyState === 'complete') boot(); else doc.addEventListener('DOMContentLoaded', boot);
})();
