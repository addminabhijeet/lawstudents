<!-- Automatically fix hardcoded asset paths for localhost and production -->
<script>
    (function() {
        // Fix asset paths that are broken due to hardcoded /img/, /css/, /js/ paths
        const baseUrl = '{{ rtrim(config("app.url"), "/") }}';

        // Function to fix an element's src/href/data-image attributes
        function fixElementPath(el, attr) {
            if (!el.hasAttribute(attr)) return;

            let value = el.getAttribute(attr);
            if (!value) return;

            // Only fix paths that start with /img/, /css/, /js/ and don't already have protocol
            if ((value.startsWith('/img/') || value.startsWith('/css/') || value.startsWith('/js/')) &&
                !value.startsWith('http')) {
                el.setAttribute(attr, baseUrl + value);
            }
        }

        // Function to fix background-image in style attribute
        function fixBackgroundImage(el) {
            const style = el.getAttribute('style');
            if (!style) return;

            const fixed = style.replace(
                /url\(['"]?(\/(?:img|css|js)\/[^)'"]*)['"]?\)/g,
                function(match, path) {
                    return 'url(' + baseUrl + path + ')';
                }
            );

            if (fixed !== style) {
                el.setAttribute('style', fixed);
            }
        }

        // Function to fix favicon
        function fixFavicon() {
            const faviconLinks = document.querySelectorAll('link[rel="shortcut icon"], link[rel="icon"]');
            faviconLinks.forEach(link => {
                fixElementPath(link, 'href');
            });
        }

        // Fix all elements on page load
        function fixAllPaths() {
            // Fix img src
            document.querySelectorAll('img').forEach(img => fixElementPath(img, 'src'));

            // Fix link href
            document.querySelectorAll('link').forEach(link => fixElementPath(link, 'href'));

            // Fix script src
            document.querySelectorAll('script').forEach(script => fixElementPath(script, 'src'));

            // Fix data-image attributes
            document.querySelectorAll('[data-image]').forEach(el => fixElementPath(el, 'data-image'));

            // Fix style background-image
            document.querySelectorAll('[style*="background-image"]').forEach(el => fixBackgroundImage(el));

            // Fix favicon
            fixFavicon();
        }

        // Run on DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fixAllPaths);
        } else {
            fixAllPaths();
        }

        // Also run after a short delay for dynamically added content
        setTimeout(fixAllPaths, 500);

        // Observe for dynamically added content
        if (typeof MutationObserver !== 'undefined') {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.addedNodes.length) {
                        // Fix any newly added elements
                        mutation.addedNodes.forEach(node => {
                            if (node.nodeType === 1) { // Element node
                                // Fix the element itself
                                fixElementPath(node, 'src');
                                fixElementPath(node, 'href');
                                fixElementPath(node, 'data-image');
                                fixBackgroundImage(node);

                                // Fix children
                                node.querySelectorAll('img').forEach(el => fixElementPath(el, 'src'));
                                node.querySelectorAll('link').forEach(el => fixElementPath(el, 'href'));
                                node.querySelectorAll('script').forEach(el => fixElementPath(el, 'src'));
                                node.querySelectorAll('[data-image]').forEach(el => fixElementPath(el, 'data-image'));
                                node.querySelectorAll('[style*="background-image"]').forEach(el => fixBackgroundImage(el));
                            }
                        });
                    }
                });
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        }
    })();
</script>
