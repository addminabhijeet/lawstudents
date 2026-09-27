/* About page fixes. Loaded at the end of the About content, before the photos
   below the fold start loading. Only adds behaviour; no existing script is
   edited. Styles are in about.css. */
(function(){
  'use strict';

  /* 1. light photos: the PNGs were 120–550KB each for 210–460px images; the WebP
     copies next to them are 9–28KB. Falls back to the PNG if WebP fails to load.
     (The first photo already had a WebP source.) */
  var HEAVY = /\/images\/about\/(about-inner-img[12]|team-inner[1-4])\.png(\?[^#]*)?$/;
  Array.prototype.forEach.call(document.querySelectorAll('main img'), function(img){
    var png = img.getAttribute('src');
    if(!png || !HEAVY.test(png)) return;
    img.addEventListener('error', function back(){ img.removeEventListener('error', back); img.src = png; });
    img.src = png.replace(/\.png(\?[^#]*)?$/, '.webp');
  });

  /* 2. the first button said "Enroll Now" but opens the course list */
  var courses = document.querySelector('#about .copy > .btn');
  if(courses && /enroll now/i.test(courses.textContent)) courses.textContent = 'Explore Our Courses';

  /* 3. team photos: the name and role are printed right under each one, so the
     image itself is decoration (applies once the section is shown again) */
  Array.prototype.forEach.call(document.querySelectorAll('.team-card img'), function(img){ img.alt = ''; });
})();
