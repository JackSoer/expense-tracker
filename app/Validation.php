<?php

declare(strict_types=1);

namespace App;

class Validation {
  static public function typeFiles(array $fileNames, string $fileType): bool
  {
    if($fileType[0] !== '.') {
      $fileType = '.' . $fileType;
    }

    foreach($fileNames as $filePath)
    {
      if(!str_ends_with($filePath, $fileType))
      {
        return false;
      }
    }

    return true;
  }
}