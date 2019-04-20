<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 20/04/2019
 * Time: 20:07
 */

namespace Drupal\event_example\Event;


use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\EventDispatcher\Event;

class ControllerReportEvent extends Event {
  private $controller;

  public function __construct(ControllerBase $controller) {
    $this->controller = $controller;
  }

  public function getController() {
    return $this->controller;
  }
}