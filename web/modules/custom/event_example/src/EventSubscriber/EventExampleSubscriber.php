<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 20/04/2019
 * Time: 19:14
 */

namespace Drupal\event_example\EventSubscriber;


use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\event_example\Event\IncidentEvent;
use Drupal\event_example\Event\IncidentReportEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventExampleSubscriber implements EventSubscriberInterface {

  use StringTranslationTrait;
  use MessengerTrait;
  /**
   *
   */
  public static function getSubscribedEvents() {
    $events[IncidentEvent::NEW_REPORT] = ['notifyMario'];
    return $events;
  }

  public function notifyMario(IncidentReportEvent $event) {
    //dump($event->getReport()); die();
   // drupal_set_message('Event KernelEvents thrown by Subscriber in module my_subscriber.', 'status', TRUE);

    if ($event->getReport()=='stolen_princess') {
      //drupal_set_message('Event KernelEvents thrown by Subscriber in module my_subscriber.', 'status', TRUE);
      $this->messenger()->addStatus($this->t('Mario has been alerted. Thank you. This message was set by an event subscriber. See @method()', ['@method' => __METHOD__]));
      $event->stopPropagation();
    }
  }

}