<?php

declare(strict_types = 1);

namespace App\Models;

use App\Formaters\CurrencyFormater;
use App\Formaters\DateFormater;
use App\Model;
use App\Utils\MathManager;

class TransactionsModel extends Model {
  public function __construct(protected array $transactionsData = [])
  {
    parent::__construct();
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

  public function uploadTransactionsDataIntoDB(): static 
  {
    $transactionColumnNames = array_keys($this->transactionsData);
    $transactionDataColumnLenght = count($this->transactionsData['Amount']);

    for($i = 0; $i < $transactionDataColumnLenght - 1; $i++) 
    {
      $transaction = [];

      foreach($transactionColumnNames as $transactionColumnName)
      {
        $transaction[$transactionColumnName] = $this->transactionsData[$transactionColumnName][$i];
      }

      $this->uploadTransactionIntoDB($transaction);
    }

    return $this;
  }

  public function uploadTransactionIntoDB(array $values): static 
  {
    try {
      $query = 'INSERT INTO transactions (transactionDate, transactionCheck, description, amount)
      VALUES (:transactionDate, :transactionCheck, :description, :amount)';

      $stmt = $this->db->prepare($query);

      $stmt->execute(
        [
          'transactionDate' => DateFormater::formatDate($values['Date'], 'Y-m-d H:m:i'),
          'transactionCheck' => $values['Check #'],
          'description' => $values['Description'],
          'amount' => CurrencyFormater::currenciesToNumbers([$values['Amount']])[0],
        ]
      );
    } catch(\PDOException $err) {
      throw new \PDOException($err->getMessage());
    }

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