<?php
namespace Drupal\form_in_block\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class WorkForm extends FormBase {

  protected $messenger;

  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger')
    );
  }

  public function getFormId() {
    return 'form_in_block';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['employee_name'] = [
      '#type' => 'textfield',
      '#title' => t('Employee name:'),
      '#required' => true,
    ];

    $form['employee_mail'] = [
      '#type' => 'email',
      '#title' => t('Email id'),
      '#required' => true
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Register'),
      '#button_type' => 'primary',
    );
    $form['#theme'] = 'form_in_block';
    return $form;
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger->addMessage($this->t('@emp_name ,Your application is being submitted!', array('@emp_name' => $form_state->getValue('employee_name'))));
  }

}