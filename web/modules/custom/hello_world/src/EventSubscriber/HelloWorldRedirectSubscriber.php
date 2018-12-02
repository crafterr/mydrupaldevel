<?php
namespace Drupal\hello_world\EventSubscriber;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Url;
use Drupal\hello_world\SalutationEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Drupal\Core\Routing\CurrentRouteMatch;
use Symfony\Component\HttpKernel\KernelEvents;

class HelloWorldRedirectSubscriber implements EventSubscriberInterface
{

  /**
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * @var \Drupal\Core\Routing\CurrentRouteMatch
   */
  protected $currentRouteMath;

  public function __construct(AccountProxyInterface $currentUser, CurrentRouteMatch $currentRouteMatch) {
    $this->currentUser = $currentUser;
    $this->currentRouteMath = $currentRouteMatch;
  }

  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['onRequest', 0];
    $events[SalutationEvent::EVENT][] = ['onSetValue'];
    return $events;
  }

  public function onSetValue(SalutationEvent $event)
  {
    //$event->setValue('Hahahahah');
  }

  /**
   * Handler for the kernel request event.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   */
  public function onRequest(GetResponseEvent $event) {

    $routeName = $this->currentRouteMath->getRouteName();


    if ($routeName !== 'hello_world.hello') {
      return;
    }

    $roles = $this->currentUser->getRoles();

    if (in_array('non_grata', $roles)) {
      $url = Url::fromUri('internal:/');
      $event->setResponse(new RedirectResponse($url->toString()));
    }
  }

}