<?php

declare(strict_types = 1);

namespace App\Exceptions;

class IncorrectTransactionsContentException extends \Exception
{
  protected $message = "An Incorrect Transactions Content";
}