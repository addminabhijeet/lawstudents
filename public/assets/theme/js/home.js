var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// Preloader: faster dismissal
window.addEventListener('DOMContentLoaded', function(){
  setTimeout(function(){ document.getElementById('preloader').classList.add('loaded'); }, 1200);
});
setTimeout(function(){ document.getElementById('preloader').classList.add('loaded'); }, 4000);

// Topbar collapse on mobile
var topbar = document.getElementById('topbar');
var header = document.getElementById('siteHeader');
window.addEventListener('scroll', function(){
  if(window.innerWidth <= 768){
    if(window.scrollY > 50) topbar.classList.add('collapsed');
    else topbar.classList.remove('collapsed');
  }
});

// Scroll reveal with improved timing
var io = new IntersectionObserver(function(entries){
  entries.forEach(function(e){
    if(e.isIntersecting){
      setTimeout(function(){
        e.target.classList.add('in');
      }, 50);
      io.unobserve(e.target);
    }
  });
}, { threshold:0.15, rootMargin:'0px 0px -30px 0px' });
document.querySelectorAll('.reveal').forEach(function(el){ io.observe(el); });

// Scroll progress ring + sticky header
var path = document.getElementById('progressPath');
var len = path.getTotalLength();
path.style.strokeDasharray = len + ' ' + len;
path.style.strokeDashoffset = len;
var wrapEl = document.getElementById('progressWrap');

window.addEventListener('scroll', function(){
  var top = window.scrollY;
  var height = document.documentElement.scrollHeight - window.innerHeight;
  path.style.strokeDashoffset = len - (top * len / height);
  wrapEl.classList.toggle('active', top > 300);
  header.classList.toggle('stuck', top > 50);
});
wrapEl.addEventListener('click', function(){ window.scrollTo({top:0, behavior:'smooth'}); });

// ===== ENHANCED ANIMATIONS =====

// Navbar magnetic hover effect
if(!prefersReducedMotion){
  document.querySelectorAll('.nav-menu > li > a').forEach(function(link){
    link.addEventListener('mousemove', function(e){
      var rect = link.getBoundingClientRect();
      var dx = (e.clientX - rect.left - rect.width / 2) * 0.15;
      var dy = (e.clientY - rect.top - rect.height / 2) * 0.15;
      link.style.transform = 'translate(' + dx + 'px, ' + dy + 'px)';
    });
    link.addEventListener('mouseleave', function(){
      link.style.transform = 'translate(0, 0)';
    });
  });
}

// Course card 3D tilt effect
if(!prefersReducedMotion){
  document.querySelectorAll('.course-card').forEach(function(card){
    card.addEventListener('mousemove', function(e){
      var rect = card.getBoundingClientRect();
      var x = (e.clientX - rect.left) / rect.width;
      var y = (e.clientY - rect.top) / rect.height;
      var rotX = (y - 0.5) * 8;
      var rotY = (x - 0.5) * 8;
      card.style.transform = 'rotateX(' + rotX + 'deg) rotateY(' + rotY + 'deg)';
    });
    card.addEventListener('mouseleave', function(){
      card.style.transform = 'rotateX(0) rotateY(0)';
    });
  });
}

// Magnetic cursor effect on buttons
if(!prefersReducedMotion){
  document.querySelectorAll('.btn-gold').forEach(function(btn){
    btn.addEventListener('mousemove', function(e){
      var rect = btn.getBoundingClientRect();
      var dx = (e.clientX - rect.left - rect.width / 2) * 0.2;
      var dy = (e.clientY - rect.top - rect.height / 2) * 0.2;
      btn.style.transform = 'translate(' + dx + 'px, ' + dy + 'px)';
    });
    btn.addEventListener('mouseleave', function(){
      btn.style.transform = 'translate(0, 0)';
    });
  });
}

// Price counter animation on course cards
function animateCounter(el, target, duration){
  var start = 0;
  var increment = target / (duration / 16);
  var current = start;
  var timer = setInterval(function(){
    current += increment;
    if(current >= target){
      current = target;
      clearInterval(timer);
    }
    el.textContent = '₹' + Math.floor(current).toLocaleString('en-IN');
  }, 16);
}

var priceObserver = new IntersectionObserver(function(entries){
  entries.forEach(function(e){
    if(e.isIntersecting && !e.target.dataset.counted){
      e.target.dataset.counted = 'true';
      var price = parseFloat(e.target.textContent.replace(/[₹,]/g, ''));
      if(!prefersReducedMotion) animateCounter(e.target, price, 1200);
    }
  });
}, { threshold:0.5 });

document.querySelectorAll('.course-price').forEach(function(el){ priceObserver.observe(el); });

// Custom cursor dot with lagging ring
if(!prefersReducedMotion && window.innerWidth > 768){
  var cursor = document.createElement('div');
  cursor.style.cssText = 'position:fixed;width:12px;height:12px;background:var(--gold);border-radius:50%;pointer-events:none;z-index:9999;transform:translate(-6px,-6px);box-shadow:0 0 8px rgba(212,175,55,.6);display:none';
  document.body.appendChild(cursor);

  var cursorRing = document.createElement('div');
  cursorRing.style.cssText = 'position:fixed;width:32px;height:32px;border:2px solid var(--gold);border-radius:50%;pointer-events:none;z-index:9998;transform:translate(-16px,-16px);opacity:.4;display:none';
  document.body.appendChild(cursorRing);

  var x = 0, y = 0, ringX = 0, ringY = 0;
  document.addEventListener('mousemove', function(e){
    x = e.clientX;
    y = e.clientY;
    cursor.style.left = x + 'px';
    cursor.style.top = y + 'px';
    cursor.style.display = 'block';
    cursorRing.style.display = 'block';
  });

  setInterval(function(){
    ringX += (x - ringX) * 0.25;
    ringY += (y - ringY) * 0.25;
    cursorRing.style.left = ringX + 'px';
    cursorRing.style.top = ringY + 'px';
  }, 16);
}

