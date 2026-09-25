<?php

namespace App\Services;

use App\Exceptions\FileUploadException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;

class FileManagementService
{
    /**
     * Validate uploaded file
     */
    public static function validateFile(UploadedFile $file, string $type = 'document'): bool
    {
        // Check file size
        $maxSize = config('file-management.max_upload_size_mb') * 1024 * 1024;
        if ($file->getSize() > $maxSize) {
            throw new FileUploadException(
                'File exceeds maximum size of ' . config('file-management.max_upload_size_mb') . 'MB',
                FileUploadException::FILE_TOO_LARGE
            );
        }

        // Check file type
        $allowedTypes = $type === 'image'
            ? config('file-management.allowed_image_types')
            : config('file-management.allowed_document_types');

        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $allowedTypes)) {
            throw new FileUploadException(
                'File type not allowed. Allowed types: ' . implode(', ', $allowedTypes),
                FileUploadException::INVALID_FILE_TYPE
            );
        }

        return true;
    }

    /**
     * Store uploaded file securely
     */
    public static function storeFile(UploadedFile $file, string $directory, string $disk = 'local'): string
    {
        try {
            self::validateFile($file);

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($directory, $filename, $disk);

            Log::info('File uploaded', ['path' => $path, 'size' => $file->getSize()]);

            return $path;
        } catch (FileUploadException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('File storage error', ['error' => $e->getMessage()]);
            throw new FileUploadException('Failed to upload file', FileUploadException::UPLOAD_FAILED);
        }
    }

    /**
     * Get signed URL for file download
     */
    public static function getSignedUrl(string $filePath, int $expirationMinutes = 60): string
    {
        $disk = config('file-management.disk');

        if ($disk === 'local') {
            return Storage::disk($disk)->temporaryUrl(
                $filePath,
                now()->addMinutes($expirationMinutes)
            );
        }

        // For cloud storage (S3, etc.)
        return Storage::disk($disk)->temporaryUrl(
            $filePath,
            now()->addMinutes($expirationMinutes)
        );
    }

    /**
     * Safely delete file using Laravel Storage facade instead of unlink()
     */
    public static function deleteFile(string $filePath, string $disk = 'local'): bool
    {
        try {
            if (Storage::disk($disk)->exists($filePath)) {
                return Storage::disk($disk)->delete($filePath);
            }
            return false;
        } catch (\Exception $e) {
            Log::error('File deletion error', ['path' => $filePath, 'error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Replace file (delete old, store new)
     */
    public static function replaceFile(UploadedFile $newFile, string $oldFilePath, string $directory, string $disk = 'local'): ?string
    {
        try {
            // Delete old file if exists
            if ($oldFilePath) {
                self::deleteFile($oldFilePath, $disk);
            }

            // Store new file
            return self::storeFile($newFile, $directory, $disk);
        } catch (\Exception $e) {
            Log::error('File replacement error', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Delete multiple files associated with a model
     */
    public static function deleteModelFiles(Model $model, array $fileColumns, string $disk = 'local'): void
    {
        foreach ($fileColumns as $column) {
            if ($model->{$column}) {
                self::deleteFile($model->{$column}, $disk);
            }
        }
    }

    /**
     * Validate file size
     */
    public static function isValidFileSize(UploadedFile $file, int $maxSizeMB): bool
    {
        return $file->getSize() <= ($maxSizeMB * 1024 * 1024);
    }

    /**
     * Get file information
     */
    public static function getFileInfo(string $filePath, string $disk = 'local'): array
    {
        try {
            return [
                'exists' => Storage::disk($disk)->exists($filePath),
                'size' => Storage::disk($disk)->size($filePath),
                'last_modified' => Storage::disk($disk)->lastModified($filePath),
                'mime_type' => Storage::disk($disk)->mimeType($filePath),
            ];
        } catch (\Exception $e) {
            Log::error('Error getting file info', ['path' => $filePath, 'error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Copy file
     */
    public static function copyFile(string $sourcePath, string $destinationPath, string $disk = 'local'): bool
    {
        try {
            if (!Storage::disk($disk)->exists($sourcePath)) {
                return false;
            }

            $content = Storage::disk($disk)->get($sourcePath);
            return Storage::disk($disk)->put($destinationPath, $content);
        } catch (\Exception $e) {
            Log::error('File copy error', ['error' => $e->getMessage()]);
            return false;
        }
    }
}
