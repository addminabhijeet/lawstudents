/* Gallery page fixes. Loaded right after the gallery and its photo viewer, before
   the album covers start loading. Only adds behaviour; no existing script is
   edited. Styles are in gallery.css. */
(function(){
  'use strict';
  var d = document, sec = d.getElementById('gallery');
  if(!sec) return;
  function $$(s, c){ return Array.prototype.slice.call((c || d).querySelectorAll(s)); }

  /* ---------- 1. the description no longer promises campus and event photos ---------- */
  var meta = d.querySelector('meta[name="description"]');
  if(meta) meta.setAttribute('content', 'Law Students gallery: albums for the moot court competition, convocation day, guest lecture series and campus life.');

  /* ---------- 2. the albums come first, straight under the page title ---------- */
  var hero = sec.parentNode && sec.parentNode.querySelector(':scope > .page-hero');
  if(hero && hero.nextElementSibling !== sec) sec.parentNode.insertBefore(sec, hero.nextElementSibling);

  /* ---------- 3. light photos ----------
     The covers and the viewer used 200–270KB PNGs for ~520×280 pictures. Where
     `php artisan images:webp gallery` has written a WebP copy (listed in
     #gallery-webp), the page uses it, and falls back to the original on error. */
  var copies = {}, original = {};
  try { JSON.parse((d.getElementById('gallery-webp') || {}).textContent || '[]').forEach(function(p){ copies[p] = 1; }); } catch(err){}
  function light(url){
    var key = (String(url).split('/storage/app/public/')[1] || '').split('?')[0];
    if(!key || !copies[key]) return url;
    var webp = url.replace(/\.(png|jpe?g)(\?[^#]*)?$/i, '.webp');
    original[webp] = url;
    return webp;
  }
  $$('.album', sec).forEach(function(album){
    var imgs = (album.getAttribute('data-imgs') || '').split('|').filter(Boolean);
    if(imgs.length) album.setAttribute('data-imgs', imgs.map(light).join('|'));   // inner.js reads it on click
    if(album.getAttribute('href')) album.setAttribute('href', light(album.getAttribute('href')));
    $$('img', album).forEach(function(img){
      var src = img.getAttribute('src'), webp = light(src);
      /* 4. the album name is printed right under the cover */
      img.alt = '';
      if(webp === src) return;
      img.addEventListener('error', function back(){ img.removeEventListener('error', back); img.src = src; });
      img.src = webp;
    });
    /* 5. album titles skipped from h2 to h4 */
    var title = album.querySelector('.album-body h4');
    if(title) title.setAttribute('aria-level', '3');
  });

  var lb = d.getElementById('lightbox'), lbImg = lb && lb.querySelector('img');
  if(!lb || !lbImg) return;
  lbImg.addEventListener('error', function(){
    var back = original[lbImg.getAttribute('src')];
    if(back) lbImg.src = back;
  });

  /* ---------- 6. swipe between photos on touch screens ----------
     The viewer only had its arrow buttons; a sideways swipe presses them. */
  var x0 = null, y0 = 0;
  lb.addEventListener('touchstart', function(e){
    if(e.touches.length !== 1){ x0 = null; return; }
    x0 = e.touches[0].clientX; y0 = e.touches[0].clientY;
  }, { passive: true });
  lb.addEventListener('touchend', function(e){
    if(x0 === null) return;
    var t = e.changedTouches[0], dx = t.clientX - x0, dy = t.clientY - y0;
    x0 = null;
    if(Math.abs(dx) < 40 || Math.abs(dx) < Math.abs(dy) * 1.5) return;
    var btn = lb.querySelector(dx < 0 ? '.lb-next' : '.lb-prev');
    if(btn && !btn.hidden) btn.click();
  }, { passive: true });
})();
