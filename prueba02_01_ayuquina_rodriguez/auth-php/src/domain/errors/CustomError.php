<?php
namespace Domain\Errors;

use Exception;

class CustomError extends Exception {

    public int $statusCode;

    public function __construct(int $statusCode, string $message) {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public static function badRequest(string $message): self {
        return new self(400, $message);
    }

    public static function unauthorized(string $message): self {
        return new self(401, $message);
    }

    public static function forbidden(string $message): self {
        return new self(403, $message);
    }

    public static function notFound(string $message): self {
        return new self(404, $message);
    }

    public static function internalServer(string $message = 'Internal Server Error'): self {
        return new self(500, $message);
    }
}
