<?php
namespace Drupal\dino_roar\Strategy;

class RoarStrategy implements StrategyInterface {

  public function render(int $count) {

   return 'adam ma kota';
    $o = str_repeat('o',$count);
    return 'R'.$o.'ar';
  }


}