<?php

namespace App\Exceptions;

use App\Repositories\ConfigSettings\StatusCodeSettings;
use Exception;
use Throwable;

class ValidatorErrorException extends Exception
{
    protected $code = StatusCodeSettings::STATUS_FORBIDDEN;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code > 0 ? $code : $this->code, $previous);
    }
}
