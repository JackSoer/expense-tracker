<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Exceptions\IncorrectFileTypesException;
use App\Formaters\CurrencyFormater;
use App\Models\TransactionsModel;
use App\Utils\FilesManager;
use App\Validators\FilesValidator;
use App\View;
use App\Views\TransactionsView;

class TransactionsController
{
    public function __construct(private TransactionsModel $transactionsModel = new TransactionsModel())
    {

    }

    public function index(): View
    {
      $this->setTransactionsData();

      $this->transactionsModel->uploadTransactionsDataIntoDB();

      FilesManager::deleteFilesFromFolder(STORAGE_PATH);

      $transactionsInfo = $this->transactionsModel->getTransactionsInfo();
      $transactionsInfo['table'] = TransactionsView::renderTransactions($this->transactionsModel->getTransactionsData());

      return TransactionsView::make('transactions/transactions', $transactionsInfo);
    }

    public function setTransactionsData(): static {
      $fileNames = $_FILES["transactions"]['name'];
      $filePaths = $_FILES["transactions"]['tmp_name'];
    
      if(!FilesValidator::typeFiles($fileNames, 'csv')) 
      {
        throw new IncorrectFileTypesException();
      }
      
      FilesManager::moveFilesFromTempDirTo($filePaths, $fileNames, STORAGE_PATH);

      $transactionsData = FilesManager::convertCsvFilesInDirToArray(STORAGE_PATH);

      $this->transactionsModel->setTransactionsData($transactionsData);

      return $this;
    }
}
