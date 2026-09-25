<?php

namespace App\Exceptions;

use Exception;

class InvalidSearchException extends Exception
{
    public const INVALID_QUERY = 'invalid_query';
    public const QUERY_TOO_SHORT = 'query_too_short';
    public const QUERY_TOO_LONG = 'query_too_long';
    public const INVALID_FILTER = 'invalid_filter';
    public const SQL_INJECTION_DETECTED = 'sql_injection_detected';
    public const MALICIOUS_PATTERN = 'malicious_pattern';

    protected $code = 'search_error';

    public function __construct(string $message = '', string $type = self::INVALID_QUERY, int $status = 422)
    {
        parent::__construct($message ?: $this->getDefaultMessage($type), $status);
        $this->code = $type;
    }

    private function getDefaultMessage(string $type): string
    {
        return match($type) {
            self::INVALID_QUERY => 'Invalid search query.',
            self::QUERY_TOO_SHORT => 'Search query must be at least 3 characters.',
            self::QUERY_TOO_LONG => 'Search query is too long (max 255 characters).',
            self::INVALID_FILTER => 'Invalid filter specified.',
            self::SQL_INJECTION_DETECTED => 'Invalid search parameters detected.',
            self::MALICIOUS_PATTERN => 'Search contains suspicious patterns.',
            default => 'Search error occurred.',
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
