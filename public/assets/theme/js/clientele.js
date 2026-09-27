/* Clientele page fixes. Loaded right after the client section. Only adds
   behaviour; no existing script is edited. Styles are in clientele.css. */
(function(){
  'use strict';
  var d = document, sec = d.getElementById('client');
  if(!sec) return;
  var form = sec.querySelector('form.form-card');
  function $$(s, c){ return Array.prototype.slice.call((c || d).querySelectorAll(s)); }

  /* ---------- 1. testimonial cards say what they are (when shown) ----------
     Each card was a name and "View PDF", opening a new tab without saying so. */
  $$('.testi-list .list-card', sec).forEach(function(card){
    var name = card.querySelector('h4'), go = card.querySelector('.go');
    if(name) name.setAttribute('aria-level', '3');           /* skipped from h2 to h4 */
    if(go && go.firstChild && go.firstChild.nodeType === 3) go.firstChild.nodeValue = 'Read testimonial (PDF) ';
    if(name) card.setAttribute('aria-label', 'Testimonial from ' + name.textContent.trim() + ', PDF, opens in a new tab');
  });

  if(!form) return;
  form.id = form.id || 'client-form';

  /* ---------- 2. the button says what it does ---------- */
  var send = form.querySelector('button[type="submit"]');
  if(send && send.firstChild && send.firstChild.nodeType === 3 && /Join Our Client Network/.test(send.firstChild.nodeValue)){
    send.firstChild.nodeValue = 'Send Message ';
  }

  /* ---------- 3. programmes and the real courses, in two groups ----------
     The list held 14 fixed programmes; the Contact page also lists the courses. */
  var pick = form.querySelector('select[name="service_type"]');
  var listed = [];
  try { listed = JSON.parse((d.getElementById('cl-courses') || {}).textContent || '[]'); } catch(err){}
  if(pick && !pick.querySelector('optgroup')){
    var general = d.createElement('optgroup'), courses = d.createElement('optgroup'), have = {};
    general.label = 'Programmes and topics';
    courses.label = 'Courses';
    $$('option', pick).forEach(function(o){ if(o.value !== ''){ general.appendChild(o); have[o.value.toLowerCase()] = 1; } });
    listed.forEach(function(title){
      if(!title || have[String(title).toLowerCase()]) return;
      var o = d.createElement('option');
      o.value = o.textContent = title;
      courses.appendChild(o);
    });
    pick.appendChild(general);
    if(courses.children.length) pick.appendChild(courses);
  }

  /* ---------- 4. labels, not echoes; hints ---------- */
  $$('input, textarea', form).forEach(function(f){
    var label = f.id && form.querySelector('label[for="' + f.id + '"]');
    if(!label || !f.placeholder) return;
    if(f.placeholder.trim().toLowerCase() === label.textContent.replace('*', '').trim().toLowerCase()) f.removeAttribute('placeholder');
  });
  function hint(field, text, id){
    if(!field) return;
    var p = d.createElement('p');
    p.className = 'field-hint'; p.id = id; p.textContent = text;
    field.parentNode.appendChild(p);
    field.setAttribute('aria-describedby', ((field.getAttribute('aria-describedby') || '') + ' ' + id).trim());
  }
  hint(d.getElementById('cl-last'), 'Only one name? Enter it here too.', 'cl-last-hint');   /* the server requires a last name */
  hint(d.getElementById('cl-msg'), 'At least 10 characters.', 'cl-msg-hint');

  /* ---------- 5. phone: "+91 98765 43210", "098765 43210" and "98765-43210" all work ---------- */
  var tel = d.getElementById('cl-phone');
  if(tel){
    if(tel.maxLength > 0 && tel.maxLength < 16) tel.maxLength = 16;
    tel.setAttribute('placeholder', 'e.g. 98765 43210');
    var tidy = function(){
      var s = tel.value.replace(/[\s\-().]/g, ''), m = s.match(/^(?:\+?91|0)(\d{10})$/), n = m ? m[1] : s;
      if(n !== tel.value) tel.value = n;
    };
    tel.addEventListener('input', tidy);
    tel.addEventListener('blur', tidy);
  }

  /* ---------- 6. errors next to their fields ---------- */
  var errors = {};
  try { errors = JSON.parse((d.getElementById('cl-errors') || {}).textContent || '{}'); } catch(err){ errors = {}; }
  Object.keys(errors).forEach(function(name){
    var f = form.elements[name];
    if(!f || !f.parentNode || !errors[name] || !errors[name][0]) return;
    var id = 'cl-err-' + name, p = d.createElement('p');
    p.className = 'field-error'; p.id = id; p.textContent = errors[name][0];
    f.parentNode.appendChild(p);
    f.setAttribute('aria-invalid', 'true');
    f.setAttribute('aria-describedby', (id + ' ' + (f.getAttribute('aria-describedby') || '')).trim());
    f.addEventListener('input', function clear(){
      f.removeAttribute('aria-invalid'); if(p.parentNode) p.parentNode.removeChild(p);
      f.removeEventListener('input', clear);
    });
  });

  /* ---------- 7. after sending, the result is on screen ----------
     The page reloaded at the top with the "sent" or error message ~1,700px down. */
  var status = form.querySelector('.form-status');
  if(status){
    status.tabIndex = -1;
    var go = function(){
      var header = d.getElementById('siteHeader');
      window.scrollTo({ top: Math.max(form.getBoundingClientRect().top + window.scrollY - 16, 0), behavior: 'instant' });
      var cover = header ? Math.max(header.getBoundingClientRect().bottom, 0) : 0;   // the header once it has stuck
      if(cover) window.scrollTo({ top: Math.max(window.scrollY - cover, 0), behavior: 'instant' });
      (form.querySelector('[aria-invalid="true"]') || status).focus({ preventScroll: true });
    };
    if(d.readyState === 'complete') go(); else window.addEventListener('load', go);
  }
})();
