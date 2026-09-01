<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FixAssetPaths
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only process HTML responses
        if ($this->isHtmlResponse($response)) {
            $content = $response->getContent();

            // Get the base path from the APP_URL
            $basePath = parse_url(config('app.url'), PHP_URL_PATH) ?? '';

            // Fix all issues in content
            $content = $this->fixMetaTags($content);
            $content = $this->fixAssetPaths($content, $basePath);
            $content = $this->fixFontAwesome($content);

            $response->setContent($content);
        }

        return $response;
    }

    /**
     * Check if response is HTML
     */
    private function isHtmlResponse(Response $response): bool
    {
        $contentType = $response->headers->get('Content-Type', '');
        return str_contains($contentType, 'text/html') || empty($contentType);
    }

    /**
     * Fix meta tags with incorrect syntax
     */
    private function fixMetaTags(string $content): string
    {
        // Fix viewport meta tag: remove backticks and incorrect comma
        $content = preg_replace(
            '/content="width=`device-width`,\s*initial-scale=1\.0"/',
            'content="width=device-width, initial-scale=1.0"',
            $content
        );

        return $content;
    }

    /**
     * Fix FontAwesome CDN issues
     */
    private function fixFontAwesome(string $content): string
    {
        // Use latest CDN with integrity check
        $faUrl = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css';

        // Replace any font-awesome CDN link with the correct one
        $content = preg_replace(
            '/href="[^"]*font-awesome[^"]*\.css"/',
            'href="' . $faUrl . '"',
            $content
        );

        return $content;
    }

    /**
     * Fix asset paths in HTML content
     */
    private function fixAssetPaths(string $content, string $basePath): string
    {
        // Patterns to fix
        $patterns = [
            // Fix /img/ paths
            '/href="\/img\//i' => 'href="' . $basePath . '/img/',
            '/src="\/img\//i' => 'src="' . $basePath . '/img/',
            '/url\(\/img\//i' => 'url(' . $basePath . '/img/',

            // Fix /css/ paths
            '/href="\/css\//i' => 'href="' . $basePath . '/css/',
            '/src="\/css\//i' => 'src="' . $basePath . '/css/',

            // Fix /js/ paths
            '/src="\/js\//i' => 'src="' . $basePath . '/js/',
            '/href="\/js\//i' => 'href="' . $basePath . '/js/',

            // Fix /assets/ paths
            '/href="\/assets\//i' => 'href="' . $basePath . '/assets/',
            '/src="\/assets\//i' => 'src="' . $basePath . '/assets/',
            '/url\(\/assets\//i' => 'url(' . $basePath . '/assets/',
        ];

        foreach ($patterns as $pattern => $replacement) {
            $content = preg_replace($pattern, $replacement, $content);
        }

        return $content;
    }
}
