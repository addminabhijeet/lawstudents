<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Add course_id if it doesn't exist
            if (!Schema::hasColumn('payments', 'course_id')) {
                $table->text('course_id')->nullable()->after('student_id');
            }

            // Add deleted column if it doesn't exist
            if (!Schema::hasColumn('payments', 'deleted')) {
                $table->boolean('deleted')->default(false)->after('save_payment');
            }

            // Add viewid column if it doesn't exist
            if (!Schema::hasColumn('payments', 'viewid')) {
                $table->boolean('viewid')->default(false)->after('deleted');
            }

            // Add paid_amount column if it doesn't exist
            if (!Schema::hasColumn('payments', 'paid_amount')) {
                $table->decimal('paid_amount', 12, 2)->default(0)->after('payment_status');
            }

            // Add remaining_amount column if it doesn't exist
            if (!Schema::hasColumn('payments', 'remaining_amount')) {
                $table->decimal('remaining_amount', 12, 2)->nullable()->after('paid_amount');
            }

            // Add discount_percent column if it doesn't exist
            if (!Schema::hasColumn('payments', 'discount_percent')) {
                $table->decimal('discount_percent', 5, 2)->nullable()->after('discount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $columns = ['course_id', 'deleted', 'viewid', 'paid_amount', 'remaining_amount', 'discount_percent'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('payments', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
