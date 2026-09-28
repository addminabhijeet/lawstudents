/* List pages fixes: Free Notes, Govt. Examination and the Legal Knowledge Library.
   Loaded right after the list section, before inner.js and readable.js set up
   the list (its script tag names the section: data-root="notes" / "exams" /
   "library"). Only adds behaviour; no existing script is edited. The same fixes
   as acts.js and rules.js. Styles are in res-lists.css. */
(function(){
  'use strict';
  var d = document, me = d.currentScript;
  var root = d.getElementById((me && me.getAttribute('data-root')) || '');
  if(!root) return;
  function $$(s, c){ return Array.prototype.slice.call((c || d).querySelectorAll(s)); }
  var cards = $$('.res-list .list-card', root);
  var noun = (me && me.getAttribute('data-noun')) || 'item';

  /* ---------- 1. each file says what it is ----------
     "PDF 1" becomes "Summary · 2 pages · 49 KB" or "40 pages · 1.3 MB"
     (page counts from App\Support\PdfInfo, listed in #list-pdf-info). */
  var info = {};
  try { info = JSON.parse((d.getElementById('list-pdf-info') || {}).textContent || '{}') || {}; } catch(err){}
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
      view.setAttribute('aria-label', 'View the ' + (short ? 'summary' : noun) + ', PDF, opens in a new tab');
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
     Evidence Act. A card whose title names one of the old laws gets a line saying
     so, under its title. */
  var REPEALED = [
    [/indian penal code|\bipc\b/i, 'Bharatiya Nyaya Sanhita, 2023 (BNS)', 'bns nyaya sanhita'],
    [/code of criminal procedure|\bcr\.?\s?p\.?c\b/i, 'Bharatiya Nagarik Suraksha Sanhita, 2023 (BNSS)', 'bnss nagarik suraksha'],
    [/indian evidence act/i, 'Bharatiya Sakshya Adhiniyam, 2023 (BSA)', 'bsa sakshya adhiniyam']
  ];
  cards.forEach(function(card){
    var h = card.querySelector('h4');
    if(!h || /sanhita|adhiniyam|\bbns\b|\bbnss\b|\bbsa\b/i.test(h.textContent)) return;
    REPEALED.some(function(r){
      if(!r[0].test(h.textContent)) return false;
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
     Each card's search text also carries a punctuation-free copy, the usual short
     names of its subject and the numbers of Roman-numbered Orders ("order 21"). */
  var ALIASES = [
    [/indian penal code|\bipc\b/, 'ipc penal code bns nyaya sanhita criminal law'],
    [/criminal procedure|\bcrpc\b/, 'crpc criminal procedure code bnss nagarik suraksha'],
    [/evidence act/, 'iea evidence act bsa sakshya adhiniyam evidence law'],
    [/civil procedure/, 'cpc code of civil procedure civil procedure code'],
    [/fundamental rights|constitution/, 'constitution constitutional law fundamental rights part iii'],
    [/article 21|right to life/, 'article 21 art 21 life and personal liberty maneka gandhi'],
    [/upsc|civil services/, 'upsc cse ias ips civil services prelims mains'],
    [/judicial services|civil judge/, 'judiciary judicial services pcs j pcsj civil judge exam'],
    [/\baibe\b|bar exam/, 'aibe all india bar examination bar exam bar council'],
    [/\bssc\b/, 'ssc cgl staff selection commission'],
    [/\brbi\b|reserve bank/, 'rbi reserve bank grade b legal officer banking'],
    [/information technology act|cyber/, 'it act cyber law cyber crime information technology'],
    [/right to information|\brti\b/, 'rti right to information'],
    [/consumer/, 'consumer protection consumer rights cpa ecommerce e-commerce'],
    [/legal aid|39a/, 'legal aid free legal aid nalsa lok adalat']
  ];
  var ROMAN = { i: 1, v: 5, x: 10, l: 50, c: 100 };
  function roman(s){
    var n = 0;
    for(var k = 0; k < s.length; k++){
      var a = ROMAN[s[k]], b = ROMAN[s[k + 1]] || 0;
      n += a < b ? -a : a;
    }
    return n;
  }
  cards.forEach(function(card){
    var hay = card.getAttribute('data-search') || '', more = [hay.replace(/[^a-z0-9\s]+/g, ' ')];
    ALIASES.forEach(function(a){ if(a[0].test(hay)) more.push(a[1]); });
    hay.replace(/\border\s+(?=[ivxl])(l?x{0,3}(?:ix|iv|v?i{0,3}))(?:\s*[-–]\s*(?=[ivxl])(l?x{0,3}(?:ix|iv|v?i{0,3})))?\b/g, function(m, from, to){
      var a = roman(from), b = to ? roman(to) : a;
      for(var n = a; n <= b && n - a < 20; n++) more.push('order ' + n);
      return m;
    });
    card.setAttribute('data-search', (hay + ' ' + more.join(' ')).replace(/\s+/g, ' ').trim());
  });

  /* ---------- 5. headings in order ----------
     Category names sat in buttons, not headings (h2 → h3 subcategory → h4 item).
     Each button now sits inside an h3; subcategories and items step down one level. */
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
    ddLabel.id = ddLabel.id || 'dd-' + root.id + '-value';
    dd.setAttribute('aria-labelledby', 'lbl-cat ' + ddLabel.id);
  }

  /* ---------- 7. links say where they go ----------
     A guest's "Download" leads to Google sign-in without saying so. The button
     keeps its short label; its name, tooltip and one line above the list say it. */
  var bar = root.querySelector('.filter-bar');
  function note(text){
    var p = root.querySelector('.rl-note');
    if(!p){
      p = d.createElement('p');
      p.className = 'rl-note';
      if(bar) bar.parentNode.insertBefore(p, bar.nextSibling);
    }
    p.appendChild(d.createTextNode((p.textContent ? ' ' : '') + text));
  }
  var gated = $$('.res-actions a', root).filter(function(a){ return /\/auth\/google/.test(a.getAttribute('href') || ''); });
  gated.forEach(function(a){
    a.setAttribute('aria-label', 'Download, needs a Google sign-in');
    a.setAttribute('title', 'Downloading needs a Google sign-in');
  });
  if(gated.length) note('Downloading needs a Google sign-in.');

  /* ---------- 8. a link to an empty category shows everything ----------
     The home page and the sitemap linked to categories with nothing in them
     (?cat=<id>), which left a blank list. The address loses its ?cat= before
     inner.js reads it, and one line says why everything is shown. */
  var params = new URLSearchParams(location.search), want = params.get('cat');
  if(want){
    var cat = root.querySelector('.res-cat[data-cat="' + want.replace(/"/g, '') + '"]');
    if(cat && !cat.querySelector('.list-card')){
      params.delete('cat');
      try { history.replaceState(history.state, '', location.pathname + (params.toString() ? '?' + params : '') + location.hash); } catch(err){}
      var name = ((cat.querySelector('.res-cat-head > span') || {}).textContent || 'That category').trim();
      var p = d.createElement('p');
      p.className = 'rl-note';
      p.setAttribute('role', 'status');
      p.textContent = '“' + name + '” has nothing in it yet, so every category is shown.';
      var first = root.querySelector('.rl-note');
      if(first) first.parentNode.insertBefore(p, first.nextSibling);
      else if(bar) bar.parentNode.insertBefore(p, bar.nextSibling);
    }
  }
})();
