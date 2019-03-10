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
    foreach ($plugins as $sandwich) {
      /**
       * @var \Drupal\sandwich\Plugin\SandwichPluginInterface $instance
       */
      $instance = $sandwichService->createInstance($sandwich['id']);
      $build[] = array(
        '#type' => 'markup',
        '#markup' => t('<p>Sandwich @name, calories:  @calories and @description.</p><p>Order: @order</p>', array('@name' => $instance->getPluginId(), '@description' => $instance->getDescription(),'@calories'=>$instance->getCalories(),'@order'=>$instance->order([]))),
      );
    }
    return $build;
  }

}
