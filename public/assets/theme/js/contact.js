/* Contact Us fixes. Loaded right after the contact section, before the map below
   the fold starts loading. Only adds behaviour; no existing script is edited.
   Styles are in contact.css. */
(function(){
  'use strict';
  var d = document, form = d.getElementById('contact-form');
  function $$(s, c){ return Array.prototype.slice.call((c || d).querySelectorAll(s)); }
  function mapSearch(q){ return 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(q); }

  /* ---------- 1. the description no longer promises mentors ---------- */
  var meta = d.querySelector('meta[name="description"]');
  if(meta) meta.setAttribute('content', 'Contact Law Students by phone, WhatsApp, e-mail or the enquiry form about courses, Bare Acts, Rules, study notes and legal knowledge resources.');

  /* ---------- 2. the address opens directions ---------- */
  $$('.contact-section .contact-item').forEach(function(item){
    if(!item.querySelector('.icon-map-pin')) return;
    var p = item.querySelector('p'), text = p && p.textContent.replace(/\s+/g, ' ').trim();
    if(!text || p.querySelector('a')) return;
    var a = d.createElement('a');
    a.href = mapSearch(text); a.target = '_blank'; a.rel = 'noopener'; a.title = 'Open in Google Maps';
    a.textContent = text;
    p.textContent = ''; p.appendChild(a);
  });

  /* ---------- 3. screen readers: the detail labels skipped from h2 to h5 ---------- */
  $$('.contact-section .contact-item h5').forEach(function(h){ h.setAttribute('aria-level', '3'); });

  if(!form) return;

  /* ---------- 5. programmes and courses in two labelled groups ----------
     The list mixed ~27 course titles with 14 general programmes, so "CA" sat
     beside "CA Foundation…". */
  var pick = d.getElementById('ct-service');
  var GENERAL = ['LL.B. Entrance Examination', 'LL.B. - 3 Years', 'LL.B. - 5 Years', 'LL.M.', 'Judiciary Examination',
    'CSEET', 'CA', 'CS', 'CMA', 'English Grammar', 'Spoken English', 'Bare Acts / Rules', 'Legal Knowledge', 'Other'];
  if(pick && !pick.querySelector('optgroup')){
    var general = d.createElement('optgroup'), courses = d.createElement('optgroup');
    general.label = 'Programmes and topics';
    courses.label = 'Courses';
    var byText = {};
    $$('option', pick).forEach(function(o){ if(o.value !== '') byText[o.value] = o; });
    GENERAL.forEach(function(name){ if(byText[name]){ general.appendChild(byText[name]); delete byText[name]; } });
    Object.keys(byText).forEach(function(name){ courses.appendChild(byText[name]); });
    if(general.children.length) pick.appendChild(general);
    if(courses.children.length) pick.appendChild(courses);
  }

  /* ---------- 6. labels, not echoes: placeholders that repeated the label go ---------- */
  $$('input, textarea', form).forEach(function(f){
    var label = f.id && form.querySelector('label[for="' + f.id + '"]');
    if(!label || !f.placeholder) return;
    var name = label.textContent.replace('*', '').trim().toLowerCase();
    if(f.placeholder.trim().toLowerCase() === name) f.removeAttribute('placeholder');
  });
  function hint(field, text, id){
    if(!field) return;
    var p = d.createElement('p');
    p.className = 'field-hint'; p.id = id; p.textContent = text;
    field.parentNode.appendChild(p);
    field.setAttribute('aria-describedby', ((field.getAttribute('aria-describedby') || '') + ' ' + id).trim());
  }
  /* the form still needs a last name (the server requires one) */
  hint(d.getElementById('ct-last'), 'Only one name? Enter it here too.', 'ct-last-hint');
  hint(d.getElementById('ct-msg'), 'At least 10 characters.', 'ct-msg-hint');

  /* ---------- 7. phone: "+91 98765 43210", "098765 43210" and "98765-43210" all work ---------- */
  var tel = d.getElementById('ct-phone');
  if(tel){
    if(tel.maxLength > 0 && tel.maxLength < 16) tel.maxLength = 16;     // room for the +91 and spaces
    tel.setAttribute('placeholder', 'e.g. 98765 43210');
    var tidy = function(){
      var s = tel.value.replace(/[\s\-().]/g, ''), m = s.match(/^(?:\+?91|0)(\d{10})$/), n = m ? m[1] : s;
      if(n !== tel.value) tel.value = n;
    };
    tel.addEventListener('input', tidy);
    tel.addEventListener('blur', tidy);
  }

  /* ---------- 8. errors next to the fields they belong to ----------
     The page showed only the first error, at the top of the form. */
  var bag = d.getElementById('ct-errors'), errors = {};
  try { errors = bag ? JSON.parse(bag.textContent) : {}; } catch(err){ errors = {}; }
  Object.keys(errors).forEach(function(name){
    var f = form.elements[name];
    if(!f || !f.parentNode || !errors[name] || !errors[name][0]) return;
    var id = 'err-' + name, p = d.createElement('p');
    p.className = 'field-error'; p.id = id; p.textContent = errors[name][0];
    f.parentNode.appendChild(p);
    f.setAttribute('aria-invalid', 'true');
    f.setAttribute('aria-describedby', (id + ' ' + (f.getAttribute('aria-describedby') || '')).trim());
    f.addEventListener('input', function clear(){
      f.removeAttribute('aria-invalid'); if(p.parentNode) p.parentNode.removeChild(p);
      f.removeEventListener('input', clear);
    });
  });

  /* ---------- 9. after sending, the result is on screen ----------
     The page reloads at the top while the "sent" or error message sits ~1,700px
     (computer) to ~2,500px (phone) down, inside the form. */
  var status = form.querySelector('.form-status');
  if(status){
    status.tabIndex = -1;
    w_load(function(){
      var header = d.getElementById('siteHeader');
      window.scrollTo({ top: Math.max(form.getBoundingClientRect().top + window.scrollY - 16, 0), behavior: 'instant' });
      var cover = header ? Math.max(header.getBoundingClientRect().bottom, 0) : 0;   // the header once it has stuck
      if(cover) window.scrollTo({ top: Math.max(window.scrollY - cover, 0), behavior: 'instant' });
      var firstBad = form.querySelector('[aria-invalid="true"]');
      (firstBad || status).focus({ preventScroll: true });
    });
  }
  function w_load(fn){ if(d.readyState === 'complete') fn(); else window.addEventListener('load', fn); }
})();
