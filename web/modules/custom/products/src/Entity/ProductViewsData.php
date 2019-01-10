<?php

namespace Drupal\products\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Cars entities.
 */
class ProductViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    //importer
    $data['product']['importer'] = [
      'title' => t('Importer'),
      'help' => t('Information about product importer'),
      'field' => [
          'id' => 'product_importer'
      ]
     ];

    $data['price']['name'] = [
      'title' => t('Product has Prices'),
      'help' => t('Information about product prices'),
      'filter' => array(
        'id' => 'price_filter',
      ),
    ];
    return $data;
  }

}
