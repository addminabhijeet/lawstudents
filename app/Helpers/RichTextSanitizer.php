<?php

namespace App\Helpers;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

/**
 * Cleans admin-authored rich text (Quill output) before it is rendered with
 * {!! !!}: keeps formatting, drops scripts, event handlers and unsafe URLs.
 */
class RichTextSanitizer
{
    private static ?HtmlSanitizer $sanitizer = null;

    public static function clean(?string $html): string
    {
        if ($html === null || $html === '') {
            return '';
        }

        return self::sanitizer()->sanitize($html);
    }

    private static function sanitizer(): HtmlSanitizer
    {
        return self::$sanitizer ??= new HtmlSanitizer(
            (new HtmlSanitizerConfig)
                ->allowSafeElements()
                // Quill stores alignment/size/indent as classes and colours as inline styles
                ->allowAttribute('class', '*')
                ->allowAttribute('style', '*')
                ->allowLinkSchemes(['http', 'https', 'mailto', 'tel'])
                ->allowRelativeLinks()
                // Quill embeds pasted/uploaded images as data: URIs
                ->allowMediaSchemes(['http', 'https', 'data'])
                ->allowRelativeMedias()
                ->withMaxInputLength(-1)
        );
    }
}
