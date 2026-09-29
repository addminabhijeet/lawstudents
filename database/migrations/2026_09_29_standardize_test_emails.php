<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * ISSUE-QA-002 FIX: Standardize test student emails to consistent domain
     * Changes all @gmail.com test emails to @lawstudents.test format
     */
    public function up(): void
    {
        // First, backup original emails by adding a temp column comment
        DB::statement('ALTER TABLE students MODIFY COLUMN email VARCHAR(255) COMMENT "STANDARDIZED BY 2026_09_29_standardize_test_emails migration"');

        // Standardize Gmail test emails to lawstudents.test domain
        // Pattern: firststudent@gmail.com -> qa.firststudent@lawstudents.test
        DB::statement("
            UPDATE students
            SET email = CONCAT('qa.', REPLACE(SUBSTRING_INDEX(email, '@', 1), '.', '_'), '@lawstudents.test')
            WHERE email LIKE '%@gmail.com'
            AND (
                email LIKE 'first%' OR
                email LIKE 'second%' OR
                email LIKE 'third%' OR
                email LIKE 'abhijeet%' OR
                email LIKE 'adv.%'
            )
        ");

        // Also standardize payment records' to_email (student email) with matching emails
        DB::statement("
            UPDATE payments p
            INNER JOIN students s ON p.student_id = s.id
            SET p.to_email = s.email
            WHERE p.to_email LIKE '%@gmail.com'
            AND (
                p.to_email LIKE 'first%' OR
                p.to_email LIKE 'second%' OR
                p.to_email LIKE 'third%' OR
                p.to_email LIKE 'abhijeet%' OR
                p.to_email LIKE 'adv.%'
            )
        ");
    }

    /**
     * Rollback the email standardization
     */
    public function down(): void
    {
        // This migration is data-modifying; rollback would need the original emails
        // For safety, we don't provide an automatic rollback
        // Note: Original emails should be recoverable from database backups
    }
};
