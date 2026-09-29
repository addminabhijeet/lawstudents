<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('note_wishlists', function (Blueprint $table) {
            if (!Schema::hasColumn('note_wishlists', 'student_id')) {
                $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->after('id');
            }
            if (!Schema::hasColumn('note_wishlists', 'note_id')) {
                $table->foreignId('note_id')->constrained('course_notes')->onDelete('cascade')->after('student_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('note_wishlists', function (Blueprint $table) {
            if (Schema::hasColumn('note_wishlists', 'student_id')) {
                $table->dropForeignKey(['student_id']);
                $table->dropColumn('student_id');
            }
            if (Schema::hasColumn('note_wishlists', 'note_id')) {
                $table->dropForeignKey(['note_id']);
                $table->dropColumn('note_id');
            }
        });
    }
};
