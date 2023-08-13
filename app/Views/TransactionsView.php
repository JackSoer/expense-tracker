<?php

declare(strict_types=1);

namespace App\Views;

use App\Formaters\CurrencyFormater;
use App\Formaters\DateFormater;
use App\View;

class TransactionsView extends View
{
  static public function renderTransactions(array $transactions): string {
    $result = '';
  
    for($i = 0; $i < count($transactions["Amount"]); $i++) {
      $rowContent = "";
      $keys = array_keys($transactions);
  
      foreach($keys as $key) {
        $element = $transactions[$key][$i];
  
        if($key === 'Amount') {
          if(CurrencyFormater::currenciesToNumbers([$element])[0] > 0) {
            $rowContent .= "<td style='color: green'>" . $element . "</td>";
          } else {
            $rowContent .= "<td style='color: red'>" . $element . "</td>";
          }
        } else if($key === 'Date') {
          $rowContent .= "<td>" . DateFormater::formatDate($element, 'M j\, Y') . "</td>";
        } else {
          $rowContent .= "<td>" . $element . "</td>";
        }
      }
  
      $row = "<tr>" . $rowContent . "</tr>";
      $result .= $row;
    }
  
    return $result;
  } 
}