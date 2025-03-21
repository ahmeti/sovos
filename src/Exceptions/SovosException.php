<?php

namespace Ahmeti\Sovos\Exceptions;

use Exception;
use Throwable;

class SovosException extends Exception
{
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
