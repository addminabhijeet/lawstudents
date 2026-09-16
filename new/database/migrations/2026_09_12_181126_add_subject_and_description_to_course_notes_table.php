<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Additive columns only — both nullable, both default to leaving existing
// rows/behavior untouched. subject_id lets a note (a "Chapter" in the doc's
// terms) belong to a Subject; description is the "Short Description" the
// doc shows under each chapter's title. Every existing course_notes row and
// every existing query against this table keeps working unchanged.
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_notes', function (Blueprint $table) {
            $table->foreignId('subject_id')->nullable()->after('course_id')
                ->constrained('course_subjects')->nullOnDelete();
            $table->text('description')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('course_notes', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropColumn(['subject_id', 'description']);
        });
    }
};
