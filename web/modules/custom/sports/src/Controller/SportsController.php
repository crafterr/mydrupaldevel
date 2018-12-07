<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 20/11/2018
 * Time: 19:34
 */

namespace Drupal\sports\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SportsController extends ControllerBase {

  /**
   * @var \Drupal\Core\Database\Database
   */
  private $database;


  /**
   * SportsController constructor.
   *
   * @param \Drupal\Core\Database\Connection $database
   */
  public function __construct(Connection $database) {

    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')

    );
  }

  public function players()
  {
    $query = $this->database->select('players','p')
      ->fields('p')
      ->extend('\Drupal\Core\Database\Query\PagerSelectExtender')
      ->limit(3)
      ->addTag('player_query');
    $result = $query->execute()->fetchAll();
    $header = [t('Name')];

    $rows = [];

    foreach ($result as $row) {
      $rows[] = [
        $row->name
      ];
    }

    $build = [];
    $build[] = [
      '#theme' => 'table',
      '#header'=> $header,
      '#rows' => $rows,
    ];
    $build[] = array(
      '#type' => 'pager'
    );



    return $build;

  }


  public function insert($name,$group_id)
  {
    $this->database->insert('players');
    $fields = ['name' => $name,'team_id'=>$group_id, 'data' => serialize(['known for' => 'Hand of God'])];
    $id = $this->database->insert('players')
      ->fields($fields)
      ->execute();

    //or mulitple values

    /*$values = [
      ['name' => 'Novak D.', 'data' => serialize(['sport' => 'tennis'])],
      ['name' => 'Micheal P.', 'data' => serialize(['sport' => 'swimming'])]
    ];
    $fields = ['name', 'data'];
    $query =  $this->database->insert('players')
      ->fields($fields);
    foreach ($values as $value) {
      $query->values($value);
    }
    $result = $query->execute();
*/
    $build = [
      '#markup' => 'Dodano'
    ];
    return $build;
  }

  public function update()
  {
    $transaction = $this->database->startTransaction();
    try {
      $this->database->update('players')
        ->fields([
          'data' => serialize([
            'sport' => 'swimming',
            'feature' => 'This guy can swim'
          ])
        ])
        ->condition('name', 'Micheal P.')
        ->execute();
    }
    catch (\Exception $e) {
      $transaction->rollback();
      watchdog_exception('my_type', $e);
    }
  }

  public function delete()
  {
    $result = $this->database->delete('players')
      ->condition('name', 'Micheal P.')
      ->execute();
  }
}
