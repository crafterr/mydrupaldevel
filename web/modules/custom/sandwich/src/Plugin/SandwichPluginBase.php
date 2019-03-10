<?php

namespace Drupal\sandwich\Plugin;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for Sandwich plugin plugins.
 */
abstract class SandwichPluginBase extends PluginBase implements SandwichPluginInterface {


  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->pluginDefinition['description'];
  }

  /**
   * {@inheritdoc}
   */
  public function getCalories() {
    return (float) $this->pluginDefinition['calories'];
  }

  /**
   * {@inheritdoc}
   */
  abstract public function order(array $extras);

}
