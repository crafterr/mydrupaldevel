<?php

namespace Drupal\sandwich_types\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class SandwichController.
 */
class SandwichController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function saymeit() {
    /**
     * @var \Drupal\sandwich\Plugin\SandwichPluginManager $sandwichService
     */
    $sandwichService = \Drupal::service('plugin.manager.sandwich_plugin');

   // $hamburger = $sandwichService->createInstance('hamburger');
    $plugins = $sandwichService->getDefinitions();

    foreach ($plugins as $flavor) {
      $instance = $sandwichService->createInstance($flavor['id']);
      $build[] = array(
        '#type' => 'markup',
        '#markup' => t('<p>Flavor @name, cost $@price and @slogan.</p>', array('@name' => $instance->ge(), '@price' => $instance->getPrice(),'@slogan'=>$instance->slogan())),
      );
    }
  }

}
