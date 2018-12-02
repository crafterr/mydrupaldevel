<?php

namespace Drupal\carousel\Plugin\Block;

use Drupal\carousel\Entity\Carousel;
use Drupal\carousel\Form\SettingsForm;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\image\Entity\ImageStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides a carousel' Block.
 *
 * @Block(
 *   id = "carousel_block",
 *   admin_label = @Translation("Carousel Block")
 * )
 */
class CarouselBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * This will hold ImmutableConfig object.
   *
   * @var \Drupal\Core\Config\ImmutableConfig
   */
  protected $moduleSettings;


  /**
   * The entity manager interface.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a \Drupal\system\ConfigFormBase object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   Constructs a Connection object.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactoryInterface $config_factory, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->moduleSettings = $config_factory->get('carousel.settings');
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [
      '#items' => $this->getCarouselItems(),
      '#settings' => $this->moduleSettings,
      '#theme' => 'carousel_block',
    ];


    if ($this->moduleSettings->get('assets')) {
      $build['#attached'] = [
        'library' => [
          'carousel/bootstrap',
        ],
      ];
    }

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * Returns an active carousel items.
   *
   * @return array|null
   *   Items list or null
   */
  protected function getCarouselItems() {

    $storage = $this->entityTypeManager->getStorage('carousel');
    $query_result = $storage->getQuery()
      ->condition('status', 1)
      ->execute();
    $carousel = Carousel::loadMultiple($query_result);

    if (!empty($carousel)) {
      foreach ($carousel as &$item) {

        $file = $item->getImage(); //$this->entityTypeManager->getStorage('file')->load($item->getImage());
        $image_style = $this->moduleSettings->get('image_style');
        if (empty($image_style) || $image_style == SettingsForm::ORIGINAL_IMAGE_STYLE_ID) {
          $item->image_url = file_url_transform_relative(file_create_url($file->getFileUri()));
        }
        else {
          $item->image_url = file_url_transform_relative(ImageStyle::load($image_style)
            ->buildUrl($file->getFileUri()));
        }
      }
    }

    return $carousel;
  }

}
