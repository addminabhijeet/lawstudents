<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseSubjectController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminContentPaginationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('delete')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title');
            $table->boolean('status')->default(true);
            $table->boolean('delete')->default(true);
            $table->timestamps();
        });
        Schema::create('course_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('name');
            $table->integer('sort_order')->default(0);
            $table->boolean('delete')->default(true);
            $table->timestamps();
        });
    }

    public function test_subcategory_pagination_filters_before_counting_and_keeps_all_form_options(): void
    {
        $root = DB::table('categories')->insertGetId(['name' => 'Main category']);
        for ($index = 1; $index <= 13; $index++) {
            DB::table('categories')->insert(['name' => 'Child '.$index, 'parent_id' => $root]);
        }
        DB::table('categories')->insert(['name' => 'Deleted child', 'parent_id' => $root, 'delete' => 0]);
        $this->useRequest(['page' => 2, 'per_page' => 10, 'q' => 'retained']);

        $data = app(CourseController::class)->listcoursesubcategory()->getData();
        $paginator = $data['categories'];

        $this->assertSame(13, $paginator->total());
        $this->assertSame(3, $paginator->count());
        $this->assertSame(11, $paginator->firstItem());
        $this->assertSame(14, $data['allCategories']->count());
        $this->assertStringContainsString('q=retained', $paginator->url(1));
        $this->assertStringContainsString('per_page=10', $paginator->url(1));
    }

    public function test_category_rows_match_the_count_and_numbering_even_when_a_parent_is_on_another_page(): void
    {
        $root = DB::table('categories')->insertGetId(['name' => 'Root category']);
        for ($index = 1; $index <= 13; $index++) {
            DB::table('categories')->insert(['name' => 'Child '.$index, 'parent_id' => $root]);
        }
        $this->useRequest(['page' => 2]);

        $categories = app(CourseController::class)->listcoursecategory()->getData()['categories'];

        $this->assertSame(14, $categories->total());
        $this->assertCount(4, $categories);
        $html = view('course.partials.admin-category-row', [
            'category' => $categories->first(), 'depth' => 0, 'rowNumber' => $categories->firstItem(),
        ])->render();
        $this->assertSame(1, substr_count($html, '<tr '));
        $this->assertStringContainsString('<td>11</td>', $html);
        $this->assertStringContainsString('Under Root category', $html);
    }

    public function test_subject_page_size_is_bounded_and_preserves_the_existing_default(): void
    {
        $course = DB::table('courses')->insertGetId(['title' => 'Civil law']);
        for ($index = 1; $index <= 30; $index++) {
            DB::table('course_subjects')->insert(['course_id' => $course, 'name' => 'Subject '.$index]);
        }
        $controller = app(CourseSubjectController::class);
        $this->useRequest([]);
        $this->assertSame(15, $controller->listsubjects()->getData()['subjects']->perPage());

        $this->useRequest(['per_page' => 25, 'page' => 2]);
        $subjects = $controller->listsubjects()->getData()['subjects'];
        $this->assertSame(25, $subjects->perPage());
        $this->assertSame(26, $subjects->firstItem());
        $this->assertCount(5, $subjects);

        $this->useRequest(['per_page' => 999999]);
        $this->assertSame(15, $controller->listsubjects()->getData()['subjects']->perPage());
    }

    private function useRequest(array $query): void
    {
        $request = Request::create('/admin/categories', 'GET', $query);
        $this->app->instance('request', $request);
        Paginator::currentPageResolver(fn ($name) => (int) $request->query($name, 1));
        Paginator::queryStringResolver(fn () => $request->query());
        Paginator::currentPathResolver(fn () => $request->url());
    }
}
