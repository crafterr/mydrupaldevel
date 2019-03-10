<?php

namespace Drupal\icecream\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Controller\ControllerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class IcecreamController extends ControllerBase implements ContainerInjectionInterface {

  public static function create(ContainerInterface $container) {
    return new static($container->get('module_handler'));
  }

  public function page() {
    $build = array(
      '#type' => 'markup',
      '#markup' => t('Hello World!'),
    );

    /**
     * @var \Drupal\icecream\IcecreamManager $manager
     */
    $manager = \Drupal::service('plugin.manager.icecream');
    $plugins = $manager->getDefinitions();

    //dump($plugins); die();

   // drupal_set_message(print_r($plugins, TRUE));
    /**
     * @var \Drupal\icecream\FlavorInterface $instance
     */
    $instance = $manager->createInstance('vanilla');

    dump($instance->getOpinion()->__toString()); die();

    foreach ($plugins as $flavor) {
      $instance = $manager->createInstance($flavor['id']);
      $build[] = array(
        '#type' => 'markup',
        '#markup' => t('<p>Flavor @name, cost $@price and @slogan.</p>', array('@name' => $instance->getName(), '@price' => $instance->getPrice(),'@slogan'=>$instance->slogan())),
      );
    }
    return $build;
  }
}
