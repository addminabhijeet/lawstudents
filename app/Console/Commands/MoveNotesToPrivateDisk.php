<?php

namespace App\Console\Commands;

use App\Models\CourseNote;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * One-off move of paid course-note PDFs from the web-readable public disk to
 * the private disk. Safe to re-run: files already moved are skipped, and
 * CourseNote::absolutePath() reads from either disk in the meantime.
 */
class MoveNotesToPrivateDisk extends Command
{
    protected $signature = 'notes:move-to-private {--dry-run : List what would be moved without moving anything}';

    protected $description = 'Move course note PDFs from the public disk to the private disk';

    public function handle(): int
    {
        $public = Storage::disk('public');
        $private = Storage::disk(CourseNote::DISK);
        $dryRun = (bool) $this->option('dry-run');

        $moved = $skipped = $missing = 0;

        $paths = CourseNote::whereNotNull('file_path')->distinct()->pluck('file_path');

        foreach ($paths as $path) {
            if ($private->exists($path)) {
                $skipped++;

                continue;
            }

            if (! $public->exists($path)) {
                $missing++;
                $this->warn("Missing on both disks: {$path}");

                continue;
            }

            if (! $dryRun) {
                $private->writeStream($path, $public->readStream($path));

                if ($private->size($path) !== $public->size($path)) {
                    $this->error("Size mismatch after copy, left in place: {$path}");

                    continue;
                }

                $public->delete($path);
            }

            $moved++;
        }

        $verb = $dryRun ? 'Would move' : 'Moved';
        $this->info("{$verb} {$moved} file(s); {$skipped} already private; {$missing} missing.");

        return self::SUCCESS;
    }
}
