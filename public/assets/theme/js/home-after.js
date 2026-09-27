/* Home page fixes. Loaded right AFTER home.js and the page's own form script.
   It only adds behaviour or corrects what home.js injected; no existing script
   is edited. Styles are in home.css. */
(function(w, d){
  'use strict';
  function $(s, c){ return (c || d).querySelector(s); }
  function $$(s, c){ return Array.prototype.slice.call((c || d).querySelectorAll(s)); }
  function remove(el){ if(el && el.parentNode) el.parentNode.removeChild(el); }

  /* ---------- 0. hand the real matchMedia back (home-calm.js) ---------- */
  var calm = w.__homeCalm || {};
  if(calm.matchMedia) w.matchMedia = calm.matchMedia;
  var reallyReduced = false;
  try { reallyReduced = w.matchMedia('(prefers-reduced-motion: reduce)').matches; } catch(err){}
  /* home.js's calm branch also turned smooth scrolling off; keep it for everyone else */
  if(!reallyReduced) d.documentElement.style.scrollBehavior = '';

  /* ---------- 1. placeholder content and pop-ups home.js injects ---------- */
  /* testimonials with invented names ("PLACEHOLDER TESTIMONIALS" in home.js) and the
     placeholder figures strip (5000+ students, 94% success; hidden by CSS already) */
  $$('.testimonial-carousel, .stats-strip').forEach(remove);
  /* the counsellor pop-up, the course ticker and the ring's "Enroll Now" hit area
     (the ring itself stays: back to top) */
  $$('.counsel-pop, .course-ticker, .pw-cta-hit').forEach(remove);

  /* ---------- 2. sections in reading order ----------
     Courses, then why and how, then the libraries, Legal Knowledge together
     with its enquiry form, and the two course / contact forms at the end
     (they were spread through the page between the content). */
  var main = $('main');
  if(main){
    ['#home', '#about', '#courses', '.why-section', '.how-section', '#notes', '#acts', '#rules', '#exams',
     '#knowledge', '.updates-section', '.form-section', '#gallery', '.enquiry-section', '#contact']
      .forEach(function(sel){ var s = main.querySelector(':scope > section' + sel); if(s) main.appendChild(s); });
  }

  /* listing pages open already searched for the item (deeplink.js reads ?q=) */
  function words(text){
    return String(text).replace(/[…]+/g, ' ').replace(/[,;:()"“”‘’–—]/g, ' ').replace(/\s+/g, ' ').trim();
  }
  function searchUrl(href, text){
    var q = words(text), base = String(href || '').split('#')[0].split('?')[0];
    return q && base ? base + '?q=' + encodeURIComponent(q) : href;
  }

  /* ---------- 3. course cards open their course ----------
     home.js sent a click anywhere on a card to the enquiry form, and every
     "Explore Course" went to the same course list. The click stops at the grid
     (capture phase) before home.js sees it; the card's link (the whole card, see
     home.css) opens the course list searched for that course. */
  var grid = $('.course-grid');
  if(grid){
    grid.addEventListener('click', function(e){ e.stopPropagation(); }, true);
    $$('.course-card', grid).forEach(function(card){
      var t = $('h3', card), link = $('.course-link', card);
      if(t && link) link.href = searchUrl(link.getAttribute('href'), t.textContent);
    });
  }

  /* ---------- 4. list cards: a clean title, the right plural, a link to the item ---------- */
  $$('.list-card').forEach(function(card){
    var h = $('h4', card), pdf = $('.pdf', card), go = $('.go', card);
    if(h){
      /* descriptions read "Title - details…", cut at 70 characters mid-sentence */
      var text = h.textContent.replace(/\s+/g, ' ').trim(), cut = text.indexOf(' - ');
      if(cut > 8){
        h.textContent = text.slice(0, cut);
        var sub = d.createElement('span');
        sub.className = 'lc-sub';
        sub.textContent = text.slice(cut + 3);
        h.parentNode.insertBefore(sub, h.nextSibling);
      }
      card.href = searchUrl(card.getAttribute('href'), h.textContent);
    }
    if(pdf){
      var m = pdf.textContent.match(/^\s*(\d+)\s+PDF/);
      if(m && m[1] !== '1') pdf.textContent = m[1] + ' PDFs available';
    }
    /* every card said "View All" although each is one item */
    if(go && go.firstChild && go.firstChild.nodeType === 3) go.firstChild.nodeValue = 'Open ';
  });

  /* ---------- 5. the course enquiry lists the courses shown on the page ----------
     Its list was fixed in the markup and missed most of them. */
  var pick = $('#he-course');
  if(pick){
    var have = $$('option', pick).map(function(o){ return o.textContent.trim().toLowerCase(); });
    $$('.course-card h3').forEach(function(h){
      var name = h.textContent.replace(/\s+/g, ' ').trim();
      if(!name || have.indexOf(name.toLowerCase()) > -1) return;
      var o = d.createElement('option');
      o.textContent = name;
      pick.appendChild(o);
      have.push(name.toLowerCase());
    });
  }

  /* ---------- 6. phone numbers: every form takes the ways people write them ----------
     "+91 98765 43210", "098765 43210" and "98765-43210" all become 9876543210, the
     10 digits two of the forms (and the server) require; the Knowledge form keeps
     accepting anything else it did before. */
  $$('#home-inquiry input[type="tel"], #home-enquiry input[type="tel"], #home-contact input[type="tel"]').forEach(function(input){
    if(input.maxLength > 0 && input.maxLength < 16) input.maxLength = 16;   // room to type the +91 and spaces
    function tidy(){
      var s = input.value.replace(/[\s\-().]/g, ''), m = s.match(/^(?:\+?91|0)(\d{10})$/), n = m ? m[1] : s;
      if(n !== input.value) input.value = n;
    }
    input.addEventListener('input', tidy);
    input.addEventListener('blur', tidy);
  });

  /* ---------- 7. two of the three forms open on request ----------
     The Knowledge Inquiry and Course Enquiry forms (~1,300–1,650px each on a phone)
     sat open between the content. Each now opens from a button under its heading;
     the Contact form at the end stays open, and a form that came back with an
     error stays open too. */
  [['home-inquiry', 'Ask about a legal topic'], ['home-enquiry', 'Enquire about a course']].forEach(function(p){
    var form = d.getElementById(p[0]);
    if(!form || $('.form-status[role="alert"]', form)) return;
    var wrap = d.createElement('div'), btn = d.createElement('button'), icon = d.createElement('span');
    wrap.className = 'form-open-wrap';
    btn.type = 'button';
    btn.className = 'btn btn-gold form-open';
    btn.setAttribute('aria-expanded', 'false');
    btn.setAttribute('aria-controls', form.id);
    btn.appendChild(d.createTextNode(p[1] + ' '));
    icon.className = 'site-icon icon-chevron-down';
    icon.setAttribute('aria-hidden', 'true');
    btn.appendChild(icon);
    wrap.appendChild(btn);
    form.parentNode.insertBefore(wrap, form);
    form.hidden = true;
    btn.addEventListener('click', function(){
      form.hidden = false;
      wrap.hidden = true;
      btn.setAttribute('aria-expanded', 'true');
      var first = form.querySelector('input:not([type="hidden"]), select, textarea');
      if(first) first.focus();
    });
  });

  /* ---------- 8. screen readers ---------- */
  /* the hero heading right under the logo already says "Law Students" */
  var logo = $('.hero-logo');
  if(logo) logo.alt = '';
  /* card titles skipped from h2 to h4 / h5 */
  $$('.list-card h4, .album-body h4, .kn-card h5, .contact-item h5').forEach(function(h){ h.setAttribute('aria-level', '3'); });
})(window, document);
