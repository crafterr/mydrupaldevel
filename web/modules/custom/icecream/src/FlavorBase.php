<?php
/**
 * @file
 * Provides Drupal\icecream\FlavorBase.
 */

namespace Drupal\icecream;

use Drupal\Component\Plugin\PluginBase;

class FlavorBase extends PluginBase implements FlavorInterface {

  public function getName() {
    return $this->pluginDefinition['name'];
  }

  public function getPrice() {
    return $this->pluginDefinition['price'];
  }

  public function getOpinion() {
    return $this->pluginDefinition['opinion'];
  }

  public function slogan() {
    return t('Best flavor ever.');
  }
}
