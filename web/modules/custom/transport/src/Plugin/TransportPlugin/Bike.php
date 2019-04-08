<?php
namespace Drupal\transport\Plugin\TransportPlugin;

use Drupal\transport\Annotation\TransportPlugin;
use Drupal\transport\Plugin\TransportPluginBase;

/**
 *
 * @TransportPlugin(
 *   id = "bike",
 *   label = "Bike",
 *   description = @Translation("By bike."),
 *   speed = 20
 * )
 */
class Bike extends TransportPluginBase {

  public function go() {
    $time = parent::go();
    return $this->getLabel().' bedzie jechac '.$time .' h';
  }
}