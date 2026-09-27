<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Writes a light WebP copy next to each PNG / JPEG upload, e.g.
 * storage/app/public/thumbnails/abc.png -> abc.webp. Originals are never touched;
 * files that already have a copy are skipped. The course page uses a copy when one
 * exists (resources/views/course/course.blade.php, public/assets/theme/js/course.js).
 *
 *   php artisan images:webp                 (course thumbnails)
 *   php artisan images:webp gallery --width=1200
 */
class MakeWebpImages extends Command
{
    protected $signature = 'images:webp {folder=thumbnails : Folder inside storage/app/public}
                            {--width=800 : Largest width to keep, in pixels}
                            {--quality=80 : WebP quality, 1-100}';

    protected $description = 'Create WebP copies of the PNG / JPEG uploads in a storage/app/public folder';

    public function handle(): int
    {
        if (! function_exists('imagewebp')) {
            $this->error('This PHP build has no WebP support in GD.');
            return self::FAILURE;
        }

        $dir = storage_path('app/public/' . trim($this->argument('folder'), '/\\'));
        if (! is_dir($dir)) {
            $this->error("No such folder: {$dir}");
            return self::FAILURE;
        }

        $maxWidth = max(1, (int) $this->option('width'));
        $quality = min(100, max(1, (int) $this->option('quality')));
        $made = 0;

        foreach (glob($dir . DIRECTORY_SEPARATOR . '*.{png,PNG,jpg,JPG,jpeg,JPEG}', GLOB_BRACE) as $file) {
            $target = preg_replace('/\.(png|jpe?g)$/i', '.webp', $file);
            if (is_file($target)) {
                continue;
            }

            $image = preg_match('/\.png$/i', $file) ? @imagecreatefrompng($file) : @imagecreatefromjpeg($file);
            if (! $image) {
                $this->warn('Skipped (unreadable): ' . basename($file));
                continue;
            }

            if (imagesx($image) > $maxWidth) {
                $scaled = imagescale($image, $maxWidth);
                imagedestroy($image);
                $image = $scaled;
            }
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);

            if (imagewebp($image, $target, $quality)) {
                $made++;
                $this->line(sprintf('%s  %dKB -> %dKB', basename($target), filesize($file) / 1024, filesize($target) / 1024));
            }
            imagedestroy($image);
        }

        $this->info("{$made} WebP " . ($made === 1 ? 'copy' : 'copies') . ' written.');
        return self::SUCCESS;
    }
}
