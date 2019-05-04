<?php

namespace Drupal\dino_roar;

use Drupal\dino_roar\Strategy\StrategyInterface;

/**
 * Interface RoarGeneratorInterface.
 */
interface RoarGeneratorInterface {

  public function getRoar(int $count);

  public function setStrategy(StrategyInterface $strategy);

}
