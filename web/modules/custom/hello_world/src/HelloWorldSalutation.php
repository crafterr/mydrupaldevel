<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 10/11/2018
 * Time: 18:19
 */
namespace Drupal\hello_world;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
class HelloWorldSalutation {

  use StringTranslationTrait;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;

  /**
   * HelloWorldSalutation constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   */
  public function __construct(ConfigFactoryInterface $configFactory, EventDispatcherInterface $eventDispatcher)
  {
    $this->configFactory = $configFactory;
    $this->eventDispatcher = $eventDispatcher;
  }

  /**
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   */
  public function getSalutation()
  {
    $event = new SalutationEvent();
    $config = $this->configFactory->get('hello_world.custom_salutation');
    $salutation_good_morning = $config->get('salutation_good_morning');
    $salutation_good_afternoon = $config->get('salutation_good_afternoon');
    $salutation_good_evening = $config->get('salutation_good_evening');

    $time = new \DateTime();
    if ((int) $time->format('G') >= 06 && (int) $time->format('G') < 12) {
      $event->setValue($salutation_good_morning);
      $this->eventDispatcher->dispatch(SalutationEvent::EVENT,$event);
      return $this->t($event->getValue());
    }

    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      $event->setValue($salutation_good_afternoon);
      $this->eventDispatcher->dispatch(SalutationEvent::EVENT,$event);
      return $this->t($event->getValue());
    }

    if ((int) $time->format('G') >= 18) {
      $event->setValue($salutation_good_evening);
      $this->eventDispatcher->dispatch(SalutationEvent::EVENT,$event);
      return $this->t($event->getValue());

    }
  }


  /**
   * Returns the Salutation render array.
   */
  public function getSalutationComponent() {
    $msg = [1,2,3,4,5];
    $render = [
        '#theme' => 'hello_world_salutation',
        '#salutation' => [
          '#contextual_links' => [
            'hello_world' => [
              'route_parameters' => []
            ],
          ]
        ]
    ];
    $config = $this->configFactory->get('hello_world.custom_salutation');


    $render['#overridden'] = TRUE;

    //add js to template
    $render['#attached'] = [
      'library' => [
        'hello_world/hello_world_clock',
        'hello_world/example_library'
      ]
    ];

    $time = new \DateTime();
    $render['#target'] = $this->t('world');
    if ((int) $time->format('G') >= 04 && (int) $time->format('G') < 12) {
        $render['#salutation']['#markup'] = $this->t($config->get('salutation_good_morning'));
        //send to js
       //$render['#attached']['drupalSettings']['modulename']['modulename_functionality']['param']
       $render['#attached']['drupalSettings']['hello_world']['hello_world_clock']['afternoon'] = TRUE;
      $render['#attached']['drupalSettings']['hello_world']['hello_world_clock']['myparam'] = $msg;
      return $render;
    }

    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      $render['#salutation']['#markup'] = $this->t($config->get('salutation_good_afternoon'));

      $render['#attached']['drupalSettings']['hello_world']['hello_world_clock']['afternoon'] = TRUE;
      $render['#attached']['drupalSettings']['hello_world']['hello_world_clock']['myparam'] = $msg;
      return $render;
    }

    if ((int) $time->format('G') >= 18) {
      $render['#salutation']['#markup'] = $this->t($config->get('salutation_good_evening'));

      $render['#attached']['drupalSettings']['hello_world']['hello_world_clock']['afternoon'] = TRUE;
      $render['#attached']['drupalSettings']['hello_world']['hello_world_clock']['myparam'] = $msg;

      return $render;
    }
  }
}