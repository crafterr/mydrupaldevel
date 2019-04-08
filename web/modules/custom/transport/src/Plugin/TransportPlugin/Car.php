<?php
namespace Drupal\transport\Plugin\TransportPlugin;

use Drupal\transport\Annotation\TransportPlugin;
use Drupal\transport\Plugin\TransportPluginBase;

/**
 *
 * @TransportPlugin(
 *   id = "car",
 *   label = "Car",
 *   description = @Translation("By car."),
 *   speed = 100
 * )
 */
class Car extends TransportPluginBase {
  public function go() {
    $time = parent::go();
    return $this->getLabel().' bedzie jechac '.$time.' h';
  }
}