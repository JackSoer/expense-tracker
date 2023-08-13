<?php

declare(strict_types=1);

namespace App\Formaters;

class DateFormater 
{
  public static function formatDate(string $date, string $format): string {
    $timestamp = strtotime($date);
    $formatedDate = date('M j\, Y', $timestamp);
  
    return $formatedDate;
  }
}