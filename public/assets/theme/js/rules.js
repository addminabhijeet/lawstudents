/* Rules page fixes. Loaded right after the rules section, before inner.js and
   readable.js set up the list. Only adds behaviour; no existing script is
   edited. Styles are in rules.css. Same fixes as acts.js, plus repealed-law lines. */
(function(){
  'use strict';
  var d = document, root = d.getElementById('rules');
  if(!root) return;
  function $$(s, c){ return Array.prototype.slice.call((c || d).querySelectorAll(s)); }
  var cards = $$('.res-list .list-card', root);

  /* ---------- 1. each file says what it is ----------
     "PDF 1" becomes "Summary · 2 pages · 43 KB" or "40 pages · 1.3 MB"
     (page counts from App\Support\PdfInfo, listed in #rule-pdf-info). */
  var info = {};
  try { info = JSON.parse((d.getElementById('rule-pdf-info') || {}).textContent || '{}') || {}; } catch(err){}
  function size(b){ return b >= 1048576 ? (b / 1048576).toFixed(1).replace(/\.0$/, '') + ' MB' : Math.max(1, Math.round(b / 1024)) + ' KB'; }
  function fileKey(href){
    var raw = (href.split('/storage/app/public/')[1] || '').split('?')[0];
    try { return decodeURIComponent(raw); } catch(err){ return raw; }
  }
  cards.forEach(function(card){
    $$('.list-meta', card).forEach(function(meta){
      var label = meta.querySelector('.pdf'), view = meta.querySelector('a.primary');
      if(!label || !view) return;
      var i = info[fileKey(view.getAttribute('href') || '')];
      if(!i) return;
      var short = i.pages !== null && i.pages <= 2, parts = [];
      if(short) parts.push('Summary');
      if(i.pages) parts.push(i.pages + ' ' + (i.pages === 1 ? 'page' : 'pages'));
      parts.push(size(i.bytes));
      label.textContent = parts.join(' · ');
      if(short) label.classList.add('is-summary');
      view.setAttribute('aria-label', 'View ' + (short ? 'the summary' : 'the file') + ', PDF, opens in a new tab');
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

  /* ---------- 3. repealed law says so ----------
     On 1 July 2024 three new criminal laws replaced the IPC, the CrPC and the
     Evidence Act. A card about one of the old laws gets a line saying so,
     under its title. */
  var REPEALED = [
    [/code of criminal procedure,?\s*1973/i,'Bharatiya Nagarik Suraksha Sanhita, 2023 (BNSS)', 'bnss nagarik suraksha'],
    [/indian evidence act,?\s*1872/i, 'Bharatiya Sakshya Adhiniyam, 2023 (BSA)', 'bsa sakshya adhiniyam'],
    [/indian penal code,?\s*1860/i, 'Bharatiya Nyaya Sanhita, 2023 (BNS)', 'bns nyaya sanhita']
  ];
  cards.forEach(function(card){
    var h = card.querySelector('h4');
    if(!h) return;
    var t = h.textContent + ' ' + ((card.querySelector('.lc-sub') || {}).textContent || '');
    REPEALED.some(function(r){
      if(!r[0].test(t)) return false;
      var p = d.createElement('p'), s = d.createElement('strong');
      p.className = 'rl-repealed';
      s.textContent = 'Repealed 1 July 2024';
      p.appendChild(s);
      p.appendChild(d.createTextNode(' · now the ' + r[1]));
      var after = card.querySelector('.lc-sub') || h;
      after.parentNode.insertBefore(p, after.nextSibling);
      card.setAttribute('data-search', (card.getAttribute('data-search') || '') + ' repealed old law ' + r[2]);
      return true;
    });
  });

  /* ---------- 4. search finds the names people use ----------
     "cpc", "crpc", "order 39", "bnss" or "bsa" found nothing. Each card's search
     text also carries a punctuation-free copy and the usual short names. */
  var ALIASES = [
    [/order xxxix|temporary injunction/, 'order 39 o39 injunction interim injunction stay'],
    [/civil procedure/, 'cpc code of civil procedure civil procedure code'],
    [/criminal procedure/, 'crpc criminal procedure code bnss nagarik suraksha bail anticipatory bail'],
    [/evidence act|evidence rules/, 'iea indian evidence act evidence law bsa sakshya adhiniyam'],
    [/companies|company law/, 'company law corporate companies act 2013 spice plus opc one person company incorporation mca'],
    [/landmark judgment|judgments/, 'judgment judgement case law case precedent'],
    [/capacity to contract|dharmodas|mohori/, 'contract act indian contract act contract law minor minors agreement void mohori bibi mohari bibi dharmodas ghose']
  ];
  cards.forEach(function(card){
    var hay = card.getAttribute('data-search') || '', more = [hay.replace(/[^a-z0-9\s]+/g, '')];
    ALIASES.forEach(function(a){ if(a[0].test(hay)) more.push(a[1]); });
    card.setAttribute('data-search', (hay + ' ' + more.join(' ')).replace(/\s+/g, ' ').trim());
  });

  /* ---------- 5. headings in order ----------
     Category names sat in buttons, not headings (h2 → h3 subcategory → h4 rule).
     Each button now sits inside an h3; subcategories and rules step down one level. */
  $$('.res-cat > .res-cat-head', root).forEach(function(btn){
    var h = d.createElement('h3');
    h.className = 'res-cat-h';
    btn.parentNode.insertBefore(h, btn);
    h.appendChild(btn);
  });
  $$('.res-sub > h3', root).forEach(function(h){ h.setAttribute('aria-level', '4'); });
  cards.forEach(function(card){ var h = card.querySelector('h4'); if(h) h.setAttribute('aria-level', '5'); });

  /* ---------- 6. the category button names its current choice ---------- */
  var dd = root.querySelector('.dd-btn'), ddLabel = dd && dd.querySelector('.dd-label');
  if(dd && ddLabel){
    ddLabel.id = ddLabel.id || 'dd-rule-value';
    dd.setAttribute('aria-labelledby', 'lbl-cat ' + ddLabel.id);
  }

  /* ---------- 7. links say where they go ----------
     A guest's "Download" leads to Google sign-in without saying so. The button
     keeps its short label (a longer one wraps on phones); its name, tooltip and
     one line above the list say it. */
  var gated = $$('.res-actions a', root).filter(function(a){ return /\/auth\/google/.test(a.getAttribute('href') || ''); });
  gated.forEach(function(a){
    a.setAttribute('aria-label', 'Download, needs a Google sign-in');
    a.setAttribute('title', 'Downloading needs a Google sign-in');
  });
  if(gated.length){
    var note = root.querySelector('.rules-note');
    if(!note){
      note = d.createElement('p');
      note.className = 'rules-note';
      var bar = root.querySelector('.filter-bar');
      if(bar) bar.parentNode.insertBefore(note, bar.nextSibling);
    }
    note.appendChild(d.createTextNode((note.textContent ? ' ' : '') + 'Downloading needs a Google sign-in.'));
  }
})();
