<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->id();

            // Relationship
            $table->foreignId('student_id')
                ->constrained('students')
                ->onDelete('cascade');

            // Personal Information
            $table->string('full_name');
            $table->date('dob')->nullable();
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('phone')->nullable();
            $table->string('alternate_phone')->nullable();

            // Address Information
            $table->text('address_line1')->nullable();
            $table->text('address_line2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('country')->nullable();

            // Identity Information
            $table->string('aadhaar_number')->nullable();
            $table->string('pan_number')->nullable();

            // Family Information
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_email')->nullable();

            // Educational Information
            $table->string('last_qualification')->nullable();
            $table->string('board_university')->nullable();
            $table->integer('passing_year')->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->string('course_duration')->nullable();
            $table->string('admission_session')->nullable();

            // Document Storage
            $table->text('photo')->nullable();
            $table->text('signature')->nullable();
            $table->text('marksheet')->nullable();
            $table->text('id_proof')->nullable();

            // Admission Status
            $table->enum('admission_status', ['pending', 'approved', 'rejected'])->default('pending');

            // Financial Information
            $table->decimal('paidamount', 12, 2)->default(0);
            $table->decimal('remamount', 12, 2)->default(0);
            $table->string('admno')->nullable();

            // Course Information
            $table->json('course_ids')->nullable();
            $table->decimal('discount_percent', 5, 2)->nullable();
            $table->decimal('discount', 12, 2)->nullable();

            // OTP Verification
            $table->string('email_otp')->nullable();
            $table->string('phone_otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->boolean('email_verified')->default(false);
            $table->boolean('phone_verified')->default(false);

            // Other
            $table->text('remarks')->nullable();
            $table->boolean('deleted')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_admissions');
    }
};
