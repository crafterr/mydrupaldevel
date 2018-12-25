<?php

namespace Drupal\products\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Price entities.
 */
class PriceViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
