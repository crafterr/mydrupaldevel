<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 13/11/2018
 * Time: 20:53
 */

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'my block content' Block.
 *
 * @Block(
 *   id = "my_block_content",
 *   admin_label = @Translation("My Block Content"),
 *   category = @Translation("My Block Content"),
 * )
 */
class MyContextBlock extends  BlockBase implements ContainerFactoryPluginInterface
{

  /**
   * MyContextBlock constructor.
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $render = [
      '#theme' => 'my_context_block',
      '#mytext' => [
        '#contextual_links' => [
          'my_context' => [
            'route_parameters' => []
          ],
        ]
      ]
    ];

    $render['#mytext']['#markup'] = $this->t($this->configuration['mytext']);

    return $render;
  }

  /**
   * @return array
   */
  public function defaultConfiguration() {
    return [
      'mytext' => '',
    ];
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return array
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    $form['mytext'] = array(
      '#type' => 'textfield',
      '#title' => t('My Text'),
      '#description' => t('Type sth about your opinion.'),
      '#default_value' => $config['mytext'],
    );
    return $form;
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['mytext'] = $form_state->getValue('mytext');
  }


}