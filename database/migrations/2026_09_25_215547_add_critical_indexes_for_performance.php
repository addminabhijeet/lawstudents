<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Add critical indexes for frequently-queried foreign keys and filter columns.
     */
    public function up(): void
    {
        $connection = Schema::getConnection();

        // Helper: safely add index by catching duplicate key errors
        $safeIndex = function ($table, $columns, $name) use ($connection) {
            try {
                if (is_array($columns)) {
                    $columnStr = implode(',', array_map(fn($c) => "`$c`", $columns));
                } else {
                    $columnStr = "`$columns`";
                }
                $connection->statement("ALTER TABLE `$table` ADD INDEX `$name` ($columnStr)");
            } catch (\Exception $e) {
                // Index likely already exists; continue
                if (strpos($e->getMessage(), 'Duplicate key name') === false) {
                    throw $e;
                }
            }
        };

        // Critical foreign key indexes (must exist)
        $safeIndex('courses', 'category_id', 'idx_courses_category');
        $safeIndex('categories', 'parent_id', 'idx_categories_parent');
        $safeIndex('course_notes', 'course_id', 'idx_notes_course');
        $safeIndex('payments', 'student_id', 'idx_payments_student');
        $safeIndex('payments', 'payment_status', 'idx_payments_status');
        $safeIndex('student_admissions', 'student_id', 'idx_admissions_student');

        // Acts, Rules, Copys - core domain indexes
        foreach (['acts', 'rules', 'copies'] as $table) {
            $safeIndex($table, 'category_id', "idx_{$table}_category");
            $safeIndex($table, 'subcategory_id', "idx_{$table}_subcategory");
        }

        // Subcategory foreign keys
        $safeIndex('act_subcategories', 'act_category_id', 'idx_act_sub_category');
        $safeIndex('rule_subcategories', 'rule_category_id', 'idx_rule_sub_category');
        $safeIndex('copy_subcategories', 'copy_category_id', 'idx_copy_sub_category');

        // Other likely-to-exist columns
        $safeIndex('site_pages', 'slug', 'idx_pages_slug');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep indexes for performance; don't drop them
    }
};
