<?php
namespace Drupal\carousel;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * EntityListBuilderInterface implementation responsible for the Carousel entities.
 */
class CarouselListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Carousel Id');
    $header['name'] = $this->t('Name');
    $header['caption_text'] = $this->t('Caption Text');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\carousel\Entity\Carousel */

    $row['id'] = $entity->id();
    $row['name'] = $entity->getName();

    $row['caption_text'] = $entity->getCaptionText();


    return $row + parent::buildRow($entity);
  }
}