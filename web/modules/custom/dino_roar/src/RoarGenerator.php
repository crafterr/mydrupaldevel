<?php

namespace Drupal\dino_roar;

use Drupal\dino_roar\Strategy\StrategyInterface;

/**
 * Class RoarGenerator.
 */
class RoarGenerator implements RoarGeneratorInterface {


  /**
   * @var \Drupal\dino_roar\Strategy\StrategyInterface
   */
  private $strategy;

  public function __construct(StrategyInterface $strategy) {
    $this->strategy = $strategy;
  }

  public function getRoar(int $count) {
    return $this->strategy->render($count);
  }

  public function setStrategy(StrategyInterface $strategy) {
    $this->strategy = $strategy;
    return $this;
  }



}
