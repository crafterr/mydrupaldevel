<?php

namespace Drupal\event_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\event_example\Event\IncidentEvent;
use Drupal\event_example\Event\IncidentEvents;
use Drupal\event_example\Event\IncidentReportEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\webprofiler\EventDispatcher\TraceableEventDispatcher;

/**
 * Class EventExampleForm.
 */
class EventExampleForm extends FormBase {

  /**
   * Drupal\webprofiler\EventDispatcher\TraceableEventDispatcher definition.
   *
   * @var \Drupal\webprofiler\EventDispatcher\TraceableEventDispatcher
   */
  protected $eventDispatcher;
  /**
   * Constructs a new EventExampleForm object.
   */
  public function __construct(TraceableEventDispatcher $event_dispatcher) {
    $this->eventDispatcher = $event_dispatcher;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('event_dispatcher')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'event_example_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['incident_type'] = [
      '#type' => 'radios',
      '#required' => TRUE,
      '#title' => $this->t('What type of incident do you want to report?'),
      '#options' => [
        'stolen_princess' => $this->t('Missing princess'),
        'cat' => $this->t('Cat stuck in tree'),
        'joker' => $this->t('Something involving the Joker'),
      ],
    ];
    $form['incident'] = [
      '#type' => 'textarea',
      '#required' => FALSE,
      '#title' => $this->t('Incident report'),
      '#description' => $this->t('Describe the incident in detail. This information will be passed along to all crime fighters.'),
      '#cols' => 60,
      '#rows' => 5,
    ];
    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $type = $form_state->getValue('incident_type');
    $report = $form_state->getValue('incident');
    $event = new IncidentReportEvent($type,$report);
    $this->eventDispatcher->dispatch(IncidentEvent::NEW_REPORT,$event);


  }

}
