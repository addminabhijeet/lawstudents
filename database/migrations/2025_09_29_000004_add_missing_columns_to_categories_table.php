<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }
            if (!Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('categories', 'icon')) {
                $table->string('icon')->nullable()->after('description');
            }
            if (!Schema::hasColumn('categories', 'parent_id')) {
                $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade')->after('icon');
            }
            if (!Schema::hasColumn('categories', 'status')) {
                $table->boolean('status')->default(true)->after('parent_id');
            }
            if (!Schema::hasColumn('categories', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('status');
            }
            if (!Schema::hasColumn('categories', 'delete')) {
                $table->boolean('delete')->default(false)->after('sort_order');
            }
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $columns = ['name', 'slug', 'description', 'icon', 'parent_id', 'status', 'sort_order', 'delete'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('categories', $column)) {
                    if ($column === 'parent_id') {
                        $table->dropForeignKey(['parent_id']);
                    }
                    $table->dropColumn($column);
                }
            }
        });
    }
};