// Number count-up animation for How It Works
function countUpNumbers(){
  document.querySelectorAll('.how-num').forEach(function(el){
    var text = el.textContent;
    var num = parseInt(text);
    if(isNaN(num)) return;

    el.dataset.counting = 'true';
    var current = 0;
    var increment = num / 60;
    var timer = setInterval(function(){
      current += increment;
      if(current >= num){
        current = num;
        clearInterval(timer);
      }
      el.textContent = ('0' + Math.floor(current)).slice(-2);
    }, 16);
  });
}

var countObserver = new IntersectionObserver(function(entries){
  entries.forEach(function(e){
    if(e.isIntersecting && !e.target.dataset.countStarted){
      e.target.dataset.countStarted = 'true';
      if(!prefersReducedMotion) countUpNumbers();
    }
  });
}, { threshold:0.3 });

document.querySelectorAll('.how-grid').forEach(function(el){ countObserver.observe(el); });

// Parallax + continuous animation for knowledge cards
if(!prefersReducedMotion && window.innerWidth > 768){
  var lastScrollY = 0;
  window.addEventListener('scroll', function(){
    lastScrollY = window.scrollY;
    document.querySelectorAll('.kn-card.in').forEach(function(card, idx){
      var baseOffset = (idx % 7) * 1.5;  // Stagger by column
      var scrollOffset = (lastScrollY * 0.03 * baseOffset / 10);  // Subtle parallax
      var baseTransform = 'translateY(' + (scrollOffset + baseOffset) + 'px)';

      // Don't override if hovering (detected by scale)
      var currentTransform = card.style.transform;
      if(!currentTransform || !currentTransform.includes('scale')) {
        card.style.transform = baseTransform;
      }
    });
  }, { passive: true });
}

// Stats counter animation - trigger when scrolled into view
function animateStatsCounter(el, start, end, duration){
  var startTime = null;
  var animate = function(currentTime){
    if(!startTime) startTime = currentTime;
    var elapsed = currentTime - startTime;
    var progress = Math.min(elapsed / duration, 1);
    var value = Math.floor(start + (end - start) * progress);
    el.textContent = value;
    if(progress < 1) requestAnimationFrame(animate);
  };
  if(!prefersReducedMotion) requestAnimationFrame(animate);
  else el.textContent = end;
}

var statsObserver = new IntersectionObserver(function(entries){
  entries.forEach(function(e){
    if(e.isIntersecting && !e.target.dataset.statsCounted){
      e.target.dataset.statsCounted = 'true';
      document.querySelectorAll('[data-stat-end]').forEach(function(stat){
        var end = parseInt(stat.getAttribute('data-stat-end')) || 0;
        animateStatsCounter(stat, 0, end, 1500);
      });
    }
  });
}, { threshold:0.3 });

var statsEl = document.querySelector('.stats-strip');
if(statsEl) statsObserver.observe(statsEl);

// Scroll direction detection for staggered animations
var lastScrollPos = 0;
var scrollDirection = 'down';
window.addEventListener('scroll', function(){
  var currentScrollPos = window.scrollY;
  scrollDirection = currentScrollPos > lastScrollPos ? 'down' : 'up';
  lastScrollPos = currentScrollPos;
}, { passive:true });

// Apply scroll direction to reveal elements
if(!prefersReducedMotion){
  var directionObserver = new IntersectionObserver(function(entries){
    entries.forEach(function(e, idx){
      if(e.isIntersecting){
        var delay = idx * 40; // 40ms stagger
        setTimeout(function(){
          e.target.classList.add('in');
        }, delay);
        directionObserver.unobserve(e.target);
      }
    });
  }, { threshold:0.15, rootMargin:'0px 0px -30px 0px' });

  document.querySelectorAll('.reveal').forEach(function(el){
    directionObserver.observe(el);
  });
}

// Legal Knowledge magnetic attraction enhancement (works with floating animation)
if(!prefersReducedMotion){
  document.querySelectorAll('.kn-card').forEach(function(card){
    card.addEventListener('mousemove', function(e){
      if(!card.classList.contains('in')) return;
      var rect = card.getBoundingClientRect();
      var x = e.clientX - rect.left;
      var y = e.clientY - rect.top;
      var strength = 0.15;
      var moveX = (x - rect.width / 2) * strength / 50;
      var moveY = (y - rect.height / 2) * strength / 50;
      card.style.transform = 'translate(' + moveX + 'px, ' + (moveY - 12) + 'px) scale(1.05)';
    });
    card.addEventListener('mouseleave', function(){
      card.style.animation = 'floatCard 3s ease-in-out infinite';
      card.style.transform = '';
    });
  });
}

// Why Us icon hover animations
if(!prefersReducedMotion){
  document.querySelectorAll('.why-icon').forEach(function(icon){
    icon.addEventListener('mouseenter', function(){
      icon.style.animation = 'iconPulse .6s ease';
    });
  });
}

