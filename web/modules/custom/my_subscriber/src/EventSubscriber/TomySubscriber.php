<?php

namespace Drupal\my_subscriber\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
/**
 * Class TomySubscriber.
 */
class TomySubscriber implements EventSubscriberInterface {


  /**
   * Constructs a new TomySubscriber object.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST] = ['checkForRedirection'];

    return $events;
  }

  /**
   * @param \Symfony\Component\EventDispatcher\Event $event
   */
  public function checkForRedirection(Event $event) {

    //drupal_set_message('Event KernelEvents thrown by Subscriber in module my_subscriber.', 'status', TRUE);
  }

}
