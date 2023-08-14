<?php

declare(strict_types=1);

namespace App\Validators;

class FilesValidator 
{
  static public function typeFiles(array $fileNames, string $fileType): bool
  {
    if($fileType[0] !== '.') {
      $fileType = '.' . $fileType;
    }

    foreach($fileNames as $fileName)
    {
      if(!str_ends_with($fileName, $fileType))
      {
        return false;
      }
    }

    return true;
  }
}