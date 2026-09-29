<?php

namespace App\Support;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

/** Shared, bounded server-side pagination for administrative workspaces. */
final class AdminListing
{
    public const PAGE_SIZES = [10, 25, 50, 100];

    public static function perPage(Request $request, int $default = 25): int
    {
        $value = $request->query('per_page', $default);
        $size = is_scalar($value) ? filter_var($value, FILTER_VALIDATE_INT) : false;

        return in_array($size, self::PAGE_SIZES, true) ? $size : $default;
    }

    public static function paginate($query, Request $request, int $default = 25, string $pageName = 'page'): LengthAwarePaginator
    {
        $value = $request->query($pageName, 1);
        $page = is_scalar($value) ? filter_var($value, FILTER_VALIDATE_INT) : false;
        $size = self::perPage($request, $default);
        $counter = clone $query;
        $total = $counter instanceof \Illuminate\Database\Eloquent\Builder
            ? $counter->toBase()->getCountForPagination()
            : $counter->getCountForPagination();
        // Clamp before issuing the record query, including extremely large page inputs.
        $page = min(max(1, $page ?: 1), max(1, (int) ceil($total / $size)));

        return (clone $query)->paginate($size, ['*'], $pageName, $page, $total)
            ->appends($request->query())->onEachSide(1);
    }
}