// How It Works - enhanced count-up for numbers
function countUpNumber(el, target, duration){
  var current = 0;
  var increment = target / (duration / 16);
  var timer = setInterval(function(){
    current += increment;
    if(current >= target){
      current = target;
      clearInterval(timer);
    }
    var formattedNum = ('0' + Math.floor(current)).slice(-2);
    el.textContent = formattedNum;
  }, 16);
}

var howGridObserver = new IntersectionObserver(function(entries){
  entries.forEach(function(e){
    if(e.isIntersecting && !e.target.dataset.howCounted){
      e.target.dataset.howCounted = 'true';
      document.querySelectorAll('.how-num').forEach(function(numEl){
        var num = parseInt(numEl.textContent);
        if(!isNaN(num) && !prefersReducedMotion){
          countUpNumber(numEl, num, 1200);
        }
      });
    }
  });
}, { threshold:0.3 });

var howGrid = document.querySelector('.how-grid');
if(howGrid) howGridObserver.observe(howGrid);

// Navbar logo shrink on scroll
var navLogo = document.querySelector('.nav-logo img');
if(navLogo){
  window.addEventListener('scroll', function(){
    if(window.scrollY > 80){
      navLogo.style.height = '46px';
    } else {
      navLogo.style.height = '60px';
    }
  });
}

// Rules section - card expand on hover to show summary
document.querySelectorAll('.rules-section .list-card').forEach(function(card){
  var originalHeight = card.offsetHeight;
  card.addEventListener('mouseenter', function(){
    if(!prefersReducedMotion){
      card.style.height = (originalHeight + 20) + 'px';
    }
  });
  card.addEventListener('mouseleave', function(){
    card.style.height = originalHeight + 'px';
  });
});

// Contact icons pulse in sequence
if(!prefersReducedMotion){
  var contactIcons = document.querySelectorAll('.contact-item .contact-ico');
  var pulseSequence = setInterval(function(){
    contactIcons.forEach(function(icon, idx){
      setTimeout(function(){
        icon.style.animation = 'pulseSequence 2.4s ease-out';
      }, idx * 300);
    });
  }, 2400 + (contactIcons.length * 300));
}

// Respect prefers-reduced-motion
if(prefersReducedMotion){
  document.documentElement.style.scrollBehavior = 'auto';
}

/* ================================================================
   CONVERSION LAYER — appended only, no existing code modified.
   All new elements are injected at runtime so the markup above
   stays untouched.
   ================================================================ */
