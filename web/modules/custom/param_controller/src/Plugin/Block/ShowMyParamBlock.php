<?php
namespace Drupal\param_controller\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;

/**
 * Provides a 'work' block.
 *
 * @Block(
 *   id = "show_my_param_block",
 *   admin_label = @Translation("My Param Block"),
 *   category = @Translation("My Param Block")
 * )
 */
class ShowMyParamBlock extends BlockBase implements BlockPluginInterface {

  /**
   * @return array
   */
  public function defaultConfiguration() {
    return [
      'all_nodes' => [],
    ];
  }

  public function build() {
    $config = $this->getConfiguration();
    $types = array_values($config['all_nodes']);

    $query = \Drupal::entityQuery('node');
    $query->condition('status', 1);
    $query->condition('type', $types, 'IN');

    $entity_ids = $query->execute();
    // Or a use the static loadMultiple method on the entity class:
    $nodes = Node::loadMultiple($entity_ids);

    // And then you can view/build them all together:
    $build = \Drupal::entityTypeManager()->getViewBuilder('node')->viewMultiple($nodes, 'teaser');

    return $build;
    }


  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();
    $types = NodeType::loadMultiple();
    $type_defaults = [];

    foreach ($types as $type => $object) {
      if (!array_key_exists($type, $type_defaults)) {
        $type_defaults[$type] = $type;
      }
    }


    $form['all_nodes'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Show post counts for the following content types'),
      '#options' => $type_defaults,
      '#default_value' => $config['all_nodes']?:[]
    ];



    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $tmp = [];
    foreach ($values['all_nodes'] as $key => $value) {
      $val = (bool)$value;
      if ($val) {
        $tmp[$key] = $value;
      }
    }

    $this->configuration['all_nodes'] = $tmp;
  }


}