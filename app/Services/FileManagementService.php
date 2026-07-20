<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class FileManagementService
{
    /**
     * Safely delete file using Laravel Storage facade instead of unlink()
     *
     * @param string $filePath
     * @param string $disk
     * @return bool
     */
    public static function deleteFile(string $filePath, string $disk = 'public'): bool
    {
        try {
            if (Storage::disk($disk)->exists($filePath)) {
                return Storage::disk($disk)->delete($filePath);
            }
            return false;
        } catch (\Exception $e) {
            \Log::error("File deletion error: {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Replace file (delete old, store new)
     *
     * @param \Illuminate\Http\UploadedFile $newFile
     * @param string $oldFilePath
     * @param string $directory
     * @param string $disk
     * @return string|null
     */
    public static function replaceFile($newFile, string $oldFilePath, string $directory, string $disk = 'public'): ?string
    {
        // Delete old file if exists
        if ($oldFilePath) {
            self::deleteFile($oldFilePath, $disk);
        }

        // Store new file
        try {
            return $newFile->store($directory, $disk);
        } catch (\Exception $e) {
            \Log::error("File storage error: {$e->getMessage()}");
            return null;
        }
    }

    /**
     * Delete multiple files associated with a model
     *
     * @param Model $model
     * @param array $fileColumns
     * @param string $disk
     * @return void
     */
    public static function deleteModelFiles(Model $model, array $fileColumns, string $disk = 'public'): void
    {
        foreach ($fileColumns as $column) {
            if ($model->{$column}) {
                self::deleteFile($model->{$column}, $disk);
            }
        }
    }

    /**
     * Validate file size
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param int $maxSizeKB
     * @return bool
     */
    public static function isValidFileSize($file, int $maxSizeKB): bool
    {
        return $file->getSize() <= ($maxSizeKB * 1024);
    }
}
