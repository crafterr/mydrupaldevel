<?php

namespace Drupal\lazy_service\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\lazy_service\HeavyServiceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class MyHeavyController.
 */
class MyHeavyController extends ControllerBase {

  /**
   * @var \Drupal\lazy_service\HeavyServiceInterface
   */
  private $heavyService;

  public function __construct(HeavyServiceInterface $heavyService) {
    $this->heavyService = $heavyService;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('lazy_service.my_heavy_service')
    );
  }

  public function hello($name) {
    return [
      '#theme' => 'lazy_service',
      '#markup' => $this->heavyService->doSomething(),
    ];
  }

}
