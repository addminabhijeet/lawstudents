/* Senior-friendly layer, loaded (deferred) on every frontend page after inner.js.
   1. PDF finder on every [data-filter] list: one-tap category buttons, a live
      result count with a "Show everything" reset, a big Clear button, matching
      words highlighted, and a tap on a title opens its PDF.
   2. Travelling gold spotlight on PDF rows and course cards, like the home
      page's course grid — but nothing moves under the pointer, and it pauses
      while the visitor hovers, touches, types or has asked for reduced motion.
   3. Real footer social icons on every page; 4. e-mails wrap after the "@".
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

  /* ---------- 3. footer social icons ----------
     home.js swaps the footer's text glyphs for real icons on the home page only,
     and looks for "Twitter" where the link is titled "X". Every other page showed
     a blurred letter "f", an "o" for Instagram and a "⊘" for WhatsApp. Same icons
     here, for any link that still has none. */
  var SOCIAL = {
    Facebook:'<path d="M13.5 21v-8h2.7l.4-3.1h-3.1V7.9c0-.9.25-1.5 1.55-1.5h1.65V3.62c-.29-.04-1.27-.12-2.42-.12-2.4 0-4.04 1.46-4.04 4.15V9.9H7.5V13h2.74v8z"/>',
    X:'<path d="M17.53 3h2.9l-6.33 7.23L21.5 21h-5.6l-4.38-5.73L6.5 21H3.6l6.77-7.73L3 3h5.74l3.96 5.24zm-1.02 16.2h1.6L7.56 4.7H5.83z"/>',
    Instagram:'<g fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><circle cx="12" cy="12" r="4.1"/></g><circle cx="17.1" cy="6.9" r="1.25"/>',
    LinkedIn:'<path d="M6.94 5.01a1.94 1.94 0 1 1-3.88 0 1.94 1.94 0 0 1 3.88 0M3.3 21h3.4V8.5H3.3zM9.2 8.5h3.26v1.72h.05c.45-.86 1.56-1.77 3.22-1.77 3.44 0 4.08 2.26 4.08 5.21V21h-3.4v-5.65c0-1.35-.03-3.09-1.88-3.09-1.89 0-2.17 1.47-2.17 2.99V21H9.2z"/>',
    YouTube:'<path d="M21.6 7.2s-.2-1.4-.8-2c-.76-.8-1.6-.8-2-.85C16 4.2 12 4.2 12 4.2h-.01s-4 0-6.79.15c-.4.05-1.24.05-2 .85-.6.6-.8 2-.8 2S2.2 8.85 2.2 10.5v1.55c0 1.65.2 3.3.2 3.3s.2 1.4.8 2c.76.8 1.76.77 2.2.86 1.6.15 6.8.2 6.8.2s4 0 6.8-.16c.4-.05 1.24-.05 2-.85.6-.6.8-2 .8-2s.2-1.65.2-3.3V10.5c0-1.65-.2-3.3-.2-3.3M9.95 14.35V8.6l5.15 2.89z"/>',
    WhatsApp:'<path d="M17.47 14.38c-.3-.15-1.75-.86-2.02-.96-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.64.07-.3-.15-1.25-.46-2.38-1.47-.88-.78-1.47-1.75-1.64-2.05-.17-.3-.02-.46.13-.6.14-.14.3-.35.45-.52.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.67-1.6-.92-2.19-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.08-.79.38-.27.3-1.04 1.01-1.04 2.47s1.06 2.86 1.21 3.06c.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.69.63.71.22 1.36.19 1.87.12.57-.09 1.75-.72 2-1.41.25-.69.25-1.28.17-1.41-.07-.13-.27-.2-.57-.35M12.05 21.8a9.8 9.8 0 0 1-5-1.37l-.36-.21-3.71.97.99-3.62-.24-.38a9.82 9.82 0 0 1-1.5-5.22c0-5.42 4.42-9.83 9.83-9.83a9.77 9.77 0 0 1 6.95 2.88 9.74 9.74 0 0 1 2.88 6.96c0 5.41-4.41 9.82-9.83 9.82m8.36-18.19A11.72 11.72 0 0 0 12.05 0C5.6 0 .35 5.25.35 11.7c0 2.06.54 4.07 1.56 5.85L.25 24l6.6-1.73a11.68 11.68 0 0 0 5.19 1.24c6.45 0 11.7-5.25 11.7-11.7 0-3.13-1.22-6.07-3.43-8.28"/>'
  };
  SOCIAL.Twitter = SOCIAL.X;
  function initSocial(){
    $$('.social-row a').forEach(function(a){
      var key = a.getAttribute('title');
      if($('svg, .site-icon', a) || !SOCIAL[key]) return;
      a.setAttribute('aria-label', key);
      a.innerHTML = '<svg viewBox="0 0 24 24" aria-hidden="true">' + SOCIAL[key] + '</svg>';
    });
  }

  /* ---------- 4. e-mail addresses wrap after the "@" instead of mid-word ---------- */
  function initEmails(){
    $$('.footer-contact-item p, .contact-item p, .contact-item a').forEach(function(box){
      Array.prototype.slice.call(box.childNodes).forEach(function(n){
        if(n.nodeType !== 3 || n.nodeValue.indexOf('@') < 0) return;
        var at = n.nodeValue.indexOf('@') + 1, frag = doc.createDocumentFragment();
        frag.appendChild(doc.createTextNode(n.nodeValue.slice(0, at)));
        frag.appendChild(doc.createElement('wbr'));
        frag.appendChild(doc.createTextNode(n.nodeValue.slice(at)));
        box.replaceChild(frag, n);
      });
    });
  }

  function boot(){
    initSocial();
    initEmails();
    $$('[data-filter]').forEach(initFinder);
    $$('[data-filter="list"] .res-list').forEach(function(l){ spotlight(l, '.list-card', '.res-actions a.primary', 'pdf-nudge'); });
    $$('[data-filter="cards"] .course-grid').forEach(function(g){ spotlight(g, '.course-card', '.course-actions .btn-gold', 'btn-nudge'); });
    $$('.list-grid, .testi-list').forEach(function(g){ spotlight(g, '.list-card', '.list-meta .go', 'pdf-nudge-go'); });   // home lists + Client page PDFs
  }
  /* deferred scripts run before DOMContentLoaded, and inner.js builds its filters on
     that event — so wait for it, and this listener runs after inner.js's own */
  if(doc.readyState === 'complete') boot(); else doc.addEventListener('DOMContentLoaded', boot);
})();
