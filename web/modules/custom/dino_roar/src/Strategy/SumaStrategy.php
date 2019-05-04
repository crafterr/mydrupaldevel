<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 04/05/2019
 * Time: 16:19
 */

namespace Drupal\dino_roar\Strategy;


class SumaStrategy implements StrategyInterface {

  public function render(int $count) {
    $i = 0;
    $tablica = [];
    while ($i<$count) {
      $tablica[$i] = $i+1;
      $i++;
    }
    $j=0;
    $suma = 0;
    while ($j<count($tablica)) {
      $suma = $suma + $tablica[$j];
      $j++;
    }
    return $suma;
  }

}