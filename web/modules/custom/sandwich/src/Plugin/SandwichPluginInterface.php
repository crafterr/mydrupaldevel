<?php

namespace Drupal\sandwich\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for Sandwich plugin plugins.
 */
interface SandwichPluginInterface extends PluginInspectionInterface {

  /**
   * @return string
   */
  public function getDescription();

  /**
   * @return float
   */
  public function getCalories();

  /**
   * @param array $extras
   *
   * @return string
   */
  public function order(array $extras);

}
