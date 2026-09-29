<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_activities', function (Blueprint $table) {
            if (!Schema::hasColumn('student_activities', 'student_id')) {
                $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->after('id');
            }
            if (!Schema::hasColumn('student_activities', 'course_id')) {
                $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null')->after('student_id');
            }
            if (!Schema::hasColumn('student_activities', 'note_id')) {
                $table->foreignId('note_id')->nullable()->constrained('course_notes')->onDelete('set null')->after('course_id');
            }
            if (!Schema::hasColumn('student_activities', 'activity_type')) {
                $table->string('activity_type')->after('note_id');
            }
            if (!Schema::hasColumn('student_activities', 'metadata')) {
                $table->json('metadata')->nullable()->after('activity_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('student_activities', function (Blueprint $table) {
            $columns = ['student_id', 'course_id', 'note_id', 'activity_type', 'metadata'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('student_activities', $column)) {
                    if (in_array($column, ['student_id', 'course_id', 'note_id'])) {
                        $table->dropForeignKey([$column]);
                    }
                    $table->dropColumn($column);
                }
            }
        });
    }
};
