<?php

declare(strict_types = 1);

namespace App\Models;

class TransactionsModel {
  public function moveFilesTo(array $filePaths, string $storagePath): void 
  {
    foreach($filePaths as $key=>$filePath)
    {
      echo $key;
      $to = $storagePath . '/' . $_FILES["transactions"]['name'];

      move_uploaded_file($filePath, $to);
    }
  }
}