<?php

namespace Drupal\my_simple_crud;
use Drupal\Core\Database\Driver\mysql\Connection;

/**
 * Class StorageService.
 */
class StorageService implements StorageServiceInterface {

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var \Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database;

  /**
   * Constructs a new StorageService object.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public function getAll($limit = NULL, $orderBy = NULL, $order = 'DESC') {
    $query = $this->database->select('my_simple_crud', 'e')
      ->fields('e');
    if ($limit) {
      $query->range(0, $limit);
    }
    if ($orderBy) {
      $query->orderBy($orderBy, $order);
    }
    $result = $query->execute()
      ->fetchAll();
    return $result;
  }

  public function exists($id) {
    $result = $this->database->select('my_simple_crud', 'e')
      ->fields('e', ['id'])
      ->condition('id', $id, '=')
      ->execute()
      ->fetchField();
    return (bool) $result;
  }

  public function load($id) {
    $result = $this->database->select('my_simple_crud', 'e')
      ->fields('e')
      ->condition('id', $id, '=')
      ->execute()
      ->fetchObject();
    return $result;
  }

  public function checkUniqueEmail($email, $id = NULL) {
    $query = $this->database->select('my_simple_crud', 'e')
      ->fields('e', ['id']);
    if ($id) {
      $query->condition('id', $id, '!=');
    }
    $query->condition('email', $email, '=');
    $result = $query->execute();
    if (empty($result->fetchObject())) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  public function add(array $fields) {
    return $this->database->insert('my_simple_crud')->fields($fields)->execute();
  }


  public function update($id, array $fields) {
    return $this->database->update('my_simple_crud')->fields($fields)
      ->condition('id', $id)
      ->execute();
  }

  public function delete($id) {
    $record = $this->load($id);
    if (isset($record->profile_pic)) {
      file_delete($record->profile_pic);
    }
    return $this->database->delete('my_simple_crud')->condition('id', $id)->execute();
  }

  public function changeStatus($id, $status) {
    return $this->update($id, ['status' => ($status) ? 1 : 0]);
  }


}
