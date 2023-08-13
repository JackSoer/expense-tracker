<?php

declare(strict_types=1);

namespace App\Utils;

use App\Exceptions\IncorrectDirectiryException;
use Ramsey\Uuid\Uuid;

class FilesManager {
  static public function moveFilesFromTempDirTo(array $filePaths, array $fileNames, string $storagePath): static 
  {
    if(!is_dir(STORAGE_PATH)) {
      throw new IncorrectDirectiryException();
    }
  
    foreach($filePaths as $key=>$filePath)
    {
      if(is_file($filePath)) {
        $uuid =  Uuid::uuid4()->toString();
        $to = $storagePath . '/' . $uuid .  '_' . $fileNames[$key];
    
        move_uploaded_file($filePath, $to);
      }
    }
    
    return new static();
  }

  static public function getAllFilesNameInDir(string $dirPath, string $fileType = ''): array {
    if(!is_dir($dirPath)) {
      throw new IncorrectDirectiryException();
    }

    $pathInfo = scandir($dirPath);
  
    $fileNames = array_filter($pathInfo, fn($el) => is_file($dirPath . DIRECTORY_SEPARATOR . $el) && str_ends_with($el, $fileType));
  
    return $fileNames;
  }

  static public function convertCsvFilesInDirToArray(string $dirPath): array {
    if(!is_dir($dirPath)) {
      throw new IncorrectDirectiryException();
    }

    $fileNames = FilesManager::getAllFilesNameInDir($dirPath, '.csv');
    $result = [];
  
    foreach($fileNames as $fileName) {
      $file = fopen($dirPath . DIRECTORY_SEPARATOR . $fileName, 'r', true);
      $keys = fgetcsv($file);
  
        while(($line = fgetcsv($file)) !== false) {
          for($i = 0; $i < count($line); $i++) {
            $key = $keys[$i];
  
            if(key_exists($key, $result)) {
              $result[$key] = [...$result[$key], $line[$i]];
            } else {
              $result[$key] =[$line[$i]];
            }
          }
        }
  
      fclose($file);
    }
  
    return $result;
  }

  static public function deleteFilesFromFolder($folderPath): static 
  {
    $files = glob($folderPath . '/*');

    foreach($files as $file) 
    {
      if(is_file($file))
      {
        unlink($file);
      }
    }

    return new static();
  }

  static public function download($contentType, $fileName, $filePath): string
  {
    header("Contrent-Type: {$contentType}");
    header("Content-Disposition: attachment; filename={$fileName}");

    readfile($filePath);

    return '';
  }
}