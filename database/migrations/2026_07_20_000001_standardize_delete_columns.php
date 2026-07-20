<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Standardizes all delete columns to 'deleted' (0 = active, 1 = deleted)
     * This ensures consistency across all tables
     */
    public function up(): void
    {
        // Rename 'delete' column to 'deleted' in courses table if it exists
        if (Schema::hasTable('courses') && Schema::hasColumn('courses', 'delete')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->renameColumn('delete', 'deleted');
            });
        }

        // Rename 'delete' column to 'deleted' in categories table if it exists
        if (Schema::hasTable('categories') && Schema::hasColumn('categories', 'delete')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->renameColumn('delete', 'deleted');
            });
        }

        // Ensure course_notes table has 'deleted' column
        if (Schema::hasTable('course_notes') && !Schema::hasColumn('course_notes', 'deleted')) {
            Schema::table('course_notes', function (Blueprint $table) {
                if (Schema::hasColumn('course_notes', 'delete')) {
                    $table->renameColumn('delete', 'deleted');
                } else {
                    $table->tinyInteger('deleted')->default(0)->index();
                }
            });
        }

        // Ensure acts table has 'deleted' column
        if (Schema::hasTable('acts') && !Schema::hasColumn('acts', 'deleted')) {
            Schema::table('acts', function (Blueprint $table) {
                if (Schema::hasColumn('acts', 'delete')) {
                    $table->renameColumn('delete', 'deleted');
                } else {
                    $table->tinyInteger('deleted')->default(0)->index();
                }
            });
        }

        // Ensure rules table has 'deleted' column
        if (Schema::hasTable('rules') && !Schema::hasColumn('rules', 'deleted')) {
            Schema::table('rules', function (Blueprint $table) {
                if (Schema::hasColumn('rules', 'delete')) {
                    $table->renameColumn('delete', 'deleted');
                } else {
                    $table->tinyInteger('deleted')->default(0)->index();
                }
            });
        }

        // Ensure clienteles table has 'deleted' column
        if (Schema::hasTable('clienteles') && !Schema::hasColumn('clienteles', 'deleted')) {
            Schema::table('clienteles', function (Blueprint $table) {
                if (Schema::hasColumn('clienteles', 'delete')) {
                    $table->renameColumn('delete', 'deleted');
                } else {
                    $table->tinyInteger('deleted')->default(0)->index();
                }
            });
        }

        // Ensure copies table has 'deleted' column
        if (Schema::hasTable('copies') && !Schema::hasColumn('copies', 'deleted')) {
            Schema::table('copies', function (Blueprint $table) {
                if (Schema::hasColumn('copies', 'delete')) {
                    $table->renameColumn('delete', 'deleted');
                } else {
                    $table->tinyInteger('deleted')->default(0)->index();
                }
            });
        }

        // Ensure gallery table has 'deleted' column
        if (Schema::hasTable('galleries') && !Schema::hasColumn('galleries', 'deleted')) {
            Schema::table('galleries', function (Blueprint $table) {
                if (Schema::hasColumn('galleries', 'delete')) {
                    $table->renameColumn('delete', 'deleted');
                } else {
                    $table->tinyInteger('deleted')->default(0)->index();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rename 'deleted' back to 'delete' if needed
        $tables = ['courses', 'categories', 'course_notes', 'acts', 'rules', 'clienteles', 'copies'];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'deleted')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->renameColumn('deleted', 'delete');
                });
            }
        }
    }
};
