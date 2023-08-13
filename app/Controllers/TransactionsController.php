<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Exceptions\IncorrectFileTypesException;
use App\Models\TransactionsModel;
use App\Validation;
use App\View;

class TransactionsController
{
    public function __construct(private TransactionsModel $transactionsModel = new TransactionsModel())
    {

    }

    public function index(): View
    {
      $fileNames = $_FILES["transactions"]['name'];
      
      if(!Validation::typeFiles($fileNames, 'csv')) 
      {
        throw new IncorrectFileTypesException();
      }

      $filePaths = $_FILES["transactions"]['tmp_name'];

      $this->transactionsModel->moveFilesTo($filePaths, STORAGE_PATH);

      return View::make('transactions/transactions');
    }
}
