<?php
namespace Drupal\carousel\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Carousel entity.
 *
 * @ContentEntityType(
 *   id = "carousel",
 *   label = @Translation("Carousel"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\carousel\CarouselListBuilder",
 *
 *     "form" = {
 *       "default" = "Drupal\carousel\Form\CarouselForm",
 *       "add" = "Drupal\carousel\Form\CarouselForm",
 *       "edit" = "Drupal\carousel\Form\CarouselForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *    "route_provider" = {
 *      "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider"
 *    }
 *   },
 *   base_table = "carousel",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/carousel/{carousel}",
 *     "add-form" = "/admin/structure/carousel/add",
 *     "edit-form" = "/admin/structure/carousel/{carousel}/edit",
 *     "delete-form" = "/admin/structure/carousel/{carousel}/delete",
 *     "collection" = "/admin/structure/carousel",
 *   }
 * )
 */
class Carousel extends ContentEntityBase implements CarouselInterface{

  use EntityChangedTrait;

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    /**
     * Name Field Definition
     */
    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the product'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view',[
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form',[
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form',true)
      ->setDisplayConfigurable('view',true);


    /**
     * Image Id Field Definition
     */
    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Image'))
      ->setDescription(t('The carousel image.'))
      ->setDisplayOptions('form', array(
        'type' => 'image',
        'weight' => 5,
      ));
    /**
     * Image Alt definition
     */
    $fields['image_alt'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Image Alt'))
      ->setDescription(t('The Image Alt of carousel.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 1,
      ]);

    /**
     * Image Title definition
     */
    $fields['image_title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Image Title'))
      ->setDescription(t('The Image Title of carousel.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 1,
      ]);

    /**
     * Caption Text definition
     */
    $fields['caption_text'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Caption Text'))
      ->setDescription(t('The Caption Text of carousel.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 1,
      ]);


    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Demo entity is published.'))
      ->setDefaultValue(TRUE);


    /**
     * Created field definition
     */
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    /**
     * Changed field definition
     */
    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getImage() {

    return $this->get('image')->entity;
  }

  /**
   * @return mixed
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * @param string $name
   * @return $this
   */
  public function setName($name) {
    $this->set('name',$name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setImage($image) {

    $this->set('image', $image);
    return $this;
  }

  public function getImageAlt() {
    return $this->get('image_alt')->value;
  }

  public function setImageAlt($image_alt) {
    $this->set('image_alt',$image_alt);
    return $this;
  }

  public function getImageTitle() {
    return $this->get('image_title')->value;
  }

  public function setImageTitle($image_title) {
    $this->set('image_title',$image_title);
    return $this;
  }

  public function getCaptionText() {
    return $this->get('caption_text')->value;
  }

  public function setCaptionText($caption_text) {
    $this->set('caption_text',$caption_text);
    return $this;
  }

  public function getStatus() {
    return $this->get('status')->value;
  }

  public function setStatus($status) {
    $this->set('status',$status);
    return $this;
  }

  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  public function getChangedTime() {
    $this->get('changed')->value;
    return $this;
  }

  public function setChangedTime($timestamp) {
    $this->set('changed',$timestamp);
    return $this;
  }


}