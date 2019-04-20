<?php

namespace Drupal\event_subscriber\EventSubscriber;

use Drupal\event_subscriber\Event\NodeInsertDemoEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class NodeInsertDemoSubscriber.
 */
class NodeInsertDemoSubscriber implements EventSubscriberInterface {


  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {

    $events[NodeInsertDemoEvent::MY_NODE_INSERT] = ['onMyNodeInsert'];
    return $events;
  }

  /**
   * @param \Drupal\event_subscriber\Event\NodeInsertDemoEvent $event
   */
  public function onMyNodeInsert(NodeInsertDemoEvent $event) {
    $entity = $event->getEntity();
    /*\Drupal::logger('event_subscriber_demo')->notice('New @type: @title. Created by: @owner',
      array(
        '@type' => $entity->getType(),
        '@title' => $entity->label(),
        '@owner' => $entity->getOwner()->getDisplayName()
      ));*/
  }


}