(function(){
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- 16. STATS STRIP (activates the existing .stats-strip CSS) ---------- */
  var coursesSec = document.getElementById('courses');
  if(coursesSec){
    var cHead = coursesSec.querySelector('.section-head');
    if(cHead){
      /* PLACEHOLDER FIGURES — replace with your real numbers before going live */
      var STATS = [
        {n:5000, s:'+', l:'Students Enrolled'},
        {n:50,   s:'+', l:'Expert Courses'},
        {n:12,   s:'+', l:'Years of Excellence'},
        {n:94,   s:'%', l:'Success Rate'}
      ];
      var strip = document.createElement('div');
      strip.className = 'stats-strip';
      strip.innerHTML = STATS.map(function(o){
        return '<div class="stat-item">'+
               '<span class="stat-value" data-count-to="'+o.n+'" data-suffix="'+o.s+'">0</span>'+
               '<span class="stat-label">'+o.l+'</span></div>';
      }).join('');
      cHead.parentNode.insertBefore(strip, cHead.nextSibling);

      var statsIO = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
          if(!e.isIntersecting) return;
          statsIO.unobserve(e.target);
          e.target.querySelectorAll('[data-count-to]').forEach(function(el){
            var goal = parseInt(el.getAttribute('data-count-to'), 10) || 0;
            var suffix = el.getAttribute('data-suffix') || '';
            if(reduced){ el.textContent = goal.toLocaleString('en-IN') + suffix; return; }
            var t0 = null;
            function step(ts){
              if(t0 === null) t0 = ts;
              var p = Math.min((ts - t0) / 1600, 1);
              var eased = 1 - Math.pow(1 - p, 3);
              el.textContent = Math.floor(goal * eased).toLocaleString('en-IN') + suffix;
              if(p < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
          });
        });
      }, { threshold:0.3 });
      statsIO.observe(strip);
    }
  }

  /* ---------- 17. TESTIMONIAL CAROUSEL (activates the existing .testimonial-* CSS) ---------- */
  var enqSec = document.querySelector('.enquiry-section');
  if(enqSec){
    var eHead = enqSec.querySelector('.section-head');
    if(eHead){
      /* PLACEHOLDER TESTIMONIALS — replace with real, consented student quotes */
      var QUOTES = [
        {q:'The Judiciary preparation module gave me a clear structure I could actually follow. The Bare Acts library alone saved me months of hunting for material.', w:'Ananya S.', r:'Judicial Services Aspirant'},
        {q:'I started the CPC course with almost no litigation background. The way procedure was broken down order by order made it genuinely easy to retain.', w:'Rohit M.', r:'LL.B. 3-Year Programme'},
        {q:'The free notes convinced me to enrol in a paid course. Everything is exam-oriented rather than just theory, which is exactly what I needed.', w:'Fatima K.', r:'CLAT Crash Course'},
        {q:'Counsellors actually helped me pick the right programme instead of pushing the costliest one. The flexibility to study at my own pace mattered most.', w:'Vikram R.', r:'Corporate Law & CS Practice'}
      ];
      var car = document.createElement('div');
      car.className = 'testimonial-carousel';
      car.innerHTML =
        QUOTES.map(function(o,i){
          return '<div class="testimonial-item'+(i===0?' active':'')+'">'+
                 '<div class="testimonial-stars">★ ★ ★ ★ ★</div>'+
                 '<p class="testimonial-quote">“'+o.q+'”</p>'+
                 '<div class="testimonial-who">'+o.w+'<span>'+o.r+'</span></div></div>';
        }).join('') +
        '<div class="carousel-dots">'+
          QUOTES.map(function(o,i){ return '<span'+(i===0?' class="active"':'')+' data-slide="'+i+'"></span>'; }).join('')+
        '</div>';
      eHead.parentNode.insertBefore(car, eHead.nextSibling);

      var slides = car.querySelectorAll('.testimonial-item');
      var dots   = car.querySelectorAll('.carousel-dots span');
      var cur = 0, rot = null;
      function goTo(i){
        cur = (i + slides.length) % slides.length;
        slides.forEach(function(el,k){ el.classList.toggle('active', k === cur); });
        dots.forEach(function(d,k){ d.classList.toggle('active', k === cur); });
      }
      function play(){ if(reduced) return; pause(); rot = setInterval(function(){ goTo(cur + 1); }, 5200); }
      function pause(){ if(rot){ clearInterval(rot); rot = null; } }
      dots.forEach(function(d){
        d.addEventListener('click', function(){ goTo(parseInt(d.getAttribute('data-slide'),10)); play(); });
      });
      car.addEventListener('mouseenter', pause);
      car.addEventListener('mouseleave', play);
      play();
    }
  }

  /* ---------- 14. STICKY ENROLL BAR ---------- */
  var bar = document.createElement('div');
  bar.className = 'enroll-bar';
  bar.innerHTML =
    '<div class="enroll-bar-inner">'+
      '<div class="enroll-bar-text">🎓 <b>Admissions Open</b> — start your legal career with a structured programme</div>'+
      '<div class="enroll-bar-actions">'+
        '<a href="#courses" class="btn btn-gold">Enroll Now</a>'+
        '<a href="#contact" class="btn btn-ghost">Talk to a Counsellor</a>'+
        '<button class="enroll-bar-close" type="button" aria-label="Dismiss enrolment bar">&times;</button>'+
      '</div>'+
    '</div>';
  document.body.appendChild(bar);

  var barDismissed = false;
  bar.querySelector('.enroll-bar-close').addEventListener('click', function(){
    barDismissed = true;
    bar.classList.remove('show');
    document.body.classList.remove('enroll-bar-on');
  });

  /* ---------- 15. COUNSELLOR POPUP ---------- */
  var pop = document.createElement('div');
  pop.className = 'counsel-pop';
  pop.innerHTML =
    '<button class="counsel-close" type="button" aria-label="Close">&times;</button>'+
    '<h5>Not sure which course fits you?</h5>'+
    '<p>Talk to a counsellor for free guidance on choosing the right programme for your goals.</p>'+
    '<a href="#contact" class="btn btn-gold">Get Free Counselling →</a>';
  document.body.appendChild(pop);

  var popShown = false, popHideTimer = null;
  function popSeen(){
    try { return sessionStorage.getItem('counselSeen') === '1'; } catch(err){ return false; }
  }
  function markPopSeen(){
    try { sessionStorage.setItem('counselSeen','1'); } catch(err){ /* storage blocked — fine */ }
  }
  function showPop(){
    if(popShown || popSeen()) return;
    popShown = true;
    markPopSeen();
    pop.classList.add('show');
    popHideTimer = setTimeout(hidePop, 14000);
  }
  function hidePop(){
    pop.classList.remove('show');
    if(popHideTimer){ clearTimeout(popHideTimer); popHideTimer = null; }
  }
  pop.querySelector('.counsel-close').addEventListener('click', hidePop);
  pop.querySelector('.btn').addEventListener('click', hidePop);
  document.addEventListener('mouseleave', function(e){ if(e.clientY <= 0) showPop(); });

  /* ---------- 20. PROGRESS RING -> ENROLL CTA ---------- */
  var pw = document.getElementById('progressWrap');
  if(pw){
    var hit = document.createElement('a');
    hit.className = 'pw-cta-hit';
    hit.href = '#';
    hit.setAttribute('aria-label','Jump to course enquiry');
    hit.addEventListener('click', function(ev){
      ev.preventDefault();
      ev.stopPropagation(); // keeps the existing back-to-top handler from firing
      var t = document.querySelector('.enquiry-section');
      if(t) t.scrollIntoView({ behavior: reduced ? 'auto' : 'smooth', block:'start' });
    });
    pw.appendChild(hit);
  }

  /* ---------- Shared scroll driver for 14 / 15 / 20 ---------- */
  var contactSec = document.getElementById('contact');
  function onScroll(){
    var vh = window.innerHeight;

    // 14 — show once the courses section is behind you, hide at contact
    var showBar = false;
    if(!barDismissed && coursesSec){
      var pastCourses = coursesSec.getBoundingClientRect().bottom < vh * 0.55;
      var reachedContact = contactSec ? (contactSec.getBoundingClientRect().top < vh * 0.78) : false;
      showBar = pastCourses && !reachedContact;
    }
    bar.classList.toggle('show', showBar);
    document.body.classList.toggle('enroll-bar-on', showBar);

    // 15 — fire at ~60% page depth
    var scrollable = document.documentElement.scrollHeight - vh;
    var depth = scrollable > 0 ? window.scrollY / scrollable : 0;
    if(depth >= 0.6) showPop();

    // 20 — ring becomes an Enroll CTA past 70%, but only when the bar isn't already showing
    if(pw) pw.classList.toggle('cta-mode', depth > 0.7 && !showBar);
  }
  window.addEventListener('scroll', onScroll, { passive:true });
  window.addEventListener('resize', onScroll, { passive:true });
  onScroll();

  /* ---------- 18. IDLE WHATSAPP EXPANSION ---------- */
  var wa = document.querySelector('.wa-float');
  if(wa && !reduced){
    var waLabel = document.createElement('span');
    waLabel.className = 'wa-label';
    waLabel.textContent = 'Chat with a counsellor';
    wa.appendChild(waLabel);

    var idleTimer = null, collapseTimer = null;
    function resetIdle(){
      clearTimeout(idleTimer); clearTimeout(collapseTimer);
      wa.classList.remove('expanded');
      idleTimer = setTimeout(function(){
        wa.classList.add('expanded');
        collapseTimer = setTimeout(function(){ wa.classList.remove('expanded'); }, 6000);
      }, 15000);
    }
    ['scroll','mousemove','keydown','touchstart','click'].forEach(function(evt){
      window.addEventListener(evt, resetIdle, { passive:true });
    });
    resetIdle();
  }

  /* ---------- 19. SMART FORM NUDGE ---------- */
  if(!reduced){
    document.querySelectorAll('form.form-card').forEach(function(form){
      var submitBtn = form.querySelector('button[type="submit"]');
      if(!submitBtn) return;
      form.addEventListener('input', function(){
        var filled = 0;
        form.querySelectorAll('input, select, textarea').forEach(function(f){
          if(f.type === 'file') return;
          if(f.value && f.value.trim() !== '') filled++;
        });
        submitBtn.classList.toggle('btn-nudge', filled >= 2);
      });
    });
  }
})();

