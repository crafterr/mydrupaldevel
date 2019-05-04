<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 04/05/2019
 * Time: 16:06
 */

namespace Drupal\dino_roar\Strategy;


class IterationStrategy implements StrategyInterface {

  public function render(int $count) {
    $i = 0;
    $tablica = [];
    while ($i<$count) {
      $i++;
      $tablica[$i] = $i;
    }
    return $tablica;
  }



}