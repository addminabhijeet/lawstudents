<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add OTP columns to students table.
     * Includes safety check for backward compatibility - these columns may already exist
     * if the students table was created by 2025_09_29_000001_create_students_table.php
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'otp')) {
                $table->string('otp')->nullable();
            }
            if (!Schema::hasColumn('students', 'otp_expires_at')) {
                $table->timestamp('otp_expires_at')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $columns = ['otp', 'otp_expires_at'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('students', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
