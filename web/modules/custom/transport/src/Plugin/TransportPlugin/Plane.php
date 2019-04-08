<?php
namespace Drupal\transport\Plugin\TransportPlugin;

use Drupal\transport\Annotation\TransportPlugin;
use Drupal\transport\Plugin\TransportPluginBase;

/**
 *
 * @TransportPlugin(
 *   id = "plane",
 *   label = "Plane",
 *   description = @Translation("By Plane."),
 *   speed = 400
 * )
 */
class Plane extends TransportPluginBase {
  public function go() {
    $time = parent::go();
    return $this->getLabel().' bedzie jechac '.$time.' h';
  }
}