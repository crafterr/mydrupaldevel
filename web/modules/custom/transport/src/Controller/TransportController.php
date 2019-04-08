<?php

namespace Drupal\transport\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\transport\Plugin\TransportPluginInterface;
use Drupal\transport\Plugin\TransportPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TransportController.
 */
class TransportController extends ControllerBase {


  /**
 * @var \Drupal\transport\Plugin\TransportPluginManager
 */
  private $transportPluginManager;

  public function __construct(TransportPluginManager $transportPluginManager) {
    $this->transportPluginManager = $transportPluginManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.transport_plugin')
    );
  }

  public function test() {
    $definitions = $this->transportPluginManager->getDefinitions();
    dump($definitions);
    /**
     * @var TransportPluginInterface $bike
     */
    $car = $this->transportPluginManager->createInstance('car');
    $bike = $this->transportPluginManager->createInstance('bike');
    dump($car->go());
    dump($bike->go());
    die();
  }
}
