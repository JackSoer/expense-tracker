<?php

declare(strict_types=1);

namespace App\Validators;

use App\Exceptions\ItsNotANumberException;

class NumbersValidator {
  static public function isPositiveNumber(int|float $number): bool|string {
    if(is_nan($number)) {
      throw new ItsNotANumberException();
    }
  
    if($number > 0) {
      return true;
    } else {
      return false;
    }
  }
}