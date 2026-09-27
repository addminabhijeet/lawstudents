/* Listing pages (acts, rules, notes, exams, courses, legal knowledge): a link with
   ?q=<words> opens the page already searched for them, using the page's own quick
   search box, and scrolls to the results. The home page's cards link this way.
   No existing script is edited. */
(function(){
  'use strict';
  var q;
  try { q = new URLSearchParams(location.search).get('q'); } catch(err){ return; }
  if(!q) return;
  function run(){
    var root = document.querySelector('[data-filter]'), input = root && root.querySelector('input[type="search"]');
    if(!input) return;
    input.value = q;
    input.dispatchEvent(new Event('input', { bubbles: true }));   // inner.js filters on this
    /* nothing matched (e.g. the item is no longer listed): show the whole list instead */
    var none = root.querySelector('.res-none');
    if(none && !none.hidden){
      input.value = '';
      input.dispatchEvent(new Event('input', { bubbles: true }));
      return;
    }
    /* bring the results up under the sticky header */
    var header = document.getElementById('siteHeader');
    window.scrollTo({ top: Math.max(root.getBoundingClientRect().top + window.scrollY - 16, 0), behavior: 'instant' });
    var cover = header ? Math.max(header.getBoundingClientRect().bottom, 0) : 0;   // the header once it has stuck
    if(cover) window.scrollTo({ top: Math.max(window.scrollY - cover, 0), behavior: 'instant' });
  }
  /* after inner.js has set the filters up (it listens for the same event, earlier) */
  if(document.readyState === 'loading') document.addEventListener('DOMContentLoaded', run);
  else run();
})();
