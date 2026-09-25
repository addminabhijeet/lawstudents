<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class UploadName
{
    /**
     * Storage name for an upload: the client's base name (kept readable for
     * the admin screens that display it) with unsafe characters removed, and
     * an extension taken from the file's real content rather than the
     * client's name, so e.g. a PDF uploaded as "x.html" is stored as "x.pdf".
     */
    public static function safe(UploadedFile $file, bool $unique = true): string
    {
        $base = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $base = trim(preg_replace('/[^\pL\pN _()\-]+/u', '', $base));
        $base = mb_substr($base, 0, 120) ?: 'file';

        $extension = $file->guessExtension() ?: 'bin';

        return ($unique ? uniqid().'_' : '').$base.'.'.$extension;
    }
}
