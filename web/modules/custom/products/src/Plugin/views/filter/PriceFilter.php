<?php

namespace Drupal\products\Plugin\views\filter;

use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\views\Plugin\views\filter\InOperator;
use Drupal\views\ViewExecutable;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Filter class which filters by the available teams.
 *
 * @ViewsFilter("price_filter")
 */
class PriceFilter extends InOperator {


  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  private $entityTypeManager;

  /**
   * Constructs a Bundle object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entityTypeManager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {
    parent::init($view, $display, $options);
    $this->valueTitle = t('Prices');
    $this->definition['options callback'] = [$this, 'getPrices'];
  }

  /**
   * Generates the list of teams that can be used in the filter.
   */
  public function getPrices() {
    $result = $this->entityTypeManager->getStorage('price')->loadMultiple();
    //dump($result); die();
    if (!$result) {
      return [];
    }
    $data = [];
    foreach ($result as $price) {
      $data[$price->id()] = $price->get('name')->value;
    }
    return $data;
  }

  public function query() {
    return '';
  }
}
