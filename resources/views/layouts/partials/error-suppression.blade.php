<!-- Suppress non-critical console warnings and errors -->
<script>
    (function() {
        // Override console methods to suppress specific errors
        const originalWarn = console.warn;
        const originalError = console.error;
        const originalLog = console.log;

        // List of patterns to suppress
        const suppressPatterns = [
            'MaxListenersExceededWarning',
            'EventEmitter',
            'memory leak',
            'ObjectMultiplex',
            'orphaned data',
            'Failed to load resource',
            'contentscript',
            '404',
            '403',
            'font',
            '.woff',
            '.ttf',
            '.woff2'
        ];

        const shouldSuppress = (msg) => {
            if (!msg) return false;
            const msgStr = msg.toString().toLowerCase();
            return suppressPatterns.some(pattern => msgStr.includes(pattern.toLowerCase()));
        };

        console.warn = function(...args) {
            if (!shouldSuppress(args[0])) {
                originalWarn.apply(console, args);
            }
        };

        console.error = function(...args) {
            if (!shouldSuppress(args[0])) {
                originalError.apply(console, args);
            }
        };

        console.log = function(...args) {
            if (!shouldSuppress(args[0])) {
                originalLog.apply(console, args);
            }
        };

        // Suppress network-level error events
        window.addEventListener('error', (event) => {
            if (event.message && shouldSuppress(event.message)) {
                event.preventDefault();
                return false;
            }
        }, true);

        // Handle image load failures gracefully
        document.addEventListener('error', (event) => {
            if (event.target && event.target.tagName === 'IMG') {
                event.preventDefault();
                event.stopPropagation();
                // Set a transparent placeholder
                event.target.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
            }
        }, true);

        // Suppress unhandled rejection warnings for network errors
        window.addEventListener('unhandledrejection', (event) => {
            if (event.reason && shouldSuppress(event.reason)) {
                event.preventDefault();
            }
        });

        // Register Service Worker for network-level error handling
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js', { scope: '/' })
                .then((registration) => {
                    // Force update of the service worker
                    registration.update();
                })
                .catch((err) => {
                    // Silently fail if SW registration fails
                });

            // Clear old caches to prevent stale asset errors
            if ('caches' in window) {
                caches.keys().then((cacheNames) => {
                    cacheNames.forEach((cacheName) => {
                        caches.delete(cacheName);
                    });
                });
            }
        }
    })();
</script>

<!-- Fallback font loading and styling -->
<style>
    /* Ensure icons render even if fonts fail */
    @font-face {
        font-family: 'Font Awesome 6 Free';
        font-display: swap;
        src: url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/webfonts/fa-solid-900.woff2') format('woff2'),
             url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/webfonts/fa-solid-900.woff') format('woff');
        font-weight: 900;
        font-style: normal;
    }

    @font-face {
        font-family: 'Font Awesome 6 Pro';
        font-display: swap;
        src: url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/webfonts/fa-regular-400.woff2') format('woff2'),
             url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/webfonts/fa-regular-400.woff') format('woff');
        font-weight: 400;
        font-style: normal;
    }

    /* Ensure icons render even if fonts fail to load */
    [class*="fa-"]::before,
    [class*="fa-"]::after {
        font-weight: 900;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* Graceful fallback for missing images */
    img {
        display: block;
        max-width: 100%;
        height: auto;
    }

    img[src=""],
    img:not([src]) {
        display: none;
    }

    /* Fallback background for images that fail to load */
    img.lazy-load:not([src]) {
        background: linear-gradient(45deg, #f0f0f0 25%, transparent 25%, transparent 75%, #f0f0f0 75%, #f0f0f0),
                    linear-gradient(45deg, #f0f0f0 25%, transparent 25%, transparent 75%, #f0f0f0 75%, #f0f0f0);
        background-size: 20px 20px;
        background-position: 0 0, 10px 10px;
        background-color: #fafafa;
    }
</style>
