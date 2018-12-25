<?php

namespace Drupal\products;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\products\Entity\PriceInterface;

/**
 * Defines the storage handler class for Price entities.
 *
 * This extends the base storage class, adding required special handling for
 * Price entities.
 *
 * @ingroup products
 */
class PriceStorage extends SqlContentEntityStorage implements PriceStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(PriceInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {price_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {price_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(PriceInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {price_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('price_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
