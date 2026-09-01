<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FixAssetPaths
{
    /**
     * Handle an incoming request.
     * Automatically fixes hardcoded asset paths to work on both localhost and production
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only process HTML responses
        if ($this->isHtmlResponse($response)) {
            $content = $response->getContent();

            if (is_string($content)) {
                // Get the base URL
                $baseUrl = rtrim(config('app.url'), '/');

                // Replace hardcoded asset paths
                $content = $this->fixAssetPaths($content, $baseUrl);

                $response->setContent($content);
            }
        }

        return $response;
    }

    /**
     * Check if response is HTML
     */
    private function isHtmlResponse($response): bool
    {
        $contentType = $response->headers->get('Content-Type', '');
        return strpos($contentType, 'text/html') !== false || empty($contentType);
    }

    /**
     * Fix asset paths in HTML content
     */
    private function fixAssetPaths($content, $baseUrl): string
    {
        // Patterns to match and fix
        $patterns = [
            // src="/img/..." → src="BASEURL/img/..."
            '/src=["\']\/img\/([^"\']*)["\']/' => 'src="' . $baseUrl . '/img/$1"',

            // href="/img/..." → href="BASEURL/img/..."
            '/href=["\']\/img\/([^"\']*)["\']/' => 'href="' . $baseUrl . '/img/$1"',

            // data-image="/img/..." → data-image="BASEURL/img/..."
            '/data-image=["\']\/img\/([^"\']*)["\']/' => 'data-image="' . $baseUrl . '/img/$1"',

            // style="background-image:url('/img/...')" 
            '/style=["\']([^"\']*)(url\([\'"]?\/img\/([^)\'\"]*)[\'"]?\))([^"\']*)["\']/' => 'style="$1url(' . $baseUrl . '/img/$3)$4"',

            // favicon href="/img/..." → href="BASEURL/img/..."
            '/rel=["\']shortcut icon["\'][^>]*href=["\']\/img\/([^"\']*)["\']/' => 'rel="shortcut icon" href="' . $baseUrl . '/img/$1"',
        ];

        // Apply all replacements
        foreach ($patterns as $pattern => $replacement) {
            $content = preg_replace($pattern, $replacement, $content);
        }

        return $content;
    }
}
