/* Form input guard: stops what a field cannot hold from being typed into it.
   Phone: digits only, at most 10 ("+91 98765 43210" pasted becomes 9876543210).
   Email: one @, no spaces or characters an address cannot hold.
   Names and city: letters, spaces and . ' - only.
   PIN code, Aadhaar, PAN, year and percentage keep their own shapes.
   Each field is recognised by its type, name and autocomplete, through listeners on
   the document, so every form on the page is covered, including forms added later.
   Nothing on the page is replaced: fields that already run their own inline checks
   (oninput / onkey… attributes) are left to them, and data-no-guard opts a field out. */
(function (w, d) {
  'use strict';
  if (w.__formGuard) return;
  w.__formGuard = true;

  /* Letters of any script where the browser can match them (names are not only A–Z). */
  var L = (function () {
    try { new RegExp('\\p{L}', 'u'); return { set: '\\p{L}\\p{M}', flags: 'u' }; }
    catch (e) { return { set: 'A-Za-z\\u00C0-\\u024F\\u0900-\\u097F', flags: '' }; }
  })();
  var NOT_NAME = new RegExp("[^" + L.set + " .'-]", 'g' + L.flags),
      HAS_LETTER = new RegExp('[' + L.set + ']', L.flags);

  function digits(v) { return v.replace(/\D/g, ''); }

  function cleanPhone(v) {
    /* "+91 98765 43210", "098765 43210", "98765-43210": the 10 digits after the prefix */
    var s = v.replace(/[\s\-().]/g, ''), m = s.match(/^(?:\+?91|0)(\d{10})$/);
    return (m ? m[1] : digits(s)).replace(/^0+/, '').slice(0, 10);
  }

  function cleanEmail(v) {
    v = v.replace(/[^A-Za-z0-9._%+\-@]/g, '');                 // no spaces or symbols
    var at = v.indexOf('@');
    if (at > -1) {
      /* one @; after it only letters, digits, dots and hyphens */
      v = v.slice(0, at).slice(0, 64) + '@' + v.slice(at + 1).replace(/[^A-Za-z0-9.\-]/g, '');
    }
    return v.replace(/\.{2,}/g, '.').replace(/^[.@]+/, '');     // no "..", no leading . or @
  }

  function cleanName(v) {
    return v.replace(NOT_NAME, '')
      .replace(/^[\s.'-]+/, '')            // starts with a letter
      .replace(/\s{2,}/g, ' ')             // one space between words
      .replace(/([.'-])\1+/g, '$1');       // no ".." or "--"
  }

  function cleanPan(v) {
    /* ABCDE1234F: five letters, four digits, one letter */
    var s = v.toUpperCase().replace(/[^A-Z0-9]/g, ''), out = '';
    for (var i = 0; i < s.length && out.length < 10; i++) {
      var p = out.length;
      if ((p < 5 || p === 9) ? /[A-Z]/.test(s[i]) : /\d/.test(s[i])) out += s[i];
    }
    return out;
  }

  function cleanPercent(v) {
    var s = v.replace(/[^\d.]/g, ''), i = s.indexOf('.');
    if (i > -1) s = s.slice(0, i + 1) + s.slice(i + 1).replace(/\./g, '').slice(0, 2);
    while (s && parseFloat(s) > 100) s = s.slice(0, -1);
    return s;
  }

  var EMAIL_OK = /^[A-Za-z0-9_%+\-]+(\.[A-Za-z0-9_%+\-]+)*@([A-Za-z0-9]([A-Za-z0-9\-]*[A-Za-z0-9])?\.)+[A-Za-z]{2,}$/;

  /* clean: the value with what does not belong taken out (run on every change)
     check: '' when the finished value is right, otherwise the message shown
     chars:  keys that can be typed, for fields that do not report the caret */
  var RULES = {
    phone: {
      clean: cleanPhone, chars: /^\d+$/, paste: cleanPhone, attrs: { inputmode: 'numeric' },
      check: function (v) {
        if (v.length < 10) return 'Enter all 10 digits of the mobile number.';
        return /^[6-9]/.test(v) ? '' : 'Enter a valid mobile number (it starts with 6, 7, 8 or 9).';
      }
    },
    email: {
      clean: cleanEmail, chars: /^[A-Za-z0-9._%+\-@]+$/, oneAt: true,
      attrs: { maxlength: '150', autocapitalize: 'none', spellcheck: 'false' },
      check: function (v) {
        if (v.indexOf('@') < 0) return 'Include an @ in the email address, like name@example.com.';
        return EMAIL_OK.test(v) ? '' : 'Enter a valid email address, like name@example.com.';
      }
    },
    person: {
      clean: cleanName, trim: true, attrs: { maxlength: '100', autocapitalize: 'words' },
      check: function (v) { return HAS_LETTER.test(v) ? '' : 'Enter a name using letters only.'; }
    },
    place: {
      clean: cleanName, trim: true, attrs: { maxlength: '60', autocapitalize: 'words' },
      check: function (v) { return HAS_LETTER.test(v) ? '' : 'Use letters only.'; }
    },
    pincode: {
      clean: function (v) { return digits(v).replace(/^0+/, '').slice(0, 6); },
      chars: /^\d+$/, paste: digits, attrs: { inputmode: 'numeric' },
      check: function (v) { return /^[1-9]\d{5}$/.test(v) ? '' : 'Enter the 6-digit PIN code.'; }
    },
    aadhaar: {
      clean: function (v) { return digits(v).slice(0, 12); },
      chars: /^\d+$/, paste: digits, attrs: { inputmode: 'numeric' },
      check: function (v) { return /^[2-9]\d{11}$/.test(v) ? '' : 'Enter the 12-digit Aadhaar number.'; }
    },
    pan: {
      clean: cleanPan, chars: /^[A-Za-z0-9]+$/, attrs: { autocapitalize: 'characters', spellcheck: 'false' },
      check: function (v) { return /^[A-Z]{5}\d{4}[A-Z]$/.test(v) ? '' : 'Enter a valid PAN, like ABCDE1234F.'; }
    },
    year: {
      clean: function (v) { return digits(v).slice(0, 4); },
      chars: /^\d+$/, attrs: { inputmode: 'numeric' },
      check: function (v) { return /^(19|20)\d{2}$/.test(v) ? '' : 'Enter a 4-digit year, like 2024.'; }
    },
    percent: {
      clean: cleanPercent, chars: /^[\d.]+$/, attrs: { inputmode: 'decimal' },
      check: function (v) { return /^\d{1,3}(\.\d{1,2})?$/.test(v) && parseFloat(v) <= 100 ? '' : 'Enter a percentage from 0 to 100.'; }
    },
    digits: { clean: digits, chars: /^\d+$/, paste: digits },
    number: { chars: /^[\d.\-]+$/ },                          // "-" only where min allows it (keydown below)
    /* any other required box: spaces alone do not fill it */
    text: { check: function (v) { return v.trim() ? '' : 'Please fill in this field.'; } }
  };

  function labelOf(el) {
    try { return el.labels && el.labels[0] ? el.labels[0].textContent : ''; } catch (e) { return ''; }
  }

  function kindOf(el) {
    var tag = el.tagName;
    if (tag === 'TEXTAREA') return el.required ? 'text' : null;
    if (tag !== 'INPUT') return null;
    var type = (el.getAttribute('type') || 'text').toLowerCase();
    if (!/^(text|tel|email|number|search)$/.test(type)) return null;

    var name = (el.name || '').toLowerCase().replace(/\[\]$/, ''),
        ac = (el.getAttribute('autocomplete') || '').toLowerCase(),
        about = ((el.getAttribute('placeholder') || '') + ' ' + labelOf(el)).toLowerCase(),
        pattern = el.getAttribute('pattern') || '';

    if (type !== 'email' && /user/.test(about)) return el.required ? 'text' : null;   // "Email or Username" takes either
    if (type === 'email' || /e-?mail/.test(name) || /(^|\s)email$/.test(ac)) return 'email';
    if (type === 'tel' || /phone|mobile|whatsapp/.test(name) || /(^|\s)tel(-national)?$/.test(ac)) return 'phone';
    if (/pin_?code|postal|zip/.test(name) || /postal-code$/.test(ac)) return 'pincode';
    if (/aadha?ar/.test(name)) return 'aadhaar';
    if (/(^|_)pan(_?(no|num|number|card))?$/.test(name)) return 'pan';
    if (/(^|_)year$/.test(name)) return 'year';
    if (/percent/.test(name)) return 'percent';
    if (/^(first|last|middle|full|father|fathers|mother|mothers|guardian|student|parent)_?name$/.test(name) ||
        /(^|\s)(name|given-name|family-name|additional-name)$/.test(ac)) return 'person';
    if (/^(city|state|country|district)$/.test(name) || /(^|\s)(address-level[12]|country-name)$/.test(ac)) return 'place';
    if (type === 'number') return 'number';
    if (el.getAttribute('inputmode') === 'numeric' || /^(\[0-9\]|\\d)[*+]?(\{\d+(,\d*)?\})?$/.test(pattern)) return 'digits';
    return el.required ? 'text' : null;
  }

  /* The rule for a field, or null when the field is not one this guard looks after. */
  function ruleFor(el) {
    if (!el || !el.tagName || el.readOnly || el.disabled) return null;
    if (el.__fgKind === undefined) {
      var own = ['oninput', 'onkeypress', 'onkeydown', 'onkeyup', 'data-no-guard'].some(function (a) { return el.hasAttribute(a); });
      el.__fgKind = own ? null : kindOf(el);
    }
    return el.__fgKind ? RULES[el.__fgKind] : null;
  }

  /* Numeric keyboards on phones, sensible lengths: only where the page set none. */
  function prep(el) {
    var rule = ruleFor(el);
    if (!rule || el.__fgPrep) return;
    el.__fgPrep = true;
    var attrs = rule.attrs || {};
    Object.keys(attrs).forEach(function (a) {
      if (a === 'maxlength' ? el.maxLength > 0 : el.hasAttribute(a)) return;
      if (a === 'inputmode' && el.type === 'number') return;
      el.setAttribute(a, attrs[a]);
    });
  }

  function caret(el) {
    try {
      var a = el.selectionStart, b = el.selectionEnd;
      return typeof a === 'number' ? [a, b] : null;      // email and number fields do not report it
    } catch (e) { return null; }
  }

  /* Tidy the whole value, keeping the caret where the person was typing. */
  function tidy(el, rule) {
    if (!rule.clean) return;
    var v = el.value, c = rule.clean(v);
    if (el.type === 'number') {
      if (c.replace(/\.$/, '') === v.replace(/\.$/, '')) return;   // "12." while the decimals are typed
      c = c.replace(/\.$/, '');                                      // a number box cannot be set to "12."
    }
    if (c === v) return;
    var s = caret(el), at = s ? Math.min(rule.clean(v.slice(0, s[1])).length, c.length) : -1;
    el.value = c;
    if (at > -1) { try { el.setSelectionRange(at, at); } catch (e) {} }
  }

  /* ---------- messages under the field ---------- */
  var seq = 0;
  function note(el, msg) {
    var p = el.__fgNote;
    if (!msg) {
      if (!p) return;
      if (p.parentNode) p.parentNode.removeChild(p);
      el.__fgNote = null;
      el.classList.remove('fg-invalid');
      el.removeAttribute('aria-invalid');
      var ids = (el.getAttribute('aria-describedby') || '').split(/\s+/).filter(function (id) { return id && id !== p.id; });
      if (ids.length) el.setAttribute('aria-describedby', ids.join(' ')); else el.removeAttribute('aria-describedby');
      return;
    }
    if (!p) {
      p = el.__fgNote = d.createElement('p');
      p.className = 'fg-error';
      p.id = 'fg-error-' + (++seq);
      var anchor = el.parentNode && el.parentNode.classList && el.parentNode.classList.contains('input-group') ? el.parentNode : el;
      anchor.insertAdjacentElement('afterend', p);
      el.setAttribute('aria-describedby', ((el.getAttribute('aria-describedby') || '') + ' ' + p.id).trim());
    }
    p.textContent = msg;
    el.classList.add('fg-invalid');
    el.setAttribute('aria-invalid', 'true');
  }

  /* Keep the browser's own check in step (it stops the form sending); show the
     message when asked to, and take it away as soon as the value is right. */
  function validate(el, rule, reveal) {
    var v = el.value, msg = v && rule.check ? rule.check(v) : '';
    if (msg !== (el.__fgMsg || '')) {
      el.setCustomValidity(msg);
      el.__fgMsg = msg;
    }
    if (!msg) note(el, '');
    else if (reveal || el.__fgNote) note(el, msg);
  }

  /* ---------- listeners (capture phase: before the page's own ones) ---------- */

  /* A key that would add nothing the field can keep is not typed at all. */
  d.addEventListener('beforeinput', function (e) {
    var el = e.target, rule = ruleFor(el);
    if (!rule || !e.cancelable || e.inputType !== 'insertText' || e.data == null) return;
    var v = el.value, s = caret(el), data = e.data;
    if (s && rule.clean) {
      if (rule.clean(v.slice(0, s[0]) + data + v.slice(s[1])) === rule.clean(v)) e.preventDefault();
      return;
    }
    if (data.length > 1) return;                            // a keyboard suggestion: kept, then tidied
    /* (a number box hides a half-typed "12." from its value, so its length and
       range limits are left to the tidy-up that follows each key) */
    if ((rule.chars && !rule.chars.test(data)) ||
        (rule.oneAt && data.indexOf('@') > -1 && (v.indexOf('@') > -1 || data.split('@').length > 2))) {
      e.preventDefault();
    }
  }, true);

  /* Number boxes accept e, + and - on their own ("1e5"); none of these fields wants them. */
  d.addEventListener('keydown', function (e) {
    var el = e.target, rule = ruleFor(el);
    if (!rule || el.type !== 'number' || e.ctrlKey || e.metaKey || e.altKey) return;
    var min = parseFloat(el.getAttribute('min'));
    if (e.key === 'e' || e.key === 'E' || e.key === '+' || (e.key === '-' && !(min < 0)) ||
        (e.key === '.' && el.__fgKind === 'year')) e.preventDefault();
  }, true);

  /* Paste, autofill, drag and drop, phone keyboards: the value is tidied afterwards. */
  d.addEventListener('input', function (e) {
    var el = e.target, rule = ruleFor(el);
    if (!rule || e.isComposing) return;
    tidy(el, rule);
    validate(el, rule, false);
  }, true);

  d.addEventListener('compositionend', function (e) {
    var el = e.target, rule = ruleFor(el);
    if (!rule) return;
    tidy(el, rule);
    validate(el, rule, false);
  }, true);

  /* A pasted "+91 98765 43210" would be cut short by the field's length limit before
     it could be tidied, so the tidy copy is put in instead. */
  d.addEventListener('paste', function (e) {
    var el = e.target, rule = ruleFor(el), s = caret(el);
    if (!rule || !rule.paste || !s || typeof el.setRangeText !== 'function') return;
    var text = (e.clipboardData || w.clipboardData);
    text = text ? text.getData('text') : '';
    if (!text) return;
    e.preventDefault();
    var put = rule.paste(text), v = el.value,
        next = rule.clean(v.slice(0, s[0]) + put + v.slice(s[1])),
        at = Math.min(rule.clean(v.slice(0, s[0]) + put).length, next.length);
    el.value = next;
    try { el.setSelectionRange(at, at); } catch (err) {}
    var ev;
    try { ev = new InputEvent('input', { bubbles: true, inputType: 'insertFromPaste' }); }
    catch (err) { ev = d.createEvent('Event'); ev.initEvent('input', true, false); }
    el.dispatchEvent(ev);
  }, true);

  d.addEventListener('focusin', function (e) { prep(e.target); }, true);

  /* Leaving a field: trailing spaces go, and anything still wrong is said under it. */
  d.addEventListener('focusout', function (e) {
    var el = e.target, rule = ruleFor(el);
    if (!rule) return;
    if (rule.trim && el.value !== el.value.trim()) el.value = el.value.trim();
    validate(el, rule, true);
  }, true);

  /* Sending with a field still wrong: the message shows under every such field. */
  d.addEventListener('invalid', function (e) {
    var el = e.target, rule = ruleFor(el);
    if (rule && el.__fgMsg) note(el, el.__fgMsg);
  }, true);

  /* ---------- look ---------- */
  var css = d.createElement('style');
  css.textContent =
    '.fg-error{display:block;margin:6px 0 0;padding:0;font-size:.875rem;line-height:1.45;font-weight:600;color:#b42318;text-align:left}' +
    'input.fg-invalid,textarea.fg-invalid{border-color:#b42318!important;box-shadow:0 0 0 3px rgba(180,35,24,.14)!important}' +
    'html.app-skin-dark .fg-error{color:#f97066}';
  (d.head || d.documentElement).appendChild(css);

  function prepAll() { Array.prototype.forEach.call(d.querySelectorAll('input, textarea'), prep); }
  if (d.readyState === 'loading') d.addEventListener('DOMContentLoaded', prepAll); else prepAll();
})(window, document);
