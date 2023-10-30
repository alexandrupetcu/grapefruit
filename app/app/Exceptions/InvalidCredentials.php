<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidCredentials extends Exception
{
    public function __construct(
        string     $message = "Invalid Credentials",
        int        $code = 401,
        ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
