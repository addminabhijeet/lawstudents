/* Announcements page fixes. Loaded at the end of the page; only adds behaviour. */
(function(){
  'use strict';
  var list = document.querySelector('#site-info .list-grid');
  if(!list) return;
  Array.prototype.slice.call(list.querySelectorAll('a.list-card')).forEach(function(a){
    var h = a.querySelector('h4');
    if(!h) return;

    /* headings in order: the list's heading is an h2, the items were h4 */
    h.setAttribute('aria-level', '3');

    /* each item opens its page already searched for it (deeplink.js reads ?q=),
       instead of the whole collection. The search matches every word, so the
       query is the title up to its " - " summary, without a cut-off last word. */
    var href = a.getAttribute('href') || '';
    if(!href || href.indexOf('?') > -1) return;
    var t = h.textContent.replace(/\s+/g, ' ').trim(), cut = t.indexOf(' - '), q;
    if(cut >= 8) q = t.slice(0, cut);
    else if(/…$/.test(t)) q = t.replace(/…$/, '').split(' ').slice(0, -1).join(' ');
    else q = t;
    if(q) a.setAttribute('href', href + '?q=' + encodeURIComponent(q));
  });
})();
