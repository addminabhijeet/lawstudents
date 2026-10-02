<?php

namespace Tests\Feature;

use App\Http\Controllers\Student\CourseControllerStu;
use App\Models\Student;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\PdfParser;
use setasign\Fpdi\PdfParser\StreamReader;
use setasign\Fpdi\PdfReader\PdfReader;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class StudentProtectedNoteTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        (require database_path('migrations/2026_10_02_000001_create_pdf_watermark_settings_table.php'))->up();
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });
        Schema::create('course_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('title');
            $table->string('file_path');
            $table->boolean('is_downloadable');
            $table->integer('download_count')->default(0);
            $table->timestamps();
        });
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->string('payment_status');
        });
        Schema::create('student_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('note_id');
            $table->string('activity_type');
            $table->timestamps();
        });
        $this->source = tempnam(storage_path('app/public'), 'protected-test-');
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->Text(20, 20, 'Original course content');
        $pdf->Output('F', $this->source);
        DB::table('courses')->insert(['id' => 9, 'title' => 'Law course']);
        DB::table('course_notes')->insert(['id' => 31, 'course_id' => 9, 'title' => 'Law note',
            'file_path' => basename($this->source), 'is_downloadable' => true]);
        DB::table('payments')->insert(['student_id' => 5, 'course_id' => 9, 'payment_status' => 'paid']);
        $this->actingAs((new Student())->forceFill(['id' => 5, 'name' => 'Student']), 'student');
    }

    protected function tearDown(): void
    {
        if (isset($this->source) && is_file($this->source)) {
            unlink($this->source);
        }
        parent::tearDown();
    }

    private function viewerRequest(array $overrides = []): Request
    {
        $token = Crypt::encrypt(json_encode(array_merge(['note_id' => 31, 'ip' => '127.0.0.1',
            'expires_at' => now()->addMinutes(5)], $overrides)));

        return Request::create('/student/note-view/31', 'GET', ['token' => $token]);
    }

    public function test_view_and_download_serve_tiled_copies_and_keep_activity_and_original_files(): void
    {
        $hash = hash_file('sha256', $this->source);
        $controller = new CourseControllerStu();
        foreach (['view', 'download'] as $action) {
            $response = $action === 'view'
                ? $controller->viewNote($this->viewerRequest(), 31)
                : $controller->downloadNote(31);
            $copy = $response->getFile()->getPathname();
            try {
                $this->assertNotSame($this->source, $copy);
                $reader = new PdfReader(new PdfParser(StreamReader::createByFile($copy)));
                $content = $reader->getPage(1)->getContentStream();
                $this->assertGreaterThan(100, substr_count($content, '(Law Students)'));
                $this->assertStringNotContainsString('(law.norloxsolutionscrm.com)', $content);
                $this->assertSame($hash, hash_file('sha256', $this->source));
                if ($action === 'view') {
                    $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
                }
            } finally {
                unlink($copy);
            }
        }
        $this->assertDatabaseHas('student_activities', ['student_id' => 5, 'note_id' => 31, 'activity_type' => 'view_note']);
        $this->assertDatabaseHas('student_activities', ['student_id' => 5, 'note_id' => 31, 'activity_type' => 'download_note']);
        $this->assertDatabaseHas('course_notes', ['id' => 31, 'download_count' => 1]);
    }

    public function test_expired_links_are_still_rejected(): void
    {
        $this->expectException(HttpException::class);
        (new CourseControllerStu())->viewNote($this->viewerRequest(['expires_at' => now()->subMinute()]), 31);
    }

    public function test_another_students_payment_cannot_grant_access(): void
    {
        DB::table('payments')->update(['student_id' => 6]);
        $this->expectException(HttpException::class);
        (new CourseControllerStu())->viewNote($this->viewerRequest(), 31);
    }

    public function test_download_restriction_is_preserved(): void
    {
        DB::table('course_notes')->update(['is_downloadable' => false]);
        $this->expectException(HttpException::class);
        (new CourseControllerStu())->downloadNote(31);
    }

    public function test_disabled_paid_watermark_returns_the_original_without_deleting_it(): void
    {
        app(\App\Services\PdfWatermarkService::class)->setEnabled(basename($this->source), false);
        $response = (new CourseControllerStu())->viewNote($this->viewerRequest(), 31);
        $this->assertSame(realpath($this->source), realpath($response->getFile()->getPathname()));
        $response->prepare($this->viewerRequest());
        ob_start();
        try {
            $response->sendContent();
        } finally {
            ob_end_clean();
        }
        $this->assertFileExists($this->source);
    }
}
