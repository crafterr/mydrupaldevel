<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 10/11/2018
 * Time: 20:39
 */

namespace Drupal\hello_world\Form;


use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Logger\LoggerChannelInterface;
use Drupal\hello_world\Logger\MailLogger;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configuration form definition for the salutation message.
 */
class SalutationConfigurationForm extends ConfigFormBase
{

  /**
   * @var \Drupal\Core\Logger\LoggerChannelInterface
   */
  protected $logger;

  /**
   * @var \Drupal\hello_world\Logger\MailLogger
   */
  private $mailLogger;

  public function __construct(ConfigFactoryInterface $config_factory, LoggerChannelInterface $logger, MailLogger $mailLogger) {
    parent::__construct($config_factory);
    $this->logger = $logger;
    $this->mailLogger = $mailLogger;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('hello_world.logger.channel.hello_world'),
      $container->get('hello_world.logger.hello_world')
    );
  }

  /**
   * @return array
   */
  protected function getEditableConfigNames()
  {
    return ['hello_world.custom_salutation'];
  }

  /**
   * @return string
   */
  public function getFormId()
  {
    return 'salutation_configuration_form';
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return array
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('hello_world.custom_salutation');
    $form['salutation_good_morning'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Salutation Good morning'),
      '#description' => $this->t('Please provide the salutation you want to use on good morning.'),
      '#default_value' => $config->get('salutation_good_morning')
    ];
    $form['salutation_good_afternoon'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Salutation Good afternoon'),
      '#description' => $this->t('Please provide the salutation you want to use on good afternonn.'),
      '#default_value' => $config->get('salutation_good_afternoon')
    ];
    $form['salutation_good_evening'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Salutation Good evening'),
      '#description' => $this->t('Please provide the salutation you want to use on good evening.'),
      '#default_value' => $config->get('salutation_good_evening')
    ];

    return parent::buildForm($form,$form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    $salutation_good_morning = $form_state->getValue('salutation_good_morning');
    $length = 100;
    if (strlen($salutation_good_morning) >$length) {
      $form_state->setErrorByName('salutation_good_morning', $this->t('This salutation is too long %d',['%d'=>$length]));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config('hello_world.custom_salutation')
      ->set('salutation_good_morning',$form_state->getValue('salutation_good_morning'))
      ->set('salutation_good_afternoon',$form_state->getValue('salutation_good_afternoon'))
      ->set('salutation_good_evening',$form_state->getValue('salutation_good_evening'))
      ->save();

    //$this->logger->log('The Hello World salutation has been changed to @message', ['@message' => $form_state->getValue('salutation_good_afternoon')]);
    //$this->logger->log('The Hello World salutation has been changed to @message', ['@message' => $form_state->getValue('salutation_good_evening')]);

    parent::submitForm($form,$form_state);
    $this->logger->info('The Hello World salutation has been changed to @message', ['@message' => $form_state->getValue('salutation_good_morning')]);
    $this->mailLogger->log(\Drupal\Core\Logger\RfcLogLevel::INFO,'wiadomosc');

  }

}