<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds indexes on foreign keys and status/delete columns for performance.
     */
    public function up(): void
    {
        // Most important indexes: foreign keys and frequently filtered columns
        // Using raw SQL to avoid issues with duplicate index names

        $connection = Schema::getConnection();
        $connection->statement("ALTER TABLE courses ADD INDEX idx_category_id (category_id)");
        $connection->statement("ALTER TABLE courses ADD INDEX idx_delete (delete)");
        $connection->statement("ALTER TABLE courses ADD INDEX idx_status (status)");

        $connection->statement("ALTER TABLE categories ADD INDEX idx_parent_id (parent_id)");
        $connection->statement("ALTER TABLE categories ADD INDEX idx_delete (delete)");
        $connection->statement("ALTER TABLE categories ADD INDEX idx_status (status)");

        $connection->statement("ALTER TABLE course_notes ADD INDEX idx_course_id (course_id)");
        $connection->statement("ALTER TABLE course_notes ADD INDEX idx_is_free (is_free)");
        $connection->statement("ALTER TABLE course_notes ADD INDEX idx_status (status)");

        $connection->statement("ALTER TABLE payments ADD INDEX idx_student_id (student_id)");
        $connection->statement("ALTER TABLE payments ADD INDEX idx_payment_status (payment_status)");

        $connection->statement("ALTER TABLE students ADD INDEX idx_delete (delete)");
        $connection->statement("ALTER TABLE student_admissions ADD INDEX idx_student_id (student_id)");
        $connection->statement("ALTER TABLE student_admissions ADD INDEX idx_deleted (deleted)");

        // Acts, Rules, Copys
        $connection->statement("ALTER TABLE acts ADD INDEX idx_category_id (category_id)");
        $connection->statement("ALTER TABLE acts ADD INDEX idx_subcategory_id (subcategory_id)");
        $connection->statement("ALTER TABLE acts ADD INDEX idx_delete (delete)");

        $connection->statement("ALTER TABLE rules ADD INDEX idx_category_id (category_id)");
        $connection->statement("ALTER TABLE rules ADD INDEX idx_subcategory_id (subcategory_id)");
        $connection->statement("ALTER TABLE rules ADD INDEX idx_delete (delete)");

        $connection->statement("ALTER TABLE copies ADD INDEX idx_category_id (category_id)");
        $connection->statement("ALTER TABLE copies ADD INDEX idx_subcategory_id (subcategory_id)");
        $connection->statement("ALTER TABLE copies ADD INDEX idx_delete (delete)");

        // Subcategories with domain-specific FKs
        $connection->statement("ALTER TABLE act_subcategories ADD INDEX idx_act_category_id (act_category_id)");
        $connection->statement("ALTER TABLE rule_subcategories ADD INDEX idx_rule_category_id (rule_category_id)");
        $connection->statement("ALTER TABLE copy_subcategories ADD INDEX idx_copy_category_id (copy_category_id)");

        // Categories
        $connection->statement("ALTER TABLE act_categories ADD INDEX idx_delete (delete)");
        $connection->statement("ALTER TABLE rule_categories ADD INDEX idx_delete (delete)");
        $connection->statement("ALTER TABLE copy_categories ADD INDEX idx_delete (delete)");

        // Other frequently-queried
        $connection->statement("ALTER TABLE contact_forms ADD INDEX idx_delete (delete)");
        $connection->statement("ALTER TABLE galleries ADD INDEX idx_group_name (group_name)");
        $connection->statement("ALTER TABLE galleries ADD INDEX idx_delete (delete)");
        $connection->statement("ALTER TABLE galleries ADD INDEX idx_status (status)");
        $connection->statement("ALTER TABLE site_pages ADD INDEX idx_slug (slug)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Indexes improve performance; not dropping them
    }
};
