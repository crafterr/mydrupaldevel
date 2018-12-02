<?php
namespace Drupal\products\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Product entity.
 *
 * @ContentEntityType(
 *   id = "product",
 *   label = @Translation("Product"),
 *   bundle_label = @Translation("Product type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\products\ProductListBuilder",
 *
 *     "form" = {
 *       "default" = "Drupal\products\Form\ProductForm",
 *       "add" = "Drupal\products\Form\ProductForm",
 *       "edit" = "Drupal\products\Form\ProductForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *    "route_provider" = {
 *      "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider"
 *    }
 *   },
 *   base_table = "product",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "bundle" = "type"
 *   },
 *   bundle_entity_type = "product_type",
 *   field_ui_base_route = "entity.product_type.edit_form",
 *   links = {
 *     "canonical" = "/admin/content/product/{product}",
 *     "add-form" = "/admin/content/product/add/{product_type}",
 *     "add-page" = "/admin/content/product/add",
 *     "edit-form" = "/admin/content/product/{product}/edit",
 *     "delete-form" = "/admin/content/product/{product}/delete",
 *     "collection" = "/admin/content/product"
 *   }
 * )
 */
class Product extends ContentEntityBase implements ProductInterface
{

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
     * Number field definition
     */
    $fields['number'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Number'))
      ->setDescription(t('The Product number.'))
      ->setSettings([
        'min' => 1,
        'max' => 10000
      ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'number_unformatted',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    /**
     * Remote Id field defifnition
     */
    $fields['remote_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Remote ID'))
      ->setDescription(t('The remote ID of the Product.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue(\Drupal::request()->getClientIp());

    /**
     * Source field definition
     */
    $fields['source'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Source'))
      ->setDescription(t('The source of the Product.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ]);

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
   * @return mixed
   */
  public function getProductNumber() {
    return $this->get('number')->value;
  }

  /**
   * @param int $number
   * @return $this
   */
  public function setProductNumber($number) {
    $this->set('number',$number);
    return $this;
  }

  /**
   * @return mixed
   */
  public function getRemoteId() {
    return $this->get('remote_id')->value;
  }

  /**
   * @param string $id
   * @return $this
   */
  public function setRemoteId($id) {
    $this->set('remote_id',$id);
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSource() {
    return $this->get('source')->value;
  }

  /**
   * @param string $source
   * @return $this
   */
  public function setSource($source) {
    $this->set('source',$source);
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