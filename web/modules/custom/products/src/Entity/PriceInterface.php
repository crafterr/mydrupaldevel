<?php

namespace Drupal\products\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Price entities.
 *
 * @ingroup products
 */
interface PriceInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Price name.
   *
   * @return string
   *   Name of the Price.
   */
  public function getName();

  /**
   * Sets the Price name.
   *
   * @param string $name
   *   The Price name.
   *
   * @return \Drupal\products\Entity\PriceInterface
   *   The called Price entity.
   */
  public function setName($name);

  /**
   * Gets the Price creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Price.
   */
  public function getCreatedTime();

  /**
   * Sets the Price creation timestamp.
   *
   * @param int $timestamp
   *   The Price creation timestamp.
   *
   * @return \Drupal\products\Entity\PriceInterface
   *   The called Price entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Price published status indicator.
   *
   * Unpublished Price are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Price is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Price.
   *
   * @param bool $published
   *   TRUE to set this Price to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\products\Entity\PriceInterface
   *   The called Price entity.
   */
  public function setPublished($published);

  /**
   * Gets the Price revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Price revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\products\Entity\PriceInterface
   *   The called Price entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Price revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Price revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\products\Entity\PriceInterface
   *   The called Price entity.
   */
  public function setRevisionUserId($uid);

}
