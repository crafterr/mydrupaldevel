<?php

namespace Drupal\my_simple_crud;

/**
 * Interface StorageServiceInterface.
 */
interface StorageServiceInterface {

  public function getAll($limit = NULL, $orderBy = NULL, $order = 'DESC');
  public function exists($id);
  public function load($id);
  public function checkUniqueEmail($email, $id = NULL);
  public function add(array $fields);
  public function update($id, array $fields);
  public function delete($id);
  public function changeStatus($id, $status);
}
