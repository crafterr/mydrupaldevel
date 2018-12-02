<?php
namespace Drupal\form_in_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;


/**
 * Provides a 'work' block.
 *
 * @Block(
 *   id = "work_block",
 *   admin_label = @Translation("Work block"),
 *   category = @Translation("Custom work block example")
 * )
 */
class WorkBlock extends BlockBase {

  public function build() {

    $form = \Drupal::formBuilder()->getForm('Drupal\form_in_block\Form\WorkForm');
    return $form;
  }

}