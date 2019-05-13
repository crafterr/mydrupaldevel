<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class TranslatorController.
 */
class TranslatorController extends ControllerBase {

  public function hello() {
    $accountProxy = \Drupal::currentUser();
    $user = \Drupal::entityTypeManager()->getStorage('user')->load($accountProxy->id());

   // dump($userName); die();

    $title = t('@name Blog', array('@name' => $user->getDisplayName()));

    return [
      '#type' => 'markup',
      '#markup' => $title
    ];
  }

}
