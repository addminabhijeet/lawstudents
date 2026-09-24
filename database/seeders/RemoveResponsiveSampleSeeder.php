<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Removes the rows added by ResponsiveSampleSeeder (and nothing else).
 *
 * php artisan db:seed --class=RemoveResponsiveSampleSeeder
 */
class RemoveResponsiveSampleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contact_forms')
            ->where('email', 'like', '%' . ResponsiveSampleSeeder::EMAIL_DOMAIN)
            ->delete();

        // Children first (deepest level has the highest id).
        DB::table('categories')
            ->where('slug', 'like', ResponsiveSampleSeeder::SLUG_PREFIX . '%')
            ->orderByDesc('id')
            ->get(['id'])
            ->each(fn ($row) => DB::table('categories')->where('id', $row->id)->delete());
    }
}
