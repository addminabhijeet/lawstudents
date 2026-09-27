/* Home page, calm mode. Loaded right BEFORE home.js; home-after.js undoes the
   two switches below once home.js has run. No existing script is edited.

   home.js already has a calm branch for visitors who ask their device for
   reduced motion: no 3D tilt, magnetic buttons, second cursor, price count-up,
   card reshuffle, travelling ring, spotlight, skew / coverflow, ripples,
   pulsing icons, ringing "View All" buttons, idle WhatsApp label or form
   nudge. Most readers here are 60+, so the home page now always takes that
   branch. Stylesheets are not affected: CSS still sees the visitor's real
   setting. */
(function(w){
  'use strict';
  var REDUCE = /prefers-reduced-motion\s*:\s*reduce/i;
  var realMatchMedia = w.matchMedia, realSetInterval = w.setInterval;
  w.__homeCalm = { matchMedia: realMatchMedia, setInterval: realSetInterval };

  /* 1. while home.js loads, "reduced motion?" answers yes */
  if(realMatchMedia){
    w.matchMedia = function(query){
      if(REDUCE.test(String(query))){
        return {
          matches: true, media: String(query), onchange: null,
          addListener: function(){}, removeListener: function(){},
          addEventListener: function(){}, removeEventListener: function(){},
          dispatchEvent: function(){ return false; }
        };
      }
      return realMatchMedia.apply(w, arguments);
    };
  }

  /* 2. the endless background / heading shimmer timers are not started.
     home.js (twice) and inner.js each run one every 50ms that only moves a
     background-position, and they ignore reduced motion. Until the page has
     loaded, an interval whose job is that is skipped; anything else starts
     as normal. */
  w.setInterval = function(fn){
    if(typeof fn === 'function' && /background-position/.test(Function.prototype.toString.call(fn))) return 0;
    return realSetInterval.apply(w, arguments);
  };
  w.addEventListener('load', function(){
    setTimeout(function(){ w.setInterval = realSetInterval; }, 0);
  });
})(window);
