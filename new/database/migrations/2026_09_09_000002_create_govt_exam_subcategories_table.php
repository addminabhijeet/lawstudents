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
        Schema::create('govt_exam_subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('govt_exam_category_id')
                ->constrained('govt_exam_categories')
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
        Schema::dropIfExists('govt_exam_subcategories');
    }
};