/* ================================================================
   MOTION LAYER — appended only.
   Five systems want to transform the same 9 cards, and the existing
   3D-tilt handler already owns .course-card's inline transform, so
   every card gets an injected .cc-stage wrapper and a single
   compositor merges the channels into one transform string.
   ================================================================ */
(function(){
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var grid = document.querySelector('.course-grid');
  if(!grid) return;
  var cards = Array.prototype.slice.call(grid.querySelectorAll(':scope > .course-card'));
  if(!cards.length) return;

  function esc(s){
    return String(s).replace(/[&<>"']/g, function(m){
      return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
    });
  }

  /* ---------- Read card data before we touch the DOM (for the ticker) ---------- */
  var tickData = cards.map(function(c){
    var t = c.querySelector('h3'), p = c.querySelector('.course-price');
    return { t: t ? t.textContent.trim() : '', p: p ? p.textContent.trim() : '' };
  });

  /* ---------- Wrap every card in a stage ---------- */
  var stages = cards.map(function(card){
    var st = document.createElement('div');
    st.className = 'cc-stage';
    card.parentNode.insertBefore(st, card);
    st.appendChild(card);

    var badge = document.createElement('span');
    badge.className = 'hot-badge';
    badge.textContent = '🔥 Most Enrolled';
    st.appendChild(badge);

    var ptr = document.createElement('i');
    ptr.className = 'hint-ptr';
    ptr.setAttribute('aria-hidden','true');
    st.appendChild(ptr);
    return st;
  });

  /* ---------- Transform compositor ---------- */
  var ch = stages.map(function(){ return { deal:'', flip:'', flow:'', skew:'', repel:'' }; });
  function paint(i){
    var c = ch[i];
    stages[i].style.transform = [c.deal, c.flip, c.flow, c.skew, c.repel]
      .filter(Boolean).join(' ');
  }

  var inView = false, paused = false, flipping = false;
  var desktop = window.innerWidth > 768;
  window.addEventListener('resize', function(){ desktop = window.innerWidth > 768; }, { passive:true });

  new IntersectionObserver(function(es){
    es.forEach(function(e){
      inView = e.isIntersecting;
      if(inView) startLoop(); else stopLoop();
    });
  }, { threshold:0.05 }).observe(grid);

  /* ---------- 12. Split the trailing arrow out of "Explore Course →" ---------- */
  cards.forEach(function(c){
    var l = c.querySelector('.course-link');
    if(l && l.textContent.indexOf('→') > -1){
      l.innerHTML = esc(l.textContent.replace(/\s*→\s*$/,'')) + ' <span class="cl-arrow">→</span>';
    }
  });

  /* ---------- Make the cards actually clickable ----------
     The markup ships them as <article> with a <span> "link", so nothing
     was reachable. Route a card click to the course enquiry form. */
  function goEnquire(){
    var t = document.querySelector('.enquiry-section');
    if(t) t.scrollIntoView({ behavior: reduced ? 'auto' : 'smooth', block:'start' });
  }

  /* ---------- 13. Click ripple ---------- */
  function ripple(e, host){
    if(reduced) return;
    var r = host.getBoundingClientRect();
    var d = document.createElement('span');
    d.className = 'ripple-dot';
    d.style.left = (e.clientX - r.left) + 'px';
    d.style.top  = (e.clientY - r.top)  + 'px';
    host.appendChild(d);
    setTimeout(function(){ if(d.parentNode) d.parentNode.removeChild(d); }, 660);
  }
  cards.forEach(function(c){
    c.addEventListener('click', function(e){ ripple(e, c); setTimeout(goEnquire, 160); });
  });
  document.querySelectorAll('.btn-gold').forEach(function(b){
    b.addEventListener('click', function(e){ ripple(e, b); });
  });

  /* ---------- 1. Deal-the-deck entrance ---------- */
  var dealt = false;
  function deal(){
    if(dealt) return;
    dealt = true;
    if(reduced){ setTimeout(startCycle, 400); return; }

    var g = grid.getBoundingClientRect();
    var gcx = g.left + g.width / 2, gcy = g.top + g.height / 2;
    var rects = stages.map(function(s){ return s.getBoundingClientRect(); });

    stages.forEach(function(s, i){
      var r = rects[i];
      var dx = gcx - (r.left + r.width / 2);
      var dy = gcy - (r.top + r.height / 2);
      s.style.transition = 'none';
      ch[i].deal = 'translate(' + dx.toFixed(1) + 'px,' + dy.toFixed(1) + 'px) rotate(' +
                   ((i % 2 ? 1 : -1) * (5 + i)) + 'deg) scale(.84)';
      paint(i);
    });
    void grid.offsetWidth; // force the deck state to commit

    stages.forEach(function(s, i){
      setTimeout(function(){
        s.style.transition = 'transform .85s cubic-bezier(.22,1,.36,1)';
        ch[i].deal = '';
        paint(i);
        setTimeout(function(){ s.style.transition = ''; }, 900);
      }, i * 85);
    });
    setTimeout(startCycle, stages.length * 85 + 1800);
  }
  var dealIO = new IntersectionObserver(function(es){
    es.forEach(function(e){ if(e.isIntersecting){ deal(); dealIO.disconnect(); } });
  }, { threshold:0.12 });
  dealIO.observe(grid);

  /* ---------- 2 + 3. Featured promotion, FLIP-animated ----------
     Giving one stage grid-column:span 2 reflows the whole grid, so the
     FLIP that animates that reflow IS the auto-shuffle. One system,
     both behaviours, and it pauses the moment a cursor enters. */
  var featIdx = -1, featTimer = null;
  function promote(next){
    var firsts = stages.map(function(s){ return s.getBoundingClientRect(); });
    stages.forEach(function(s){ s.classList.remove('featured'); });
    if(next >= 0) stages[next].classList.add('featured');
    var lasts = stages.map(function(s){ return s.getBoundingClientRect(); });

    flipping = true;
    stages.forEach(function(s, i){
      var dx = firsts[i].left - lasts[i].left;
      var dy = firsts[i].top  - lasts[i].top;
      s.style.transition = 'none';
      ch[i].flip = (dx || dy)
        ? 'translate(' + dx.toFixed(1) + 'px,' + dy.toFixed(1) + 'px)'
        : '';
      paint(i);
    });
    void grid.offsetWidth;

    stages.forEach(function(s, i){
      s.style.transition = 'transform .7s cubic-bezier(.22,1,.36,1), opacity .35s ease, filter .35s ease';
      ch[i].flip = '';
      paint(i);
    });
    setTimeout(function(){
      flipping = false;
      stages.forEach(function(s){ s.style.transition = ''; });
    }, 720);
    featIdx = next;
  }
  function startCycle(){
    if(reduced) return;
    stopCycle();
    featTimer = setInterval(function(){
      if(!inView || paused || flipping) return;
      promote((featIdx + 1) % stages.length);
    }, 4600);
  }
  function stopCycle(){ if(featTimer){ clearInterval(featTimer); featTimer = null; } }

  /* ---------- 8 + 9. Traveling ring and pointer hint ---------- */
  var ringIdx = -1;
  function clearRing(){ stages.forEach(function(s){ s.classList.remove('ring-focus'); }); }
  if(!reduced){
    setInterval(function(){
      if(!inView || paused) return;
      clearRing();
      ringIdx = (ringIdx + 1) % stages.length;
      var s = stages[ringIdx];
      var p = s.querySelector('.hint-ptr');
      if(p){ p.style.animation = 'none'; void p.offsetWidth; p.style.animation = ''; }
      s.classList.add('ring-focus');
    }, 3000);
  }

  /* ---------- 10. Spotlight dimming (and it pauses everything else) ---------- */
  var hoverCapable = window.matchMedia('(hover:hover)').matches;
  if(!reduced && hoverCapable){
    stages.forEach(function(s){
      s.addEventListener('mouseenter', function(){
        grid.classList.add('spotlight');
        stages.forEach(function(o){ o.classList.remove('spot'); });
        s.classList.add('spot');
      });
    });
  }
  grid.addEventListener('mouseenter', function(){ paused = true; clearRing(); });
  grid.addEventListener('mouseleave', function(){
    paused = false;
    grid.classList.remove('spotlight');
    stages.forEach(function(o){ o.classList.remove('spot'); });
  });
  grid.addEventListener('touchstart', function(){ paused = true; }, { passive:true });

  /* ---------- 4 + 5 + 7. Continuous channels: skew, coverflow, repel ---------- */
  var vel = 0, lastSY = window.scrollY, mx = null, my = null;
  window.addEventListener('scroll', function(){
    var y = window.scrollY;
    vel = Math.max(-70, Math.min(70, y - lastSY));
    lastSY = y;
  }, { passive:true });
  grid.addEventListener('mousemove', function(e){ mx = e.clientX; my = e.clientY; });
  grid.addEventListener('mouseleave', function(){ mx = null; my = null; });

  var rafId = null;
  function startLoop(){
    if(rafId === null && !reduced) rafId = requestAnimationFrame(frame);
  }
  function stopLoop(){
    if(rafId !== null){ cancelAnimationFrame(rafId); rafId = null; }
    stages.forEach(function(s, i){        // settle flat so nothing is left skewed
      ch[i].flow = ''; ch[i].skew = ''; ch[i].repel = '';
      paint(i);
    });
  }

  function frame(){
    rafId = requestAnimationFrame(frame);
    if(reduced || !inView || flipping || !desktop){ vel *= 0.85; return; }

    // read phase
    var rects = stages.map(function(s){ return s.getBoundingClientRect(); });
    var halfVW = window.innerWidth / 2;
    vel *= 0.88;
    var sk = Math.max(-2.2, Math.min(2.2, vel * 0.05));

    // write phase
    stages.forEach(function(s, i){
      var r = rects[i];
      var cx = r.left + r.width / 2, cy = r.top + r.height / 2;

      ch[i].flow = 'rotateY(' + (((cx - halfVW) / halfVW) * -5.5).toFixed(2) + 'deg)';   // 5
      ch[i].skew = Math.abs(sk) > 0.02 ? 'skewY(' + sk.toFixed(2) + 'deg)' : '';          // 4

      var rp = '';                                                                        // 7
      if(mx !== null){
        var dx = cx - mx, dy = cy - my, d = Math.sqrt(dx * dx + dy * dy);
        if(d < 250 && d > 0.1){
          var f = (1 - d / 250) * 15;
          rp = 'translate(' + ((dx / d) * f).toFixed(1) + 'px,' + ((dy / d) * f).toFixed(1) + 'px)';
        }
      }
      ch[i].repel = rp;
      paint(i);
    });
  }

  /* ---------- 6. Infinite course ticker ---------- */
  var row = tickData.map(function(o){
    return '<span class="tick-item"><b>' + esc(o.t) + '</b><i>' + esc(o.p) + '</i><u>Enroll →</u></span>';
  }).join('');
  var tick = document.createElement('div');
  tick.className = 'course-ticker';
  var track = document.createElement('div');
  track.className = 'acts-ticker';
  track.innerHTML = row + row;   // duplicated so the loop is seamless
  tick.appendChild(track);
  if(grid.nextSibling) grid.parentNode.insertBefore(tick, grid.nextSibling);
  else grid.parentNode.appendChild(tick);
  tick.addEventListener('click', function(e){
    if(e.target.closest('.tick-item')) goEnquire();
  });
})();

