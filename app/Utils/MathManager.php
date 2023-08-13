<?php

declare(strict_types=1);

namespace App\Utils;

use App\Validators\NumbersValidator;

class MathManager {
  public static function getPositiveNumbers(array $arr): array {
    return array_filter($arr, fn($number) => NumbersValidator::isPositiveNumber($number));
  }

  public static function getNegativeNumbers(array $arr): array {
    return array_filter($arr, fn($number) => !NumbersValidator::isPositiveNumber($number));
  }

  public static function getSum(array $arr): int|float {
    $sum = array_reduce($arr, fn($prev, $next) => $prev + $next, 0);

    return $sum;
  }
}