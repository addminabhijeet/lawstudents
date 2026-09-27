/* Footer layer. Runs straight after the footer markup, before inner.js and
   home.js, and only adds behaviour: no existing script is edited. Styles are
   in footer.css. */
(function(){
  'use strict';
  var footer = document.querySelector('.site-footer');
  if(!footer) return;
  function $$(s, c){ return Array.prototype.slice.call((c || footer).querySelectorAll(s)); }

  /* ---------- 1. one background animation, still headings ----------
     inner.js and home.js each rewrite the footer background and the headings'
     gradient every 50ms as inline !important styles, which no stylesheet can
     outrank (and home.js keeps going when the visitor asked for reduced motion).
     Those writes are ignored on these elements only, so footer.css decides:
     one slow CSS wash that stops for reduced motion, and solid gold headings.
     The kn / how sections those scripts also drive are untouched. */
  var HELD = /^(background|background-image|background-size|background-position|-webkit-background-clip|background-clip|-webkit-text-fill-color|color)$/;
  [footer].concat($$('.footer-tag, .footer-col h4')).forEach(function(el){
    var style = el.style, set = style.setProperty;
    style.setProperty = function(prop, value, priority){
      if(HELD.test(String(prop).toLowerCase())) return;
      return set.call(style, prop, value, priority);
    };
  });
  /* and that wash only runs while the footer is on screen */
  if('IntersectionObserver' in window){
    new IntersectionObserver(function(es){ footer.classList.toggle('fc-live', es[0].isIntersecting); }).observe(footer);
  }

  /* ---------- 2. columns fade in when the footer scrolls into view ----------
     Their CSS entrance ran on page load, while the footer was still off-screen.
     .reveal is picked up by the observer inner.js already runs for the page. */
  $$('.footer-col').forEach(function(col, i){
    col.classList.add('reveal');
    col.setAttribute('data-d', String(i % 3 + 1));
  });

  /* ---------- 3. screen readers ---------- */
  /* the "|" separators are decoration */
  $$('.footer-links .sep').forEach(function(s){ s.setAttribute('aria-hidden', 'true'); });
  /* column titles (h4) and contact labels (h6) skipped heading levels */
  $$('.footer-col h4').forEach(function(h){ h.setAttribute('aria-level', '2'); });
  $$('.footer-contact-item h6').forEach(function(h){ h.setAttribute('aria-level', '3'); });

  /* ---------- 4. contact details ---------- */
  /* the e-mail may break after the "@", never inside a word (readable.js only
     reaches text lying directly in the paragraph, and this one is in a link) */
  $$('.footer-contact-item a[href^="mailto:"]').forEach(function(a){
    Array.prototype.slice.call(a.childNodes).forEach(function(n){
      if(n.nodeType !== 3 || n.nodeValue.indexOf('@') < 0) return;
      var at = n.nodeValue.indexOf('@') + 1, frag = document.createDocumentFragment();
      frag.appendChild(document.createTextNode(n.nodeValue.slice(0, at)));
      frag.appendChild(document.createElement('wbr'));
      frag.appendChild(document.createTextNode(n.nodeValue.slice(at)));
      a.replaceChild(frag, n);
    });
  });
  /* the address opens in a map, as the e-mail and phone open their apps */
  $$('.footer-contact-item p').forEach(function(p){
    var text = p.textContent.replace(/\s+/g, ' ').trim();
    if(p.querySelector('a') || !text) return;
    var a = document.createElement('a');
    a.href = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(text);
    a.target = '_blank';
    a.rel = 'noopener';
    a.title = 'Open in Google Maps';
    a.textContent = text;
    p.textContent = '';
    p.appendChild(a);
  });
  /* the WhatsApp icon opened in the same tab; the six beside it open a new one */
  $$('.social-row a[href*="wa.me"]').forEach(function(a){
    if(a.target) return;
    a.target = '_blank';
    a.rel = 'noopener';
  });

  /* ---------- 5. phones: Quick Links, Programs and Resources fold into rows ----------
     Stacked in full the footer ran ~2500px on a phone. Below 601px each title
     becomes a button (inside its heading) that opens its list; wider screens,
     and pages without JS, show every list as before. */
  var mq = window.matchMedia('(max-width: 600px)');
  var folds = $$('.footer-col').filter(function(col){
    return col.querySelector(':scope > h4') && col.querySelector(':scope > ul');
  }).map(function(col, i){
    var list = col.querySelector(':scope > ul'), btn = document.createElement('button');
    if(!list.id) list.id = 'footer-list-' + (i + 1);
    btn.type = 'button';
    btn.className = 'footer-toggle';
    btn.setAttribute('aria-controls', list.id);
    btn.addEventListener('click', function(){ setOpen(fold, col.classList.contains('is-collapsed')); });
    var fold = { col: col, head: col.querySelector(':scope > h4'), btn: btn };
    return fold;
  });
  function setOpen(fold, open){
    fold.col.classList.toggle('is-collapsed', !open);
    fold.btn.setAttribute('aria-expanded', open ? 'true' : 'false');
  }
  function apply(){
    folds.forEach(function(f){
      if(mq.matches && !f.btn.parentNode){
        while(f.head.firstChild) f.btn.appendChild(f.head.firstChild);
        f.head.appendChild(f.btn);
        f.col.classList.add('fc-fold');
        setOpen(f, false);
      } else if(!mq.matches && f.btn.parentNode){
        while(f.btn.firstChild) f.head.insertBefore(f.btn.firstChild, f.btn);
        f.head.removeChild(f.btn);
        f.col.classList.remove('fc-fold', 'is-collapsed');
      }
    });
  }
  apply();
  if(mq.addEventListener) mq.addEventListener('change', apply);
  else if(mq.addListener) mq.addListener(apply);
})();