/* ================================================================
   FOOTER ENHANCEMENT — swap the text-glyph social marks for real
   brand icons. Matched on the existing title attribute, so the
   markup above is untouched and an unknown title just keeps its glyph.
   ================================================================ */
(function(){
  var P = {
    Facebook:'<path d="M13.5 21v-8h2.7l.4-3.1h-3.1V7.9c0-.9.25-1.5 1.55-1.5h1.65V3.62c-.29-.04-1.27-.12-2.42-.12-2.4 0-4.04 1.46-4.04 4.15V9.9H7.5V13h2.74v8z"/>',
    Twitter:'<path d="M17.53 3h2.9l-6.33 7.23L21.5 21h-5.6l-4.38-5.73L6.5 21H3.6l6.77-7.73L3 3h5.74l3.96 5.24zm-1.02 16.2h1.6L7.56 4.7H5.83z"/>',
    Instagram:'<g fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><circle cx="12" cy="12" r="4.1"/></g><circle cx="17.1" cy="6.9" r="1.25"/>',
    LinkedIn:'<path d="M6.94 5.01a1.94 1.94 0 1 1-3.88 0 1.94 1.94 0 0 1 3.88 0M3.3 21h3.4V8.5H3.3zM9.2 8.5h3.26v1.72h.05c.45-.86 1.56-1.77 3.22-1.77 3.44 0 4.08 2.26 4.08 5.21V21h-3.4v-5.65c0-1.35-.03-3.09-1.88-3.09-1.89 0-2.17 1.47-2.17 2.99V21H9.2z"/>',
    YouTube:'<path d="M21.6 7.2s-.2-1.4-.8-2c-.76-.8-1.6-.8-2-.85C16 4.2 12 4.2 12 4.2h-.01s-4 0-6.79.15c-.4.05-1.24.05-2 .85-.6.6-.8 2-.8 2S2.2 8.85 2.2 10.5v1.55c0 1.65.2 3.3.2 3.3s.2 1.4.8 2c.76.8 1.76.77 2.2.86 1.6.15 6.8.2 6.8.2s4 0 6.8-.16c.4-.05 1.24-.05 2-.85.6-.6.8-2 .8-2s.2-1.65.2-3.3V10.5c0-1.65-.2-3.3-.2-3.3M9.95 14.35V8.6l5.15 2.89z"/>',
    WhatsApp:'<path d="M17.47 14.38c-.3-.15-1.75-.86-2.02-.96-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.64.07-.3-.15-1.25-.46-2.38-1.47-.88-.78-1.47-1.75-1.64-2.05-.17-.3-.02-.46.13-.6.14-.14.3-.35.45-.52.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.67-1.6-.92-2.19-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.08-.79.38-.27.3-1.04 1.01-1.04 2.47s1.06 2.86 1.21 3.06c.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.69.63.71.22 1.36.19 1.87.12.57-.09 1.75-.72 2-1.41.25-.69.25-1.28.17-1.41-.07-.13-.27-.2-.57-.35M12.05 21.8a9.8 9.8 0 0 1-5-1.37l-.36-.21-3.71.97.99-3.62-.24-.38a9.82 9.82 0 0 1-1.5-5.22c0-5.42 4.42-9.83 9.83-9.83a9.77 9.77 0 0 1 6.95 2.88 9.74 9.74 0 0 1 2.88 6.96c0 5.41-4.41 9.82-9.83 9.82m8.36-18.19A11.72 11.72 0 0 0 12.05 0C5.6 0 .35 5.25.35 11.7c0 2.06.54 4.07 1.56 5.85L.25 24l6.6-1.73a11.68 11.68 0 0 0 5.19 1.24c6.45 0 11.7-5.25 11.7-11.7 0-3.13-1.22-6.07-3.43-8.28"/>'
  };
  document.querySelectorAll('.social-row a').forEach(function(a){
    var key = a.getAttribute('title');
    if(!key || !P[key]) return;              // unknown network keeps its glyph
    a.setAttribute('aria-label', key);
    a.innerHTML = '<svg viewBox="0 0 24 24" aria-hidden="true">' + P[key] + '</svg>';
  });
})();

