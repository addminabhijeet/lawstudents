<?php

namespace App\Exceptions;

use Exception;

class FileUploadException extends Exception
{
    public const INVALID_FILE_TYPE = 'invalid_file_type';
    public const FILE_TOO_LARGE = 'file_too_large';
    public const UPLOAD_FAILED = 'upload_failed';
    public const MALWARE_DETECTED = 'malware_detected';
    public const STORAGE_ERROR = 'storage_error';

    protected $code = 'file_upload_error';

    public function __construct(string $message = '', string $type = self::UPLOAD_FAILED, int $status = 422)
    {
        parent::__construct($message ?: $this->getDefaultMessage($type), $status);
        $this->code = $type;
    }

    private function getDefaultMessage(string $type): string
    {
        return match($type) {
            self::INVALID_FILE_TYPE => 'File type not allowed. Please upload a valid file.',
            self::FILE_TOO_LARGE => 'File size exceeds maximum limit.',
            self::UPLOAD_FAILED => 'File upload failed. Please try again.',
            self::MALWARE_DETECTED => 'File contains malware and cannot be uploaded.',
            self::STORAGE_ERROR => 'Storage error occurred. Please try again later.',
            default => 'An error occurred while uploading the file.',
        };
    }

    public function render()
    {
        return response()->json([
            'success' => false,
            'message' => $this->message,
            'error' => $this->code,
        ], $this->code);
    }
}
