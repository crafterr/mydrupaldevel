<?php

namespace Drupal\sandwich\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Sandwich plugin item annotation object.
 *
 * @see \Drupal\sandwich\Plugin\SandwichPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class SandwichPlugin extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;


  /**
   * The human readable description of the sandwich
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;


  /**
   * The number of calories per serving of this
   * @var float
   */
  public $calories;

}
