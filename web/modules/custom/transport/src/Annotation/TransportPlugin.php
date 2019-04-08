<?php
namespace Drupal\transport\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Transport plugin item annotation object.
 *
 * @see \Drupal\transport\Plugin\TransportPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class TransportPlugin extends Plugin {


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

  public $description;

  public $speed;

}
