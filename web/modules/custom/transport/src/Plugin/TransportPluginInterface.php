<?php

namespace Drupal\transport\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for Transport plugin plugins.
 */
interface TransportPluginInterface extends PluginInspectionInterface {


  /**
   * @return string
   */
  public function getDescription();

  /**
   * @return float
   */
  public function getSpeed();

  /**
   * @return mixed
   */
  public function getLabel();

  /**
   * @return mixed
   */
  public function go();

}
