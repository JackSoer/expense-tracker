<?php

declare(strict_types = 1);

namespace App\Exceptions;

class IncorrectFileTypesException extends \Exception
{
    protected $message = "An Incorrect Files Type";
}
