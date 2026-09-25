<?php

namespace Tests\Unit;

use App\Helpers\RichTextSanitizer;
use PHPUnit\Framework\TestCase;

class RichTextSanitizerTest extends TestCase
{
    public function test_keeps_quill_formatting(): void
    {
        $html = '<h2 class="ql-align-center">Refunds</h2>'
            .'<p><strong>Bold</strong> <em>italic</em> <span style="color: rgb(230, 0, 0);">red</span></p>'
            .'<ol><li class="ql-indent-1">item</li></ol>'
            .'<p><a href="https://example.com" target="_blank">link</a></p>';

        $clean = RichTextSanitizer::clean($html);

        $this->assertStringContainsString('<h2 class="ql-align-center">Refunds</h2>', $clean);
        $this->assertStringContainsString('<strong>Bold</strong>', $clean);
        $this->assertStringContainsString('style="color: rgb(230, 0, 0);"', $clean);
        $this->assertStringContainsString('<li class="ql-indent-1">item</li>', $clean);
        $this->assertStringContainsString('href="https://example.com"', $clean);
    }

    public function test_strips_scripts_handlers_and_javascript_urls(): void
    {
        $html = '<p onclick="alert(1)">hi</p><script>alert(2)</script>'
            .'<a href="javascript:alert(3)">x</a><img src="x" onerror="alert(4)">';

        $clean = RichTextSanitizer::clean($html);

        $this->assertStringNotContainsString('<script', $clean);
        $this->assertStringNotContainsString('onclick', $clean);
        $this->assertStringNotContainsString('onerror', $clean);
        $this->assertStringNotContainsString('javascript:', $clean);
        $this->assertStringContainsString('<p>hi</p>', $clean);
    }

    public function test_handles_empty_input(): void
    {
        $this->assertSame('', RichTextSanitizer::clean(null));
        $this->assertSame('', RichTextSanitizer::clean(''));
    }
}
