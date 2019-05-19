<?php

namespace Drupal\my_simple_crud\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Link;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Url;
/**
 * Class CrudController.
 */
class CrudController extends ControllerBase {

  /**
   * @var \Drupal\Core\Database\Connection
   */
  private $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */
  public function display() {

    /**
     * header
     */
    $header = [
      'id' => $this->t('Id'),
      'name' => $this->t('Name'),
      'mobilenumber' => $this->t('MobileNumber'),
      'email'=>$this->t('Email'),
      'age' => $this->t('Age'),
      'gender' => $this->t('Gender'),
      'website' => $this->t('Web site'),
      'opt' => $this->t('operations'),
      'opt1' => $this->t('operations'),
    ];

    $rows = [];

    /**
     * query
     */
    $query = $this->database->select('my_simple_crud','m');
    $query->fields('m',['id','name','mobilenumber','email','age','gender','website']);
    $result = $query->execute()->fetchAll();

    foreach ($result as $data) {
      $delete = Url::fromRoute('my_simple_crud.delete_form',['id' => $data->id]);
      $edit = Url::fromRoute('my_simple_crud.edit_form',['my_simple_crud' => $data->id]);
      $rows[] = [
        'id' => $data->id,
        'name' => $data->name,
        'mobilenumber' => $data->mobilenumber,
        'email' => $data->email,
        'age' => $data->age,
        'gender' => $data->gender,
        'website' => $data->website,
        Link::fromTextAndUrl('Delete',$delete),
        Link::fromTextAndUrl('Edit',$edit)
      ];
    }

    /**
     * render as a table
     */
    $build['table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => $this->t('No found'),
    ];

    return $build;
  }

}
