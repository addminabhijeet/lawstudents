<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('note_progress', function (Blueprint $table) {
            if (!Schema::hasColumn('note_progress', 'student_id')) {
                $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->after('id');
            }
            if (!Schema::hasColumn('note_progress', 'course_id')) {
                $table->foreignId('course_id')->constrained('courses')->onDelete('cascade')->after('student_id');
            }
            if (!Schema::hasColumn('note_progress', 'note_id')) {
                $table->foreignId('note_id')->constrained('course_notes')->onDelete('cascade')->after('course_id');
            }
            if (!Schema::hasColumn('note_progress', 'total_pages')) {
                $table->integer('total_pages')->default(0)->after('note_id');
            }
            if (!Schema::hasColumn('note_progress', 'viewed_pages')) {
                $table->integer('viewed_pages')->default(0)->after('total_pages');
            }
            if (!Schema::hasColumn('note_progress', 'progress_percent')) {
                $table->decimal('progress_percent', 5, 2)->default(0)->after('viewed_pages');
            }
        });
    }

    public function down(): void
    {
        Schema::table('note_progress', function (Blueprint $table) {
            $columns = ['student_id', 'course_id', 'note_id', 'total_pages', 'viewed_pages', 'progress_percent'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('note_progress', $column)) {
                    if (in_array($column, ['student_id', 'course_id', 'note_id'])) {
                        $table->dropForeignKey([$column]);
                    }
                    $table->dropColumn($column);
                }
            }
        });
    }
};
