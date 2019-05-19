<?php


namespace Drupal\my_simple_crud\Form;


use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CreateForm extends FormBase {

  public function getFormId() {
    return 'create_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state,$my_simple_crud = NULL) {

    dump($my_simple_crud); die();
    $form['candidate_name'] = [
      '#type' => 'textfield',
      '#title' => t('Candidate Name:'),
      '#required' => TRUE,
      //'#default_values' => array(array('id')),
      '#default_value' => (isset($record['name']) && $_GET['num']) ? $record['name']:'',
    ];
    $form['mobile_number'] = [
      '#type' => 'textfield',
      '#title' => t('Mobile Number:'),
      '#default_value' => (isset($record['mobilenumber']) && $_GET['num']) ? $record['mobilenumber']:'',
    ];

    $form['candidate_mail'] = [
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
      '#default_value' => (isset($record['email']) && $_GET['num']) ? $record['email']:'',
    ];

    $form['candidate_age'] = [
      '#type' => 'textfield',
      '#title' => t('AGE'),
      '#required' => TRUE,
      '#default_value' => (isset($record['age']) && $_GET['num']) ? $record['age']:'',
    ];

    $form['candidate_gender'] = [
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'Female' => t('Female'),
        'male' => t('Male'),
        '#default_value' => (isset($record['gender']) && $_GET['num']) ? $record['gender']:'',
      ),
    ];

    $form['web_site'] = [
      '#type' => 'textfield',
      '#title' => t('web site'),
      '#default_value' => (isset($record['website']) && $_GET['num']) ? $record['website']:'',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'save',
      //'#value' => t('Submit'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $field = $form_state->getValues();

    $field  = array(
      'name'   => Html::escape($field['candidate_name']),
      'mobilenumber' =>  Html::escape($field['mobile_number']),
      'email' =>  Html::escape($field['candidate_mail']),
      'age' => Html::escape($field['candidate_age']),
      'gender' => Html::escape($field['candidate_gender']),
      'website' => Html::escape($field['web_site']),
    );
    $query = \Drupal::database();
    $query ->insert('my_simple_crud')
      ->fields($field)
      ->execute();

    //$this->messenger()->addStatus('Wpis: '.Html::escape($field['candidate_name']).' został dodany');
    return $form_state->setRedirect('my_simple_crud.crud_controller_display');

  }

}