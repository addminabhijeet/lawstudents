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
        Schema::create('legal_knowledge_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('legal_knowledge_categories')
                ->onDelete('cascade');
            $table->foreignId('subcategory_id')
                ->constrained('legal_knowledge_subcategories')
                ->onDelete('cascade');
            $table->text('description')->nullable();
            $table->json('pdfs')->nullable(); // same as Rules: array of stored PDF paths
            $table->tinyInteger('delete')->default(1); // 1 = visible, 0 = soft-deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_knowledge_notes');
    }
};
