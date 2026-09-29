<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (!Schema::hasColumn('courses', 'category_id')) {
                $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->after('id');
            }
            if (!Schema::hasColumn('courses', 'instructor_id')) {
                $table->foreignId('instructor_id')->nullable()->constrained('users')->onDelete('set null')->after('category_id');
            }
            if (!Schema::hasColumn('courses', 'title')) {
                $table->string('title')->after('instructor_id');
            }
            if (!Schema::hasColumn('courses', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
            if (!Schema::hasColumn('courses', 'short_description')) {
                $table->text('short_description')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('courses', 'description')) {
                $table->text('description')->nullable()->after('short_description');
            }
            if (!Schema::hasColumn('courses', 'price')) {
                $table->decimal('price', 12, 2)->default(0)->after('description');
            }
            if (!Schema::hasColumn('courses', 'level')) {
                $table->string('level')->nullable()->after('price');
            }
            if (!Schema::hasColumn('courses', 'duration')) {
                $table->string('duration')->nullable()->after('level');
            }
            if (!Schema::hasColumn('courses', 'discount')) {
                $table->decimal('discount', 12, 2)->nullable()->after('duration');
            }
            if (!Schema::hasColumn('courses', 'is_free')) {
                $table->boolean('is_free')->default(false)->after('discount');
            }
            if (!Schema::hasColumn('courses', 'status')) {
                $table->boolean('status')->default(true)->after('is_free');
            }
            if (!Schema::hasColumn('courses', 'thumbnail')) {
                $table->text('thumbnail')->nullable()->after('status');
            }
            if (!Schema::hasColumn('courses', 'brochure')) {
                $table->text('brochure')->nullable()->after('thumbnail');
            }
            if (!Schema::hasColumn('courses', 'delete')) {
                $table->boolean('delete')->default(false)->after('brochure');
            }
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $columns = ['category_id', 'instructor_id', 'title', 'slug', 'short_description', 'description',
                       'price', 'level', 'duration', 'discount', 'is_free', 'status', 'thumbnail', 'brochure', 'delete'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('courses', $column)) {
                    if (in_array($column, ['category_id', 'instructor_id'])) {
                        $table->dropForeignKey([$column]);
                    }
                    $table->dropColumn($column);
                }
            }
        });
    }
};
