<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_events', function (Blueprint $table) {
            $table->id();
            $table->uuid('event_id')->unique();
            $table->uuid('request_id')->index();
            $table->uuid('visitor_id')->nullable()->index();
            $table->uuid('visit_id')->nullable()->index();
            $table->uuid('page_id')->nullable()->index();
            $table->string('actor_type', 20)->default('visitor');
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable()->index();
            $table->string('panel', 20);
            $table->string('source', 20);
            $table->string('event', 60)->index();
            $table->string('route_name')->nullable();
            $table->string('path', 500);
            $table->string('method', 10)->nullable();
            $table->unsignedSmallInteger('status_code')->nullable();
            $table->unsignedInteger('duration_ms')->nullable();
            $table->string('subject_type', 80)->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('occurred_at', 3)->index();
            $table->timestamp('created_at', 3)->useCurrent();
            $table->index(['actor_type', 'actor_id', 'occurred_at'], 'activity_actor_time');
            $table->index(['panel', 'occurred_at']);
            $table->index(['subject_type', 'subject_id']);
        });

        Schema::create('admission_leads', function (Blueprint $table) {
            $table->id();
            $table->uuid('visitor_id')->nullable()->index();
            $table->unsignedBigInteger('contact_form_id')->nullable()->unique();
            $table->unsignedBigInteger('student_id')->nullable()->index();
            $table->unsignedBigInteger('assigned_admin_id')->nullable()->index();
            $table->string('name', 150);
            $table->string('email', 150)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('course_interest', 150)->nullable();
            $table->string('source', 40);
            $table->string('status', 30)->default('new')->index();
            $table->timestamp('consent_at')->nullable();
            $table->timestamp('submitted_at')->index();
            $table->timestamp('first_response_at')->nullable();
            $table->timestamp('next_follow_up_at')->nullable()->index();
            $table->timestamp('enrolled_at')->nullable();
            $table->timestamps();
        });

        Schema::create('lead_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admission_lead_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('admin_id')->index();
            $table->string('outcome', 40);
            $table->text('note')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_follow_ups');
        Schema::dropIfExists('admission_leads');
        Schema::dropIfExists('activity_events');
    }
};
