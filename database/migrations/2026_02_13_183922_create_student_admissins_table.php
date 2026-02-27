<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('student_admissions', function (Blueprint $table) {
            $table->string('email_otp')->nullable();
            $table->string('phone_otp')->nullable();
            $table->boolean('email_verified')->default(false);
            $table->boolean('phone_verified')->default(false);
            $table->timestamp('otp_expires_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('student_admissions', function (Blueprint $table) {
            $table->dropColumn([
                'email_otp',
                'phone_otp',
                'email_verified',
                'phone_verified',
                'otp_expires_at'
            ]);
        });
    }
};
