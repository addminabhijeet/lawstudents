// Service Worker for handling failed resources gracefully
self.addEventListener('fetch', event => {
    // Handle failed font requests
    if (event.request.url.includes('.woff2') ||
        event.request.url.includes('.woff') ||
        event.request.url.includes('.ttf') ||
        event.request.url.includes('.otf')) {

        event.respondWith(
            fetch(event.request).catch(() => {
                // Return empty response for font files instead of error
                return new Response('', {
                    status: 200,
                    statusText: 'OK',
                    headers: new Headers({
                        'Content-Type': 'font/woff2'
                    })
                });
            })
        );
        return;
    }

    // Handle image requests with 403/404
    if (event.request.url.includes('.jpg') ||
        event.request.url.includes('.jpeg') ||
        event.request.url.includes('.png') ||
        event.request.url.includes('.gif')) {

        event.respondWith(
            fetch(event.request).catch(() => {
                // Return transparent 1x1 pixel placeholder
                return new Response(
                    new Blob([
                        atob('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7')
                    ], { type: 'image/gif' }),
                    {
                        status: 200,
                        statusText: 'OK',
                        headers: new Headers({
                            'Content-Type': 'image/gif'
                        })
                    }
                );
            })
        );
        return;
    }

    // For all other requests, fetch normally
    event.respondWith(fetch(event.request));
});
