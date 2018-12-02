<?php
namespace Drupal\param_controller\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class ShowMyParam extends ControllerBase {

  /*
   *
   */
  public function render($number)
  {
    $node = Node::load($number);
    dump($node->field_blog_category->entity->title->value); die();
    return [
      '#theme' => 'param_controller_theme',
      '#number' => $number,
      '#node' => $node
    ];
  }
}