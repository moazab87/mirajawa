<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ModelNotFoundException extends Exception
{
    // Optional: Override the constructor to provide a default message or code
    public function __construct($message = "Model not found", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
