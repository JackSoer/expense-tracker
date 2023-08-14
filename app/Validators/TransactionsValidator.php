<?php

declare(strict_types=1);

namespace App\Validators;

class TransactionsValidator 
{
  static public function isProperTransactionsData(array $transactions): bool
  {
    $columnNames = array_keys($transactions);
    $properColumnNames = ['Date', 'Check #', 'Description', 'Amount'];

    if(array_diff($columnNames, $properColumnNames))
    {
      return false;
    }

    return true;
  }
}