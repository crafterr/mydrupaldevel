<?php
namespace Drupal\products\Plugin\views\field;

use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Form\FormStateInterface;
use Drupal\products\Plugin\ImporterManager;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Field plugin that renders data about the Importer that imported the Product.
 *
 * @ViewsField("product_importer")
 */
class ProductImporter extends FieldPluginBase{

  /**
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  private $entityTypeManager;

  /**
   * @var \Drupal\products\Plugin\ImporterManager
   */
  private $importerManager;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManager $entityTypeManager, ImporterManager $importerManager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entityTypeManager;
    $this->importerManager = $importerManager;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('products.importer_manager')
    );
  }

  public function render(ResultRow $values) {
    /**
     * @var \Drupal\products\Entity\ProductInterface $product
     */
    $product = $values->_entity;
    $source = $product->getSource();

    $importers = $this->entityTypeManager->getStorage('importer')->loadByProperties(['source' => $source]);

    if (!$importers) {
      return NULL;
    }
    // We'll assume one importer per source.
    /** @var \Drupal\products\Entity\ImporterInterface $importer */
    $importer = reset($importers);
    // If we want to show the entity label.
    if ($this->options['importer'] == 'entity') {
      return $this->sanitizeValue($importer->label());
    }

    // Otherwise we show the plugin label.
    $definition = $this->importerManager->getDefinition($importer->getPluginId());
    return $this->sanitizeValue($definition['label']);

  }

  /**
   * @return array
   */
  public function defineOptions() {

    $options = parent::defineOptions();
    $options['importer'] = array('default' => 'entity');

    return $options;
  }

  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    $form['importer'] = array(
      '#type' => 'select',
      '#title' => $this->t('Importer'),
      '#description' => $this->t('Which importer label to use?'),
      '#options' => [
        'entity' => $this->t('Entity'),
        'plugin' => $this->t('Plugin')
      ],
      '#default_value' => $this->options['importer'],
    );

    parent::buildOptionsForm($form, $form_state);
  }

  /**
   * @return string
   */
  public function query() {
    return '';
  }
}