<?php

namespace App\Exceptions;

use Exception;

class DatabaseException extends Exception
{
    public function __construct(
        string     $message = "Database error",
        int        $code = 500,
        ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