/* ================================================================
   CTA MARK LAYER — appended only, no existing handler modified.
   Rings the section "View All" button while its section is on
   screen, the way the courses grid rings a card. Cards untouched.
   ================================================================ */
(function(){
  var reduced = window.matchMedia('(prefers-reduced-motion:reduce)').matches;
  if(reduced) return;

  var SECTIONS = ['.notes-section','.acts-section','.rules-section','.exams-section','.updates-section'];

  SECTIONS.forEach(function(sel){
    var section = document.querySelector(sel);
    if(!section) return;

    var wrap = section.querySelector('.section-cta');
    var btn  = wrap && wrap.querySelector('.btn');

    /* stops: every card's "View All →", then the section button last */
    var stops = [].slice.call(section.querySelectorAll('.list-card .list-meta .go'));
    if(btn) stops.push(btn);
    if(!stops.length) return;

    var ptr = null;
    if(wrap){
      ptr = document.createElement('i');
      ptr.className = 'cta-ptr';
      ptr.setAttribute('aria-hidden','true');
      wrap.appendChild(ptr);
    }

    var idx = -1, inView = false, paused = false, timer = null;

    function clear(){
      stops.forEach(function(el){ el.classList.remove('cta-mark'); });
      if(wrap) wrap.classList.remove('cta-mark-on');
    }
    function step(){
      if(!inView || paused) return;
      clear();
      idx = (idx + 1) % stops.length;
      var el = stops[idx];
      el.classList.add('cta-mark');
      /* the pointer only rides the section button, not the small links */
      if(ptr && el === btn){
        ptr.style.animation = 'none'; void ptr.offsetWidth; ptr.style.animation = '';
        wrap.classList.add('cta-mark-on');
      }
    }

    /* pause only over an actual click target, not the whole section —
       otherwise reading the list stops the marker entirely */
    var hoverTargets = [].slice.call(section.querySelectorAll('.list-card'));
    if(btn) hoverTargets.push(btn);
    hoverTargets.forEach(function(t){
      t.addEventListener('mouseenter', function(){ paused = true; clear(); });
      t.addEventListener('mouseleave', function(){ paused = false; });
    });

    new IntersectionObserver(function(entries){
      inView = entries[0].isIntersecting;
      if(inView){
        if(!timer){ step(); timer = setInterval(step, 2400); }
      } else if(timer){
        clearInterval(timer); timer = null; clear();
      }
    }, { threshold:0.15 }).observe(section);
  });
})();

