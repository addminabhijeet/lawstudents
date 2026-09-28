<?php

namespace App\Support;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

/**
 * Who still owes fees, for the dashboard, the menu badge and the Fees Due page.
 *
 * The panel already treats a student's newest invoice as the one that counts (the
 * payment update logic works on the "latest payment"), so a student owes money when
 * that newest, not-deleted invoice is pending or part-paid. One row per student, so
 * a part-paid invoice and the "remaining payment" created from it are not counted twice.
 * Read only.
 */
class FeeDues
{
    /** SQL for what is still to pay on an invoice. */
    public const REMAINING = 'COALESCE(remaining_amount, grand_total - COALESCE(paid_amount, 0))';

    /** Each student's newest unpaid or part-paid invoice. */
    public static function query(): Builder
    {
        $newest = Payment::query()->where('deleted', 0)->selectRaw('MAX(id)')->groupBy('student_id');

        return Payment::query()
            ->whereIn('id', $newest)
            ->whereIn('payment_status', ['pending', 'partial']);
    }

    public static function overdue(): Builder
    {
        return self::query()->whereNotNull('due_date')->where('due_date', '<', now()->toDateString());
    }

    public static function dueSoon(int $days = 7): Builder
    {
        return self::query()->whereNotNull('due_date')
            ->whereBetween('due_date', [now()->toDateString(), now()->addDays($days)->toDateString()]);
    }

    public static function undated(): Builder
    {
        return self::query()->whereNull('due_date');
    }

    /** Rows and total still to collect for a query built above. */
    public static function totals(Builder $query): array
    {
        $row = (clone $query)->selectRaw('COUNT(*) as n, COALESCE(SUM('.self::REMAINING.'), 0) as due')->first();

        return ['count' => (int) $row->n, 'amount' => (float) $row->due];
    }
}
