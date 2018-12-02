<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 19/11/2018
 * Time: 18:41
 */

namespace Drupal\hello_world\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\TypedData\MapDataDefinition;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityStorageInterface;
class DataDefinitionController  extends ControllerBase{



  public function show()
  {
      $definition  = DataDefinition::create('string');
      $definition->setLabel('Defined a simple string');
      /** @var TypedDataInterface $data */
      $data = \Drupal::typedDataManager()->create($definition, 'my_value');
      //dump($data->getValue());
      $data->setValue('another string');
      //dump($data->getValue());
      $type = $data->getDataDefinition()->getDataType();
      $label = $data->getDataDefinition()->getLabel();


      //plate
      $plate_number_definition = DataDefinition::create('string');
      $plate_number_definition->setLabel('A license plate number.');

      //state
      $state_code_definition = DataDefinition::create('string');
      $state_code_definition->setLabel('A state code');

      $plate_definition = MapDataDefinition::create();
      $plate_definition->setLabel('A US license plate');

      $plate_definition->setPropertyDefinition('number', $plate_number_definition);
      $plate_definition->setPropertyDefinition('state', $state_code_definition);

      $plate = \Drupal::typedDataManager()->create($plate_definition, ['state' => 'NY', 'number' => '405-307']);
      dump($plate->getDataDefinition()->getLabel());
    $label = $plate->getDataDefinition()->getLabel();
    $number = $plate->get('number');
    $state = $plate->get('state');
      die();
  }

  public function query()
  {
    $query = \Drupal::entityQuery('node') ;
    $query
      ->condition('type', 'page')
      ->condition('status', TRUE)
      ->range(0, 10)
      ->sort('created', 'DESC');
    //->condition('type', ['article', 'page'], 'IN')

    /**
     * condition group
     */
    /*$query
      ->condition('status', TRUE);
    $or = $query->orConditionGroup()
      ->condition('title', 'Drupal', 'CONTAINS')
      ->condition('field_tags.entity.name', 'Drupal', 'CONTAINS');
    $query->condition($or);
    $ids = $query->execute();*/
    $ids = $query->execute();
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($ids);
   // $nodes = \Drupal::entityTypeManager()->getStorage('node')->load($id);
    dump($nodes);

    $query = \Drupal::entityTypeManager()->getStorage('view')->getQuery();
    $query
      ->condition('display.*.display_plugin', 'page');
    $ids = $query->execute();
    dump($ids); die();
  }
}