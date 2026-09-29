<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * OTP columns are now included in the base student_admissions table creation.
     * This migration is kept for backward compatibility with existing databases.
     */
    public function up(): void
    {
        // Only add OTP columns if they don't already exist
        // This migration was replaced by 2025_09_29_000002_create_student_admissions_table.php
        Schema::table('student_admissions', function (Blueprint $table) {
            if (!Schema::hasColumn('student_admissions', 'email_otp')) {
                $table->string('email_otp')->nullable();
            }
            if (!Schema::hasColumn('student_admissions', 'phone_otp')) {
                $table->string('phone_otp')->nullable();
            }
            if (!Schema::hasColumn('student_admissions', 'email_verified')) {
                $table->boolean('email_verified')->default(false);
            }
            if (!Schema::hasColumn('student_admissions', 'phone_verified')) {
                $table->boolean('phone_verified')->default(false);
            }
            if (!Schema::hasColumn('student_admissions', 'otp_expires_at')) {
                $table->timestamp('otp_expires_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('student_admissions', function (Blueprint $table) {
            $columns = ['email_otp', 'phone_otp', 'email_verified', 'phone_verified', 'otp_expires_at'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('student_admissions', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
