<?php

namespace Tests\Feature;

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Tests\TestCase;

class AdminDocumentResponseTest extends TestCase
{
    public function test_pdf_get_and_head_responses_keep_security_headers_without_crashing(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'admin-pdf-');
        file_put_contents($path, "%PDF-1.4\nTest fixture\n%%EOF");

        try {
            foreach (['GET', 'HEAD'] as $method) {
                $request = Request::create('https://example.test/admin/course-notes/view/1', $method);
                $file = new BinaryFileResponse($path, 200, ['Content-Type' => 'application/pdf']);
                $response = (new SecurityHeaders)->handle($request, fn () => $file);
                $response->prepare($request);

                $this->assertSame($file, $response);
                $this->assertSame(200, $response->getStatusCode());
                $this->assertSame('application/pdf', $response->headers->get('Content-Type'));
                $this->assertSame('SAMEORIGIN', $response->headers->get('X-Frame-Options'));
                $this->assertSame('nosniff', $response->headers->get('X-Content-Type-Options'));
                $this->assertStringContainsString("default-src 'self'", $response->headers->get('Content-Security-Policy'));
            }
        } finally {
            unlink($path);
        }
    }

    public function test_streamed_downloads_receive_the_same_security_headers(): void
    {
        $request = Request::create('/admin/reports/export/students');
        $stream = new StreamedResponse(fn () => print('id,name'));
        $response = (new SecurityHeaders)->handle($request, fn () => $stream);

        $this->assertSame($stream, $response);
        $this->assertSame('nosniff', $response->headers->get('X-Content-Type-Options'));
    }
}
