<?php

namespace Drupal\cars\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Cars entities.
 *
 * @ingroup cars
 */
interface CarsInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Cars name.
   *
   * @return string
   *   Name of the Cars.
   */
  public function getName();

  /**
   * Sets the Cars name.
   *
   * @param string $name
   *   The Cars name.
   *
   * @return \Drupal\cars\Entity\CarsInterface
   *   The called Cars entity.
   */
  public function setName($name);

  /**
   * Gets the Cars creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Cars.
   */
  public function getCreatedTime();

  /**
   * Sets the Cars creation timestamp.
   *
   * @param int $timestamp
   *   The Cars creation timestamp.
   *
   * @return \Drupal\cars\Entity\CarsInterface
   *   The called Cars entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Cars published status indicator.
   *
   * Unpublished Cars are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Cars is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Cars.
   *
   * @param bool $published
   *   TRUE to set this Cars to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\cars\Entity\CarsInterface
   *   The called Cars entity.
   */
  public function setPublished($published);

}
