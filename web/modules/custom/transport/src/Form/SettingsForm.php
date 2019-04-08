<?php

namespace Drupal\transport\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\transport\Plugin\TransportPluginInterface;
use Drupal\transport\Plugin\TransportPluginManager;

class SettingsForm extends ConfigFormBase {

  /**
   * @var \Drupal\transport\Plugin\TransportPluginManager
   */
  private $transportPluginManager;

  public function __construct(TransportPluginManager $transportPluginManager) {
    $this->transportPluginManager = $transportPluginManager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.transport_plugin')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'transport_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['transport.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('transport.settings');

    $form['interval'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Interval'),
      '#description' => $this->t('The amount of time to delay between automatically cycling an item. If false, carousel will not automatically cycle.'),
      '#default_value' => $config->get('interval'),
    ];

    $definitions = $this->transportPluginManager->getDefinitions();

    $options = [];
    foreach ($definitions as $id => $definition) {
      /**
       * @var TransportPluginInterface $instance
       */
      $instance = $this->transportPluginManager->createInstance($definition['id']);
      $options[$id] = $instance->getLabel();
    }

    $form['plugin'] = [
      '#type' => 'select',
      '#title' => $this->t('Plugin'),
      '#default_value' => $config->get('plugin'),
      '#options' => $options,
      '#description' => $this->t('The plugin to be used with this importer.'),
      '#required' => TRUE,
    ];


    return parent::buildForm($form, $form_state);
  }



  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory->getEditable('transport.settings')
      ->set('interval', $form_state->getValue('interval'))
      ->set('plugin', $form_state->getValue('plugin'))
           ->save();

    parent::submitForm($form, $form_state);
  }

}
