<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_notes', function (Blueprint $table) {
            if (!Schema::hasColumn('course_notes', 'subject_id')) {
                $table->foreignId('subject_id')->nullable()->constrained('course_subjects')->onDelete('set null')->after('course_id');
            }
            if (!Schema::hasColumn('course_notes', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (!Schema::hasColumn('course_notes', 'download_count')) {
                $table->integer('download_count')->default(0)->after('status');
            }
            if (!Schema::hasColumn('course_notes', 'version')) {
                $table->string('version')->nullable()->after('download_count');
            }
            if (!Schema::hasColumn('course_notes', 'visibility')) {
                $table->enum('visibility', ['public', 'private', 'restricted'])->default('public')->after('version');
            }
            if (!Schema::hasColumn('course_notes', 'delete')) {
                $table->boolean('delete')->default(false)->after('visibility');
            }
        });
    }

    public function down(): void
    {
        Schema::table('course_notes', function (Blueprint $table) {
            $columns = ['subject_id', 'description', 'download_count', 'version', 'visibility', 'delete'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('course_notes', $column)) {
                    if ($column === 'subject_id') {
                        $table->dropForeignKey(['subject_id']);
                    }
                    $table->dropColumn($column);
                }
            }
        });
    }
};
