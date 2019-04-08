<?php

namespace Drupal\transport\Plugin;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for Transport plugin plugins.
 */
abstract class TransportPluginBase extends PluginBase implements TransportPluginInterface {

  /**
   * int
   */
  CONST DISTANCE = 100;

  /**
   * @inheritdoc
   */
  public function getDescription() {
    return $this->pluginDefinition['description'];
  }

  /**
   * @inheritdoc
   */
  public function getSpeed() {
    return $this->pluginDefinition['speed'];
  }

  public function getLabel() {
    return $this->pluginDefinition['label'];
  }
  /**
   * @inheritdoc
   */
  public function go() {
    return self::DISTANCE/$this->getSpeed();
  }


}
