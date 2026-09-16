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
        Schema::create('legal_knowledge_subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('legal_knowledge_category_id');
            $table->foreign('legal_knowledge_category_id', 'fk_lk_subcategories_category_id')
                ->references('id')->on('legal_knowledge_categories')
                ->onDelete('cascade');
            $table->tinyInteger('delete')->default(1); // 1 = visible, 0 = soft-deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_knowledge_subcategories');
    }
};
