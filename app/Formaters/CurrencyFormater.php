<?php

declare(strict_types=1);

namespace App\Formaters;

class CurrencyFormater 
{
  public static function formatNumberToUSD(float $number): string {
    $result = '';
  
    if($number < 0) {
      $result = substr_replace((string) number_format($number, 2), "$", 1, 0);
    } else {
      $result = substr_replace((string) number_format($number, 2), "$", 0, 0);
    }
  
    return $result;
  }

  static public function currenciesToNumbers($currencies): array {
    $result = array_map(fn($el) => (float) str_replace(['$', ','], '', $el), $currencies);
  
    return $result;
  }
}
