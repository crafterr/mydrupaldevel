<?php

namespace Drupal\event_subscriber\Event;

use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\EventDispatcher\Event;

class NodeInsertDemoEvent extends Event {

  /**
   * @Event
   *
   */
  const MY_NODE_INSERT = 'my.node.insert';

  /**
   * Node entity.
   *
   * @var \Drupal\Core\Entity\EntityInterface
   */
  protected $entity;

  public function __construct(EntityInterface $entity) {
    $this->entity = $entity;
  }

  /**
   * @return \Drupal\Core\Entity\EntityInterface
   */
  public function getEntity() {
    return $this->entity;
  }
}