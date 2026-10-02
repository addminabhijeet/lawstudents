<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Services\PdfWatermarkService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\PdfParser;
use setasign\Fpdi\PdfParser\StreamReader;
use setasign\Fpdi\PdfReader\PdfReader;
use Tests\TestCase;

class PdfWatermarkSettingsTest extends TestCase
{
    private array $sources = [];

    protected function setUp(): void
    {
        parent::setUp();
        app('url')->forceRootUrl('http://localhost');
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:', 'activity.enabled' => false]);
        DB::purge('sqlite');
        (require database_path('migrations/2026_10_02_000001_create_pdf_watermark_settings_table.php'))->up();
        foreach (['copy', 'act', 'rule', 'govt_exam', 'legal_knowledge'] as $prefix) {
            foreach (['categories', 'subcategories'] as $suffix) {
                Schema::create($prefix.'_'.$suffix, function (Blueprint $table) {
                    $table->id();
                    $table->boolean('delete')->default(true);
                });
                DB::table($prefix.'_'.$suffix)->insert(['id' => 1]);
            }
        }
        $files = [];
        for ($index = 0; $index < 2; $index++) {
            $source = tempnam(storage_path('app/public'), 'watermark-test-');
            $this->sources[] = $source;
            $pdf = new Fpdi();
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 12);
            $pdf->Text(20, 20, 'Original material '.$index);
            $pdf->Output('F', $source);
            $files[] = basename($source);
        }
        foreach (['copys', 'acts', 'rules', 'govt_exams', 'legal_knowledge_notes'] as $name) {
            Schema::create($name, function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('category_id');
                $table->unsignedBigInteger('subcategory_id');
                $table->text('pdfs');
                $table->string('description');
                $table->boolean('delete')->default(true);
                $table->timestamps();
            });
            DB::table($name)->insert(['id' => 1, 'category_id' => 1, 'subcategory_id' => 1,
                'pdfs' => json_encode($files), 'description' => 'Free study material']);
        }
    }

    protected function tearDown(): void
    {
        foreach ($this->sources as $source) {
            if (is_file($source)) unlink($source);
        }
        parent::tearDown();
    }

    private function assertBranding(string $type, int $index = 0, bool $enabled = true): void
    {
        $response = $this->get(route('frontend.study-pdf.file', ['type' => $type, 'id' => 1, 'index' => $index]));
        $response->assertOk()->assertHeader('Content-Type', 'application/pdf');
        $file = $response->baseResponse->getFile()->getPathname();
        try {
            $reader = new PdfReader(new PdfParser(StreamReader::createByFile($file)));
            $content = $reader->getPage(1)->getContentStream();
            if ($enabled) {
                $this->assertGreaterThan(100, substr_count($content, '(law.norloxsolutionscrm.com)'));
                $this->assertNotSame($this->sources[$index], $file);
            } else {
                $this->assertStringNotContainsString('(law.norloxsolutionscrm.com)', $content);
                $this->assertSame(realpath($this->sources[$index]), realpath($file));
            }
        } finally {
            if (!in_array(realpath($file), array_map('realpath', $this->sources), true)) unlink($file);
        }
    }

    public function test_every_free_study_section_is_watermarked_by_default(): void
    {
        foreach (['copy', 'act', 'rule', 'govt-exam', 'legal-knowledge'] as $type) {
            $this->assertBranding($type);
        }
        $this->assertDatabaseCount('pdf_watermark_settings', 0);
    }

    public function test_admin_can_disable_one_pdf_and_reenable_it_without_changing_other_files(): void
    {
        $this->actingAs((new Admin())->forceFill(['id' => 99]), 'admin');
        $input = ['type' => 'copy', 'id' => 1, 'index' => 0, 'enabled' => false];
        $this->putJson(route('admin.pdf-watermarks.update'), $input)->assertOk()->assertJson(['enabled' => false]);
        $this->assertBranding('copy', 0, false);
        $this->assertBranding('copy', 1);
        $input['enabled'] = true;
        $this->putJson(route('admin.pdf-watermarks.update'), $input)->assertOk()->assertJson(['enabled' => true]);
        $this->assertBranding('copy');
        $this->assertFileExists($this->sources[0]);
    }

    public function test_visitors_cannot_change_watermark_settings_or_open_paid_notes_through_public_routes(): void
    {
        $this->putJson(route('admin.pdf-watermarks.update'), ['type' => 'copy', 'id' => 1, 'index' => 0, 'enabled' => false])->assertUnauthorized();
        $this->getJson(route('frontend.study-pdf.file', ['type' => 'course-note', 'id' => 1, 'index' => 0]))->assertNotFound();
        $this->getJson(route('frontend.study-pdf.file', ['type' => 'copy', 'id' => 1, 'index' => 99]))->assertNotFound();
        $this->assertDatabaseCount('pdf_watermark_settings', 0);
    }

    public function test_deleted_public_material_and_deleted_categories_cannot_be_opened(): void
    {
        DB::table('copys')->update(['delete' => false]);
        $this->getJson(route('frontend.study-pdf.file', ['type' => 'copy', 'id' => 1, 'index' => 0]))->assertNotFound();
        DB::table('act_categories')->update(['delete' => false]);
        $this->getJson(route('frontend.study-pdf.file', ['type' => 'act', 'id' => 1, 'index' => 0]))->assertNotFound();
    }

    public function test_upload_preferences_default_to_checked_and_preserve_older_form_requests(): void
    {
        $service = app(PdfWatermarkService::class);
        $file = basename($this->sources[0]);
        $this->assertTrue($service->isEnabled($file));
        $service->applyUploadPreference($file, Request::create('/upload', 'POST', ['show_watermark' => '0']));
        $this->assertFalse($service->isEnabled($file));
        $service->applyUploadPreference($file, Request::create('/upload', 'POST'));
        $this->assertFalse($service->isEnabled($file));
        $service->applyUploadPreference($file, Request::create('/upload', 'POST', ['show_watermark' => '1']));
        $this->assertTrue($service->isEnabled($file));
        $html = view('pdfs.upload-watermark')->render();
        $this->assertMatchesRegularExpression('/type="checkbox"[^>]*checked/s', $html);
    }

    public function test_free_viewer_page_uses_the_protected_viewer_and_print_styles(): void
    {
        $this->get(route('frontend.study-pdf', ['type' => 'copy', 'id' => 1, 'index' => 0]))
            ->assertOk()->assertSee('data-protected-note-viewer', false)
            ->assertSee('protected-pdf-viewer.js')->assertSee('paid-note-protection.css');
    }
}
