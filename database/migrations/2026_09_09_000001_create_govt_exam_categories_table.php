<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// New, standalone feature: "Centre & State Govt. Examination".
// Mirrors the Rules feature's structure/behaviour without touching the
// rules/rule_categories/rule_subcategories tables or their migrations.
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('govt_exam_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('delete')->default(1); // 1 = visible, 0 = soft-deleted (same convention as rule_categories)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('govt_exam_categories');
    }
};
