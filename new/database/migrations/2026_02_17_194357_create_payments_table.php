<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Relationship
            $table->foreignId('student_id')
                ->constrained('students')
                ->onDelete('cascade');

            // Invoice Info
            $table->string('invoice_label')->nullable();
            $table->string('invoice_number')->unique();
            $table->string('invoice_product')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();

            // Billing From
            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('from_phone')->nullable();
            $table->text('from_address')->nullable();

            // Billing To
            $table->string('to_name')->nullable();
            $table->string('to_email')->nullable();
            $table->string('to_phone')->nullable();
            $table->text('to_address')->nullable();

            // Items (store as JSON)
            $table->json('items')->nullable();

            // Calculation
            $table->decimal('sub_total', 12, 2)->default(0);
            $table->decimal('tax_percentage', 5, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2)->default(0);

            // Currency
            $table->string('currency', 10)->default('INR');

            // Payment
            $table->enum('payment_method', ['debit_card', 'paypal'])->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'cancelled'])
                ->default('pending');

            // Extra
            $table->text('invoice_note')->nullable();
            $table->boolean('late_fees')->default(false);
            $table->boolean('client_note_enabled')->default(false);
            $table->boolean('save_payment')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
