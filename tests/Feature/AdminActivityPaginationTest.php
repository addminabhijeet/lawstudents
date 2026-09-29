<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\ActivityTrackingController;
use App\Models\AdmissionLead;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminActivityPaginationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:', 'activity.enabled' => false]);
        DB::purge('sqlite');
        $this->travelTo(now()->setDate(2026, 9, 29)->setTime(12, 0));

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->boolean('deleted')->default(0);
            $table->string('admission_status');
            $table->timestamps();
        });
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->date('issue_date');
            $table->string('payment_status');
        });
        (require database_path('migrations/2026_09_28_000001_create_activity_tracking_tables.php'))->up();
    }

    private function query(string $path, array $query): Request
    {
        $request = Request::create($path, 'GET', $query);
        $this->app->instance('request', $request);

        return $request;
    }

    private function leadRow(int $id, string $status = 'new'): array
    {
        return ['id' => $id, 'name' => 'Person '.$id, 'source' => 'website', 'status' => $status,
            'submitted_at' => now(), 'created_at' => now(), 'updated_at' => now()];
    }

    private function eventRow(int $id, array $attributes = []): array
    {
        return array_merge(['id' => $id, 'event_id' => (string) Str::uuid(), 'request_id' => (string) Str::uuid(),
            'panel' => 'admin', 'source' => 'request', 'event' => 'page_view', 'path' => '/admin',
            'occurred_at' => now()], $attributes);
    }

    public function test_lead_pages_retain_filters_and_have_continuous_serials_with_stable_order(): void
    {
        DB::table('admission_leads')->insert(array_map(fn ($id) => $this->leadRow($id), range(1, 61)));
        DB::table('admission_leads')->insert($this->leadRow(62, 'closed'));
        $request = $this->query('/admin/activity/leads', ['q' => 'Person', 'status' => 'new', 'page' => 2, 'per_page' => 25]);

        $paginator = (new ActivityTrackingController)->leads($request)->getData()['leads'];

        $this->assertSame(61, $paginator->total());
        $this->assertSame(26, $paginator->firstItem());
        $this->assertSame(50, $paginator->lastItem());
        $this->assertSame(range(26, 50), $paginator->getCollection()->pluck('id')->all());
        parse_str(parse_url($paginator->url(3), PHP_URL_QUERY), $query);
        $this->assertSame('Person', $query['q']);
        $this->assertSame('new', $query['status']);
        $this->assertSame('25', $query['per_page']);
    }

    public function test_events_render_the_second_page_serial_and_keep_date_and_actor_filters(): void
    {
        DB::table('activity_events')->insert(array_map(fn ($id) => $this->eventRow($id, ['actor_type' => 'admin', 'actor_id' => 7]), range(1, 25)));
        $request = $this->query('/admin/activity/events', ['from' => '2026-09-01', 'to' => '2026-09-30',
            'actor_type' => 'admin', 'actor_id' => 7, 'page' => 2, 'per_page' => 10]);

        $events = (new ActivityTrackingController)->events($request)->getData()['events'];
        $html = view('activity.event-table', compact('events'))->render();

        $this->assertSame(range(15, 6), $events->getCollection()->pluck('id')->all());
        $this->assertStringContainsString('<td>11</td>', $html);
        $this->assertStringContainsString('Showing 11–20 of 25 records', $html);
        $this->assertStringContainsString('Page 2 of 3', $html);
        $this->assertStringContainsString('actor_id=7', $events->url(3));
        $this->assertStringContainsString('from=2026-09-01', $events->url(3));
    }

    public function test_contact_history_and_journey_paginate_independently_without_losing_related_events(): void
    {
        DB::table('admission_leads')->insert($this->leadRow(1));
        DB::table('lead_follow_ups')->insert(array_map(fn ($id) => [
            'id' => $id, 'admission_lead_id' => 1, 'admin_id' => 7, 'outcome' => 'assigned', 'created_at' => now(),
        ], range(1, 31)));
        DB::table('activity_events')->insert(array_map(fn ($id) => $this->eventRow($id, [
            'subject_type' => 'LeadFollowUp', 'subject_id' => 1,
        ]), range(1, 31)));
        $request = $this->query('/admin/activity/leads/1', ['page' => 2, 'history_page' => 3, 'per_page' => 10]);

        $data = (new ActivityTrackingController)->lead($request, AdmissionLead::findOrFail(1))->getData();

        $this->assertSame(11, $data['events']->firstItem());
        $this->assertSame(21, $data['followUps']->firstItem());
        $this->assertSame(31, $data['events']->total());
        $this->assertSame(31, $data['followUps']->total());
        $this->assertFalse($data['lead']->relationLoaded('followUps'));
        $this->assertStringContainsString('history_page=3', $data['events']->url(1));
        $this->assertStringContainsString('page=2', $data['followUps']->url(1));
    }

    public function test_renewals_use_selected_size_and_preserve_month_and_payment_selection(): void
    {
        foreach (range(1, 31) as $id) {
            DB::table('students')->insert(['id' => $id, 'name' => 'Same name', 'email' => "person{$id}@example.test"]);
            DB::table('student_admissions')->insert(['student_id' => $id, 'admission_status' => 'approved', 'created_at' => now()]);
        }
        $request = $this->query('/admin/activity/renewals', ['month' => '2026-09', 'state' => 'all', 'page' => 2, 'per_page' => 25]);

        $students = (new ActivityTrackingController)->renewals($request)->getData()['students'];

        $this->assertSame(31, $students->total());
        $this->assertSame(range(26, 31), $students->getCollection()->pluck('id')->all());
        $this->assertSame(26, $students->firstItem());
        $this->assertStringContainsString('month=2026-09', $students->url(1));
        $this->assertStringContainsString('state=all', $students->url(1));
    }
}
