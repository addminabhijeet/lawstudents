(() => {
    'use strict';
    if (window.lawActivityStarted) return;
    const script = document.currentScript;
    if (!script || !window.crypto || !window.crypto.getRandomValues) return;
    window.lawActivityStarted = true;
    const endpoint = script.dataset.activityEndpoint;
    const context = script.dataset.activityContext;
    const csrf = script.dataset.activityCsrf;
    const started = performance.now();
    const forms = new WeakSet();
    let queue = [], sending = false, lastTick = performance.now(), active = 0;
    let lastInteraction = performance.now();
    const uuid = () => {
        const bytes = crypto.getRandomValues(new Uint8Array(16));
        bytes[6] = (bytes[6] & 15) | 64;
        bytes[8] = (bytes[8] & 63) | 128;
        const hex = [...bytes].map(b => b.toString(16).padStart(2, '0')).join('');
        return `${hex.slice(0, 8)}-${hex.slice(8, 12)}-${hex.slice(12, 16)}-${hex.slice(16, 20)}-${hex.slice(20)}`;
    };
    const sensitive = /password|secret|token|otp|cookie|authorization|card|cvv|aadhaar|pan_number|signature|photo|marksheet|id_proof/i;
    const descriptor = (value, fallback) => /^[a-zA-Z][a-zA-Z0-9_.:#\[\]-]{0,79}$/.test(value || '') && !sensitive.test(value) ? value : fallback;
    const formName = form => descriptor(form.id, `form-${Array.from(document.forms).indexOf(form)}`);
    const emit = (event, details = {}) => {
        if (performance.now() - started > 86400000) return;
        queue.push({ id: uuid(), event, elapsed_ms: Math.round(performance.now() - started), ...details });
        if (queue.length > 120) queue.shift();
    };
    const flush = async (beacon = false) => {
        if (!queue.length || (sending && !beacon)) return;
        const batch = queue.splice(0, 30);
        const body = JSON.stringify({ _token: csrf, context, events: batch });
        if (beacon && navigator.sendBeacon && navigator.sendBeacon(endpoint, new Blob([body], { type: 'application/json' }))) return;
        sending = true;
        try {
            const response = await fetch(endpoint, { method: 'POST', credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' }, body, keepalive: true });
            if (response.status >= 500 || response.status === 429) queue = batch.concat(queue).slice(-120);
        } catch (_) { queue = batch.concat(queue).slice(-120); }
        finally { sending = false; }
    };
    const tick = () => {
        const now = performance.now();
        if (!document.hidden && now - lastInteraction < 60000) active += Math.min(now - lastTick, 1000);
        lastTick = now;
    };
    const engagement = event => {
        tick();
        const height = document.documentElement.scrollHeight - innerHeight;
        emit(event, { active_ms: Math.min(60000, Math.round(active)),
            scroll_percent: height > 0 ? Math.min(100, Math.max(0, Math.round(scrollY / height * 100))) : 100 });
        active = 0;
    };
    const startForm = element => {
        if (!element.form || forms.has(element.form)) return;
        forms.add(element.form);
        emit('form_start', { form: formName(element.form) });
    };
    document.addEventListener('focusin', event => startForm(event.target), true);
    document.addEventListener('change', event => {
        const field = event.target;
        if (!field.form || ['hidden', 'password', 'file'].includes(field.type) || sensitive.test(field.name || '')) return;
        startForm(field);
        emit('field_completed', { form: formName(field.form), field: descriptor(field.name, 'field') });
    }, true);
    document.addEventListener('invalid', event => {
        if (!event.target.form) return;
        startForm(event.target);
        emit('field_invalid', { form: formName(event.target.form), field: descriptor(event.target.name, 'protected-field') });
    }, true);
    document.addEventListener('submit', event => {
        emit('form_submit_attempt', { form: formName(event.target) });
        flush(true);
    }, true);
    document.addEventListener('click', event => {
        const target = event.target.closest('a,button,[role="button"]');
        if (!target) return;
        // Position identifies a control without collecting displayed names, phone numbers or URLs.
        emit('click', { target: descriptor(target.dataset.track, `${target.tagName.toLowerCase()}-${Array.from(document.querySelectorAll('a,button,[role="button"]')).indexOf(target)}`) });
    }, true);
    ['pointerdown', 'keydown', 'scroll', 'touchstart'].forEach(name => document.addEventListener(name, () => {
        lastInteraction = performance.now();
    }, { passive: true }));
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) { engagement('page_engagement'); flush(true); }
        else { lastTick = performance.now(); lastInteraction = performance.now(); emit('page_visible'); }
    });
    window.addEventListener('pagehide', () => { engagement('page_leave'); flush(true); });
    window.addEventListener('pageshow', event => { if (event.persisted) emit('page_visible'); });
    setInterval(tick, 1000);
    setInterval(() => { engagement('page_engagement'); flush(); }, 15000);
    emit('page_visible');
    flush();
})();
