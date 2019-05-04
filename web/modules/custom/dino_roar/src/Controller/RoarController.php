<?php
namespace Drupal\dino_roar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\dino_roar\RoarGeneratorInterface;
use Drupal\dino_roar\Strategy\IterationStrategy;
use Drupal\dino_roar\Strategy\RoarStrategy;
use Drupal\dino_roar\Strategy\SumaStrategy;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;


class RoarController extends ControllerBase {

  /**
   * @var \Drupal\dino_roar\RoarGeneratorInterface
   */
  private $roarGenerator;

  /**
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  private $channelFactoryService;

  public function __construct(RoarGeneratorInterface $roarGenerator, LoggerChannelFactoryInterface $channelFactory) {
    $this->roarGenerator = $roarGenerator;
    $this->channelFactoryService = $channelFactory;
  }

  public function roar($count) {

    $roar = $this->roarGenerator->setStrategy(new RoarStrategy())->getRoar($count);

    return new Response($roar);
  }


  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('dino_roar.roar'),
      $container->get('logger.factory')
    );
  }


}