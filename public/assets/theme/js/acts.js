/* Acts page fixes. Loaded right after the acts section, before inner.js and
   readable.js set up the list. Only adds behaviour; no existing script is
   edited. Styles are in acts.css. */
(function(){
  'use strict';
  var d = document, root = d.getElementById('acts');
  if(!root) return;
  function $$(s, c){ return Array.prototype.slice.call((c || d).querySelectorAll(s)); }
  var cards = $$('.res-list .list-card', root);

  /* ---------- 1. each file says what it is ----------
     "PDF 1" becomes "Short summary · 1 page · 43 KB" or "102 pages · 1.3 MB"
     (page counts from App\Support\PdfInfo, listed in #act-pdf-info). */
  var info = {};
  try { info = JSON.parse((d.getElementById('act-pdf-info') || {}).textContent || '{}') || {}; } catch(err){}
  function size(b){ return b >= 1048576 ? (b / 1048576).toFixed(1).replace(/\.0$/, '') + ' MB' : Math.max(1, Math.round(b / 1024)) + ' KB'; }
  cards.forEach(function(card){
    $$('.list-meta', card).forEach(function(meta){
      var label = meta.querySelector('.pdf'), view = meta.querySelector('a.primary');
      if(!label || !view) return;
      var key = view.getAttribute('data-pdf-key') || decodeURIComponent((view.getAttribute('href').split('/storage/app/public/')[1] || '').split('?')[0]);
      var i = info[key];
      if(!i) return;
      var short = i.pages !== null && i.pages <= 2, parts = [];
      if(short) parts.push('Summary');
      if(i.pages) parts.push(i.pages + ' ' + (i.pages === 1 ? 'page' : 'pages'));
      parts.push(size(i.bytes));
      label.textContent = parts.join(' · ');
      if(short) label.classList.add('is-summary');
      view.setAttribute('aria-label', 'View ' + (short ? 'the summary' : 'the Act') + ', PDF, opens in a new tab');
    });
  });

  /* ---------- 2. title and summary on their own lines ---------- */
  cards.forEach(function(card){
    var h = card.querySelector('h4');
    if(!h) return;
    var t = h.textContent.replace(/\s+/g, ' ').trim(), cut = t.indexOf(' - ');
    if(cut < 8) return;
    h.textContent = t.slice(0, cut);
    var sub = d.createElement('span');
    sub.className = 'lc-sub';
    sub.textContent = t.slice(cut + 3);
    h.parentNode.insertBefore(sub, h.nextSibling);
  });

  /* ---------- 3. search finds the names people use ----------
     "bns", "ipc" or "crpc" found nothing. Each card's search text also carries a
     punctuation-free copy and the usual short names of its Act. */
  var ALIASES = [
    [/nyaya sanhita|penal code/, 'bns ipc indian penal code penal code criminal law'],
    [/sakshya adhiniyam|evidence act/, 'bsa evidence act indian evidence act iea'],
    [/nagarik suraksha|criminal procedure/, 'bnss crpc criminal procedure code'],
    [/code of civil procedure|civil procedure code/, 'cpc civil procedure'],
    [/companies act/, 'company law corporate'],
    [/contract act/, 'ica contract law'],
    [/transfer of property/, 'tpa property law'],
    [/hindu marriage/, 'hma marriage divorce family law'],
    [/industrial disputes/, 'ida labour law strike lockout'],
    [/consumer protection/, 'cpa consumer court consumer rights']
  ];
  cards.forEach(function(card){
    var hay = card.getAttribute('data-search') || '', more = [hay.replace(/[^a-z0-9\s]+/g, '')];
    ALIASES.forEach(function(a){ if(a[0].test(hay)) more.push(a[1]); });
    card.setAttribute('data-search', (hay + ' ' + more.join(' ')).replace(/\s+/g, ' ').trim());
  });

  /* ---------- 4. headings in order ----------
     Category names sat in buttons, not headings (h2 → h3 subcategory → h4 act).
     Each button now sits inside an h3; subcategories and acts step down one level. */
  $$('.res-cat > .res-cat-head', root).forEach(function(btn){
    var h = d.createElement('h3');
    h.className = 'res-cat-h';
    btn.parentNode.insertBefore(h, btn);
    h.appendChild(btn);
  });
  $$('.res-sub > h3', root).forEach(function(h){ h.setAttribute('aria-level', '4'); });
  cards.forEach(function(card){ var h = card.querySelector('h4'); if(h) h.setAttribute('aria-level', '5'); });

  /* ---------- 5. the category button names its current choice ---------- */
  var dd = root.querySelector('.dd-btn'), ddLabel = dd && dd.querySelector('.dd-label');
  if(dd && ddLabel){
    ddLabel.id = ddLabel.id || 'dd-act-value';
    dd.setAttribute('aria-labelledby', 'lbl-cat ' + ddLabel.id);
  }

  /* ---------- 6. links say where they go ----------
     A guest's "Download" leads to Google sign-in without saying so. The button
     keeps its short label (a longer one wrapped on phones); its name, tooltip and
     one line above the list say it. */
  var gated = $$('.res-actions a', root).filter(function(a){ return /\/auth\/google/.test(a.getAttribute('href') || ''); });
  gated.forEach(function(a){
    a.setAttribute('aria-label', 'Download, needs a Google sign-in');
    a.setAttribute('title', 'Downloading needs a Google sign-in');
  });
  if(gated.length){
    var note = root.querySelector('.acts-note');
    if(!note){
      note = d.createElement('p');
      note.className = 'acts-note';
      var bar = root.querySelector('.filter-bar');
      if(bar) bar.parentNode.insertBefore(note, bar.nextSibling);
    }
    note.appendChild(d.createTextNode((note.textContent ? ' ' : '') + 'Viewing a file is open to everyone; downloading it needs a Google sign-in.'));
  }
})();
