/* Courses page fixes. Loaded right after the course section, before the photos
   below the fold start loading. Only adds behaviour; no existing script is edited.
   Styles are in course.css. */
(function(){
  'use strict';
  var d = document, root = d.getElementById('courses');
  if(!root) return;
  var grid = root.querySelector('.course-grid'), input = d.getElementById('quick-search');
  function $$(s, c){ return Array.prototype.slice.call((c || d).querySelectorAll(s)); }

  /* ---------- 1. light photos ----------
     The thumbnails are 150–730KB PNG / JPEG files shown at ~400×190. Where
     `php artisan images:webp` has written a WebP copy (the page lists them in
     #course-webp), the card uses it; it falls back to the original if it fails. */
  var copies = {};
  try { JSON.parse((d.getElementById('course-webp') || {}).textContent || '[]').forEach(function(p){ copies[p] = 1; }); } catch(err){}
  $$('.course-thumb img', grid).forEach(function(img){
    var src = img.getAttribute('src') || '', key = (src.split('/storage/app/public/')[1] || '').split('?')[0];
    /* the course title is printed right under the photo */
    img.alt = '';
    if(!key || !copies[key]) return;
    img.addEventListener('error', function back(){ img.removeEventListener('error', back); img.src = src; });
    img.src = src.replace(/\.(png|jpe?g)(\?[^#]*)?$/i, '.webp');
  });

  /* ---------- 2. search that forgives punctuation ----------
     "llb" found nothing ("LL.B." did), and only the title and category were
     searched. Each card's search text now also carries a punctuation-free copy,
     its level and its summary; inner.js reads it on every keystroke. */
  function plain(s){ return String(s || '').toLowerCase().replace(/[^a-z0-9\s]+/g, '').replace(/\s+/g, ' ').trim(); }
  $$('.course-card', grid).forEach(function(card){
    var hay = card.getAttribute('data-search') || '', level = card.querySelector('.academic-level'),
        view = card.querySelector('.academic-course-overview');
    var more = [plain(hay), level ? level.textContent.toLowerCase() : '', view ? view.textContent.toLowerCase() : ''];
    card.setAttribute('data-search', (hay + ' ' + more.join(' ')).replace(/\s+/g, ' ').trim());
  });

  /* ---------- 3. what the card says ---------- */
  /* "₹4,000.00" → "₹4,000" */
  $$('.course-price', grid).forEach(function(p){
    var t = p.lastChild;
    if(t && t.nodeType === 3) t.nodeValue = t.nodeValue.replace(/\.00\s*$/, '');
  });
  /* "Notes: 1" did not say what the notes are */
  $$('.course-note', grid).forEach(function(p){
    var t = p.lastChild, m = t && t.nodeType === 3 && t.nodeValue.match(/Notes:\s*(\d+)/);
    if(m) t.nodeValue = ' Study notes included: ' + m[1];
  });

  /* ---------- 4. the category button names its current choice ----------
     (for when the one-tap category buttons are unavailable and it shows) */
  var dd = root.querySelector('.dd-btn'), ddLabel = dd && dd.querySelector('.dd-label');
  if(dd && ddLabel){
    ddLabel.id = ddLabel.id || 'dd-cat-value';
    dd.setAttribute('aria-labelledby', 'lbl-cat ' + ddLabel.id);
  }

  /* ---------- 5. "Explore your options" filters in place ----------
     Its cards link back to this page with ?q=, reloading the whole page to search.
     (That block is rendered after this section, so wait for it.) */
  function toResults(){
    var header = d.getElementById('siteHeader');
    window.scrollTo({ top: Math.max(root.querySelector('.filter-bar').getBoundingClientRect().top + window.scrollY - 16, 0), behavior: 'instant' });
    var cover = header ? Math.max(header.getBoundingClientRect().bottom, 0) : 0;   // the header once it has stuck
    if(cover) window.scrollTo({ top: Math.max(window.scrollY - cover, 0), behavior: 'instant' });
  }
  function search(q){
    input.value = q;
    input.dispatchEvent(new Event('input', { bubbles: true }));
    var none = root.querySelector('.res-none');
    if(none && !none.hidden){ input.value = ''; input.dispatchEvent(new Event('input', { bubbles: true })); }
  }
  d.addEventListener('DOMContentLoaded', function(){
    if(!input) return;
    $$('a.academic-link[href]').forEach(function(a){
      var url;
      try { url = new URL(a.href, location.href); } catch(err){ return; }
      var q = url.searchParams.get('q');
      if(url.pathname !== location.pathname || !q) return;
      a.addEventListener('click', function(e){
        if(e.ctrlKey || e.metaKey || e.shiftKey || e.button > 0) return;   // new tab / window: as before
        e.preventDefault();
        search(q);
        toResults();
        input.focus({ preventScroll: true });
      });
    });
  });
})();