/* ---- text shine fix: same !important cascade issue as bg-position ---- */
(function(){
  var grad = 'linear-gradient(135deg,#f7e9b4 0%,#d4af37 42%,#f0d97d 70%,#b8952e 100%)';
  var DUR = 7000;
  var els = [];
  [
    '.kn-section .section-title',
    '.how-section .section-title',
    '.site-footer .footer-tag',
    '.site-footer .footer-col h4'
  ].forEach(function(sel){
    document.querySelectorAll(sel).forEach(function(el){
      el.style.setProperty('background-image', grad, 'important');
      el.style.setProperty('background-size', '220% auto', 'important');
      el.style.setProperty('-webkit-background-clip', 'text', 'important');
      el.style.setProperty('background-clip', 'text', 'important');
      el.style.setProperty('-webkit-text-fill-color', 'transparent', 'important');
      el.style.setProperty('color', 'transparent', 'important');
      els.push(el);
    });
  });
  var start = Date.now();
  setInterval(function(){
    var e = (Date.now() - start) % DUR;
    var p = (-220 + (e / DUR) * 440).toFixed(1);
    els.forEach(function(el){
      el.style.setProperty('background-position', p + '% center', 'important');
    });
  }, 50);
})();

/* ---- hero-style heroShift for kn-section, how-section, site-footer ---- */
(function(){
  var grad = 'linear-gradient(125deg,#0d0b08 0%,#1c1913 32%,#3a3120 58%,#1c1913 80%,#0d0b08 100%)';
  var DUR = 22000;
  var HALF = DUR / 2;
  var TICK = 50;
  ['.kn-section','.how-section','.site-footer'].forEach(function(sel){
    var el = document.querySelector(sel);
    if(!el) return;
    el.style.setProperty('background-image', grad, 'important');
    el.style.setProperty('background-size', '320% 320%', 'important');
    var start = Date.now();
    function tick(){
      var e = (Date.now() - start) % DUR;
      var p = e < HALF ? (e / HALF) : (2 - e / HALF);
      el.style.setProperty('background-position', (p * 100).toFixed(1) + '% 50%', 'important');
    }
    tick();
    setInterval(tick, TICK);
  });
})();
