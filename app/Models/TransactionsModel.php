<?php

declare(strict_types = 1);

namespace App\Models;

use App\Formaters\CurrencyFormater;
use App\Model;
use App\Utils\MathManager;
use NumberFormatter;

class TransactionsModel extends Model {
  public function __construct(protected array $transactionsData = [])
  {
  }

  public function setTransactionsData(array $transactionsData): static
  {
    $this->transactionsData = $transactionsData;

    return $this;
  }

  public function getTransactionsData(): array 
  {
    return $this->transactionsData;
  }

  public function uploadTransactionsDataToDB(): static 
  {

    return $this;
  }

  public function getTransactionsInfo(): array
  {
    $transactionsInfo = [];

    $transactionsInfo['totalExpense'] = CurrencyFormater::formatNumberToUSD($this->getTotalExpense());
    $transactionsInfo['totalIncome'] = CurrencyFormater::formatNumberToUSD($this->getTotalIncome());
    $transactionsInfo['netTotal'] = CurrencyFormater::formatNumberToUSD($this->getNetTotal());

    return $transactionsInfo;
  }

  public function getTotalIncome(): int|float {
    $numberArr = CurrencyFormater::currenciesToNumbers($this->transactionsData['Amount']);
    $posNumbers = MathManager::getPositiveNumbers($numberArr);
  
    return MathManager::getSum($posNumbers);
  }
  
  public function getTotalExpense(): int|float {
    $numberArr = CurrencyFormater::currenciesToNumbers($this->transactionsData['Amount']);;
    $negNumbers = MathManager::getNegativeNumbers($numberArr);
  
    return MathManager::getSum($negNumbers);
  }
  
  public function getNetTotal(): int|float {
    $totalIncome = $this->getTotalIncome();
    $totalExpense = $this->getTotalExpense();
  
    return $totalIncome + $totalExpense;
  }
}