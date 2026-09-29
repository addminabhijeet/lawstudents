<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'youtube')) {
                    if (Schema::hasColumn('users', 'twitter')) {
                        $table->string('youtube')->nullable()->after('twitter');
                    } else {
                        $table->string('youtube')->nullable();
                    }
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'youtube')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('youtube');
            });
        }
    }
};
