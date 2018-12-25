<?php

namespace Drupal\products;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface PriceStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Price revision IDs for a specific Price.
   *
   * @param \Drupal\products\Entity\PriceInterface $entity
   *   The Price entity.
   *
   * @return int[]
   *   Price revision IDs (in ascending order).
   */
  public function revisionIds(PriceInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Price author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Price revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\products\Entity\PriceInterface $entity
   *   The Price entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(PriceInterface $entity);

  /**
   * Unsets the language for all Price with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
