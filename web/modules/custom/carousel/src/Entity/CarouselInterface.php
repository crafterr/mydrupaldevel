<?php

namespace Drupal\carousel\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Interface CarouselInterface
 *
 * @package Drupal\carousel\Entity
 */
interface CarouselInterface extends ContentEntityInterface, EntityChangedInterface {


  /**
   * Gets the Product image.
   *
   * @return \Drupal\file\FileInterface
   */
  public function getImage();

  /**
   * Sets the Product image.
   *
   * @param int $image
   *
   * @return \Drupal\carousel\Entity\CarouselInterface
   *   The called Product entity.
   */
  public function setImage($image);

  /**
   * @return mixed
   */
  public function getImageAlt();

  /**
   * @param $image_alt
   *
   * @return mixed
   */
  public function setImageAlt($image_alt);

  /**
   * @return mixed
   */
  public function getImageTitle();

  /**
   * @param $image_title
   *
   * @return mixed
   */
  public function setImageTitle($image_title);

  /**
   * @return mixed
   */
  public function getCaptionText();

  /**
   * @param $caption_text
   *
   * @return mixed
   */
  public function setCaptionText($caption_text);

  /**
   * @return mixed
   */
  public function getStatus();

  /**
   * @param $status
   *
   * @return mixed
   */
  public function setStatus($status);
}