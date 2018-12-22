<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 01/12/2018
 * Time: 19:04
 */
namespace Drupal\products\Controller;
use Drupal\Core\Controller\ControllerBase;

class Import extends ControllerBase {

  public function page()
  {
    /** @var Importer $config */
    //$config = \Drupal::entityTypeManager()->getStorage('importer')->load('my_importer');
   // $config = \Drupal::entityTypeManager()->getStorage('product_type')->loadMultiple();
    //dump($config); die();
    //$plugin = \Drupal::service('products.importer_manager')->createInstance($config->getPluginId(), ['config' => $config]);
    $plugin = \Drupal::service('products.importer_manager')->createInstanceFormConfig('my_importer');
 // dump($plugin); die();
    $plugin->import();
    return [
      '#markup' => t('Weszlo')
    ];
  }
}