<?php

declare(strict_types = 1);

namespace App\Exceptions;

class ItsNotANumberException extends \Exception
{
    protected $message = "It's not a number";
}
