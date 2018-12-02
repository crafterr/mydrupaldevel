<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 01/12/2018
 * Time: 19:44
 */

namespace Drupal\products\Entity;


use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Product type configuration entity type.
 *
 * @ConfigEntityType(
 *   id = "product_type",
 *   label = @Translation("Product type"),
 *   handlers = {
 *     "list_builder" = "Drupal\products\ProductTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\products\Form\ProductTypeForm",
 *       "edit" = "Drupal\products\Form\ProductTypeForm",
 *       "delete" = "Drupal\products\Form\ProductTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "product_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "product",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/content/product_type/{product_type}",
 *     "add-form" = "/admin/content/product_type/add",
 *     "edit-form" = "/admin/content/product_type/{product_type}/edit",
 *     "delete-form" = "/admin/content/product_type/{product_type}/delete",
 *     "collection" = "/admin/content/product_type"
 *   }
 * )
 */

class ProductType extends ConfigEntityBundleBase implements ProductTypeInterface{

  /**
   * The Product type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Product type label.
   *
   * @var string
   */
  protected $label;
}