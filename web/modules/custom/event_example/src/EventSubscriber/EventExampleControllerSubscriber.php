<?php

namespace Drupal\event_example\EventSubscriber;

use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\event_example\Event\ControllerReportEvent;
use Drupal\event_example\Event\IncidentEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class EventExampleControllerSubscriber.
 */
class EventExampleControllerSubscriber implements EventSubscriberInterface {
  use StringTranslationTrait;
  use MessengerTrait;

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {

    $events[IncidentEvent::NEW_CONTROLLER_REPORT] = ['notifyController'];
    return $events;
  }

  public function notifyController(ControllerReportEvent $event) {
    /**
     * @var \Drupal\event_example\Controller\EventExampleController $controller
     */
    $controller = $event->getController();
    $this->messenger()->addStatus($this->t('notifyController alerted. Thank you. This message was set by an event subscriber. See @method()', ['@method' => $controller->getTest()]));
    $event->stopPropagation();
  }


}
