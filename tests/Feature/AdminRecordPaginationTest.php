<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoutingController;
use App\Http\Controllers\Admin\StudentAdmissinController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\View;
use Tests\TestCase;

/** Exercises real list queries against a dedicated memory database, never the installed database. */
class AdminRecordPaginationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config([
            'database.default' => 'record_pagination_test',
            'database.connections.record_pagination_test' => [
                'driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '',
                'foreign_key_constraints' => true,
            ],
            'session.driver' => 'array',
            'activity.enabled' => false,
        ]);

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('email');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->string('admno');
            $table->string('full_name');
            $table->string('email');
            $table->string('admission_status')->default('pending');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('invoice_number');
            $table->string('invoice_label')->default('Admission Fee');
            $table->string('to_name');
            $table->string('to_email');
            $table->string('to_phone')->nullable();
            $table->decimal('grand_total', 12, 2)->default(100);
            $table->decimal('paid_amount', 12, 2)->nullable();
            $table->decimal('remaining_amount', 12, 2)->nullable();
            $table->string('payment_status')->default('pending');
            $table->date('due_date')->nullable();
            $table->boolean('deleted')->default(false);
            $table->boolean('viewid')->default(false);
            $table->timestamps();
        });

        for ($id = 1; $id <= 23; $id++) {
            DB::table('students')->insert([
                'id' => $id, 'name' => 'Student '.$id, 'username' => 'STU'.$id,
                'email' => 'student'.$id.'@example.test', 'created_at' => now(), 'updated_at' => now(),
            ]);
            DB::table('student_admissions')->insert([
                'student_id' => $id, 'admno' => 'ADM'.$id, 'full_name' => 'Student '.$id,
                'email' => 'student'.$id.'@example.test', 'created_at' => now(), 'updated_at' => now(),
            ]);
            // Three invoices for one account must not take up three slots in the account list.
            for ($invoice = 1; $invoice <= 3; $invoice++) {
                $this->invoice($id, 'INV-'.$id.'-'.$invoice);
            }
        }
    }

    protected function tearDown(): void
    {
        DB::disconnect('record_pagination_test');
        parent::tearDown();
    }

    public function test_student_and_admission_lists_continue_serial_numbers_and_show_full_controls(): void
    {
        $request = $this->listRequest('/admin/list-student', ['page' => 2, 'per_page' => 10]);
        $view = (new RoutingController)->liststudent($request);
        $students = $view->getData()['students'];
        $this->assertSame(23, $students->total());
        $this->assertSame(11, $students->firstItem());
        $html = $this->renderList($view);
        $this->assertMatchesRegularExpression('/<tbody>\s*<tr[^>]*>\s*<td>\s*11\s*<\/td>/s', $html);
        $this->assertStringContainsString('Showing 11–20 of 23 records', $html);
        $this->assertStringContainsString('Page 2 of 3', $html);
        foreach (['First', 'Previous', 'Next', 'Last'] as $label) {
            $this->assertStringContainsString('>'.$label.'</a>', $html);
        }

        $request = $this->listRequest('/admin/list-admission', ['page' => 2, 'per_page' => 10]);
        $view = (new StudentAdmissinController)->index($request);
        $this->assertSame(13, $view->getData()['admissions']->first()->id);
        $this->assertMatchesRegularExpression('/<tbody>\s*<tr[^>]*>\s*<td>\s*11\s*<\/td>/s', $this->renderList($view));
    }

    public function test_payment_and_id_lists_paginate_unique_accounts_and_exclude_deleted_invoices(): void
    {
        $deletedId = $this->invoice(23, 'DELETED', ['deleted' => true]);
        $controller = new RoutingController;

        foreach (['listpayment', 'listidcard'] as $method) {
            $first = $controller->$method($this->listRequest('/admin/'.$method, ['per_page' => 10]))->getData()['payments'];
            $view = $controller->$method($this->listRequest('/admin/'.$method, ['page' => 2, 'per_page' => 10]));
            $second = $view->getData()['payments'];
            $this->assertSame(23, $first->total());
            $this->assertSame(10, $first->count());
            $this->assertSame(10, $second->count());
            $this->assertEmpty($first->pluck('student_id')->intersect($second->pluck('student_id')));
            $this->assertNotContains($deletedId, $first->pluck('id'));
            $this->assertSame('INV-23-3', $first->first()->invoice_number);
            $this->assertSame(11, $second->firstItem());
            $this->assertMatchesRegularExpression('/<tbody>\s*<tr[^>]*>\s*<td>\s*11\s*<\/td>/s', $this->renderList($view));
        }
    }

    public function test_page_sizes_and_out_of_range_pages_are_handled_without_losing_query_values(): void
    {
        $request = $this->listRequest('/admin/list-student', ['per_page' => 10, 'page' => 999, 'q' => 'saved search']);
        $rows = (new RoutingController)->liststudent($request)->getData()['students'];
        $this->assertSame(3, $rows->currentPage());
        $this->assertSame(3, $rows->count());
        $this->assertStringContainsString('q=saved%20search', $rows->url(2));
        $this->assertStringContainsString('per_page=10', $rows->url(2));

        $request = $this->listRequest('/admin/list-admission', ['per_page' => 50]);
        $rows = (new StudentAdmissinController)->index($request)->getData()['admissions'];
        $this->assertSame(50, $rows->perPage());
        $this->assertSame(23, $rows->count());
    }

    public function test_fee_dues_keep_combined_filters_and_page_size_in_navigation(): void
    {
        $request = $this->listRequest('/admin/reports/dues', [
            'filter' => 'undated', 'q' => 'Student', 'per_page' => 10, 'page' => 2,
        ]);
        $view = (new ReportController)->dues($request);
        $rows = $view->getData()['rows'];
        $this->assertSame(23, $rows->total());
        $this->assertSame(11, $rows->firstItem());
        $this->assertStringContainsString('filter=undated', $rows->url(3));
        $this->assertStringContainsString('q=Student', $rows->url(3));
        $this->assertStringContainsString('per_page=10', $rows->url(3));
        $html = $this->renderList($view);
        $this->assertStringContainsString('Showing 11–20 of 23 records', $html);
        $this->assertStringContainsString('name="per_page" value="10"', $html);
    }

    private function invoice(int $student, string $number, array $attributes = []): int
    {
        return DB::table('payments')->insertGetId(array_merge([
            'student_id' => $student, 'invoice_number' => $number, 'to_name' => 'Student '.$student,
            'to_email' => 'student'.$student.'@example.test', 'created_at' => now(), 'updated_at' => now(),
        ], $attributes));
    }

    private function listRequest(string $path, array $query): Request
    {
        $request = Request::create($path, 'GET', $query);
        $this->app->instance('request', $request);

        return $request;
    }

    private function renderList(View $view): string
    {
        // Render the real list and pagination, isolating unrelated navigation/dashboard database queries.
        $source = str_replace([
            "@include('layouts.partials.admin.dashboard')",
            "@include('layouts.partials.admin.theme')",
        ], '', file_get_contents($view->getPath()));

        return Blade::render($source, $view->getData() + ['errors' => new ViewErrorBag]);
    }
}
