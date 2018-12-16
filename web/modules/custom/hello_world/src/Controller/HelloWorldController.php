<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 10/11/2018
 * Time: 16:58
 */

namespace Drupal\hello_world\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\hello_world\HelloWorldSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelloWorldController extends  ControllerBase {

  /**
   * @var \Drupal\hello_world\HelloWorldSalutation
   */
  private $helloWorldSalutation;

  public function __construct(HelloWorldSalutation $helloWorldSalutation)
  {
    $this->helloWorldSalutation = $helloWorldSalutation;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *
   * @return static
   */
  public static function create(ContainerInterface $container)
  {

    return new static(
        $container->get('hello_world.salutation')
    );
  }

  /**
   * @return array
   */
  public function helloWorld()
  {


    /*$factory = \Drupal::service('user.private_tempstore'); // key_value_expire
    $store = $factory->get('my_module.my_collection');
    $store->set('my_key', 'my_value');
    $value = $store->get('my_key');
    $metadata = $store->getMetadata('my_key');
    dump($metadata); die();*/
    /*\Drupal::state()->setMultiple(['my_unique_key_one' => 'value', 'my_unique_key_two' => 'value']); //key_value table
    $values = \Drupal::state()->getMultiple(['my_unique_key_one', 'my_unique_key_two']);*/
    /** @var SharedTempStoreFactory $factory */
    /*$factory = \Drupal::service('user.shared_tempstore');
    $store = $factory->get('my_module.my_collection');
    $store->set('my_key', 'my_value');
    $value = $store->get('my_key');
    $metadata = $store->getMetadata('my_key');
    dump($metadata); die();*/

    /** @var UserDataInterface $userData */
    //$userData = \Drupal::service('user.data'); //table user_data
    //userData->set('hello_world',$this->currentUser()->id(),'test','adam');
    //dump($userData->get('hello_world',$this->currentUser()->id(),'test')); die();
    return $this->helloWorldSalutation->getSalutationComponent();

  }
}