<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Additive table — new "Subject" grouping level between a Course and its
// PDF chapter notes (course_notes gets a nullable subject_id in the sibling
// migration). Existing courses/notes are unaffected: a note with no
// subject_id keeps rendering exactly as it did before this table existed.
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('sort_order')->default(0);
            $table->tinyInteger('delete')->default(1); // 1 = active, matches the rest of the app's convention
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_subjects');
    }
};
