<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

/**
 * Page count and size of an uploaded PDF (storage/app/public/...), so a list can
 * say "Full text · 102 pages · 1.3 MB" instead of "PDF 1". Read-only: the file is
 * never changed. The result is cached per file version (path, size, modified time).
 */
class PdfInfo
{
    /** @return array{pages: int|null, bytes: int}|null */
    public static function describe(?string $relative): ?array
    {
        if (! $relative) {
            return null;
        }
        $path = storage_path('app/public/' . ltrim($relative, '/\\'));
        if (! is_file($path)) {
            return null;
        }

        $key = 'pdfinfo:' . md5($path . '|' . filesize($path) . '|' . filemtime($path));
        $read = fn () => ['pages' => self::countPages($path), 'bytes' => filesize($path)];

        try {
            return Cache::rememberForever($key, $read);
        } catch (\Throwable $e) {
            return $read();
        }
    }

    /** The largest /Count of a /Pages node, looking inside compressed object streams too. */
    private static function countPages(string $path): ?int
    {
        $data = @file_get_contents($path);
        if ($data === false) {
            return null;
        }

        $best = self::countIn($data);
        if ($best === null && preg_match_all('/stream\r?\n(.*?)\r?\nendstream/s', $data, $streams)) {
            foreach ($streams[1] as $raw) {
                $plain = @gzuncompress($raw);
                if ($plain === false) {
                    continue;
                }
                $n = self::countIn($plain);
                if ($n !== null) {
                    $best = max($best ?? 0, $n);
                }
            }
        }

        return $best;
    }

    private static function countIn(string $bytes): ?int
    {
        $found = null;
        foreach (['/\/Type\s*\/Pages\b[^>]*?\/Count\s+(\d+)/s', '/\/Count\s+(\d+)[^>]*?\/Type\s*\/Pages\b/s'] as $re) {
            if (preg_match_all($re, $bytes, $m)) {
                $found = max($found ?? 0, ...array_map('intval', $m[1]));
            }
        }

        return $found;
    }
}
