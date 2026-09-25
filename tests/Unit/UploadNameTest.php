<?php

namespace Tests\Unit;

use App\Helpers\UploadName;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\TestCase;

class UploadNameTest extends TestCase
{
    private const PDF = "%PDF-1.4\n1 0 obj<<>>endobj\ntrailer<<>>\n%%EOF\n";

    private array $tempFiles = [];

    protected function tearDown(): void
    {
        array_map('unlink', array_filter($this->tempFiles, 'is_file'));
        parent::tearDown();
    }

    /**
     * A real UploadedFile (not UploadedFile::fake(), which guesses the type
     * from the name) so the extension is sniffed from content as in production.
     */
    private function upload(string $clientName, string $content = self::PDF): UploadedFile
    {
        $path = tempnam(sys_get_temp_dir(), 'upl');
        file_put_contents($path, $content);
        $this->tempFiles[] = $path;

        return new UploadedFile($path, $clientName, null, null, true);
    }

    public function test_extension_comes_from_content_not_client_name(): void
    {
        $this->assertStringEndsWith('_notes.pdf', UploadName::safe($this->upload('notes.html')));
    }

    public function test_strips_unsafe_characters_and_inner_dots(): void
    {
        $this->assertSame('evilphpx.pdf', UploadName::safe($this->upload('../evil.php<x>.pdf'), unique: false));
    }

    public function test_keeps_readable_name_without_prefix_when_not_unique(): void
    {
        $this->assertSame('Annual Report (2024).pdf', UploadName::safe($this->upload('Annual Report (2024).pdf'), unique: false));
    }
}
