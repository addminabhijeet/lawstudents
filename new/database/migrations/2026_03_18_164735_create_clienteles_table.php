<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clienteles', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable(); // Unlimited description
            $table->json('pdfs')->nullable();           // Multiple PDF paths as JSON
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clienteles');
    }
};