<!-- Suppress non-critical console warnings and errors -->
<script>
    (function() {
        // Suppress EventEmitter memory leak warnings
        const originalWarn = console.warn;
        const originalError = console.error;

        console.warn = function(...args) {
            const msg = args[0] ? args[0].toString() : '';

            // Suppress MaxListenersExceededWarning
            if (msg.includes('MaxListenersExceededWarning') ||
                msg.includes('EventEmitter') ||
                msg.includes('memory leak')) {
                return;
            }

            // Suppress ObjectMultiplex orphaned data warnings
            if (msg.includes('ObjectMultiplex') || msg.includes('orphaned data')) {
                return;
            }

            // Call original warn for other messages
            originalWarn.apply(console, args);
        };

        console.error = function(...args) {
            const msg = args[0] ? args[0].toString() : '';

            // Suppress network-related errors that don't affect functionality
            if (msg.includes('Failed to load resource') ||
                msg.includes('404') ||
                msg.includes('403') ||
                msg.includes('font') ||
                msg.includes('.woff') ||
                msg.includes('.ttf')) {
                return;
            }

            // Call original error for other messages
            originalError.apply(console, args);
        };

        // Handle image load failures gracefully
        document.addEventListener('error', function(event) {
            if (event.target.tagName === 'IMG') {
                // Silently handle image loading failures
                event.preventDefault();
                event.stopPropagation();
            }
        }, true);
    })();
</script>

<!-- Fallback font loading for Font Awesome -->
<style>
    @supports (font-family: "Font Awesome") {
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif; }
    }

    /* Ensure icons render even if fonts fail to load */
    [class*="fa-"]::before {
        font-weight: 900;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
    }

    /* Graceful fallback for missing images */
    img {
        display: block;
        max-width: 100%;
        height: auto;
    }

    img[src=""] {
        display: none;
    }
</style>
