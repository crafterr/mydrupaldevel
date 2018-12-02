<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 18/11/2018
 * Time: 20:12
 */

namespace Drupal\hello_world;


use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;


/** @var ConfigFactoryInterface $factory
    $factory = \Drupal::service('config.factory');
    $read_only_config = $factory->get('hello_world.custom_salutation');
    $read_and_write_config = $factory->getEditable('hello_world.custom_salutation');
    $read_and_write_config->set('salutation', 'Another salutation');
    $read_and_write_config->save();
    $config = $factory->get('system.site');
    $value = $config->get('page.403');
    $config = $factory->get('system.maintenance');
    $value = $config->getOriginal('message', FALSE);
 *  $config->clear('message')->save();
 *  $config->delete();
 *
 * */
class HelloWorldConfigOverrides implements ConfigFactoryOverrideInterface {

  public function loadOverrides($names) {
    $overrides = [];
    if (in_array('system.maintenance', $names)) {
      $overrides['system.maintenance'] = ['message' => 'Our own message for the site maintenance mode.'];
    }

    return $overrides;
  }

  public function getCacheSuffix() {
    return 'HelloWorldConfigOverrider';
  }

  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    return null;
  }

  public function getCacheableMetadata($name) {
    return new CacheableMetadata();
  }

}