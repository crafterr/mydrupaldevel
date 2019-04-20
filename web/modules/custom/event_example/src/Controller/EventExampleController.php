<?php

namespace Drupal\event_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\event_example\Event\ControllerReportEvent;
use Drupal\event_example\Event\IncidentEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class EventExampleController.
 */
class EventExampleController extends ControllerBase {

  /**
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  private $eventDispatcher;

  public function __construct(EventDispatcherInterface $eventDispatcher) {
    $this->eventDispatcher = $eventDispatcher;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('event_dispatcher')
    );
  }

  public function getTest()
  {
    return 'test';
  }

  public function hello() {

    $this->eventDispatcher->dispatch(IncidentEvent::NEW_CONTROLLER_REPORT, new ControllerReportEvent($this));

    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello with parameter(s)'),
    ];
  }

}
