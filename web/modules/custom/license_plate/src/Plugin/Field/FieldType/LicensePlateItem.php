<?php
namespace Drupal\license_plate\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'license_plate_type' field type.
 *
 * @FieldType(
 *   id = "license_plate",
 *   label = @Translation("License plate"),
 *   description = @Translation("Field for creating license plates"),
 *   default_widget = "default_license_plate_widget",
 *   default_formatter = "default_license_plate_formatter"
 * )
 */
class LicensePlateItem extends FieldItemBase {

  /**
   * @inheritdoc
   */
  public static function defaultStorageSettings() {
    return [
        'number_max_length' => 255,
        'code_max_length' => 5,
      ] + parent::defaultStorageSettings();
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * @param bool $has_data
   *
   * @return array
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $elements = [];

    $elements['number_max_length'] = [
      '#type' => 'number',
      '#title' => t('Plate number maximum length'),
      '#default_value' => $this->getSetting('number_max_length'),
      '#required' => TRUE,
      '#description' => t('Maximum length for the plate number in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $elements['code_max_length'] = [
      '#type' => 'number',
      '#title' => t('Plate code maximum length'),
      '#default_value' => $this->getSetting('code_max_length'),
      '#required' => TRUE,
      '#description' => t('Maximum length for the plate code in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    return $elements+parent::storageSettingsForm($form,$form_state,$has_data);
  }

  /**
   * @param \Drupal\Core\Field\FieldStorageDefinitionInterface $field_definition
   *
   * @return array
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'number' => [
          'type' => 'varchar',
          'length' => (int) $field_definition->getSetting('number_max_length'),
        ],
        'code' => [
          'type' => 'varchar',
          'length' => (int) $field_definition->getSetting('code_max_length'),
        ],
      ],
    ];

    return $schema;
  }

  /**
   * @param \Drupal\Core\Field\FieldStorageDefinitionInterface $field_definition
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['number'] = DataDefinition::create('string')
      ->setLabel(t('Plate number'));

    $properties['code'] = DataDefinition::create('string')
      ->setLabel(t('Plate code'));

    return $properties;
  }

  /**
   * @inheritdoc
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();
    $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();
    $number_max_length = $this->getSetting('number_max_length');
    $code_max_length = $this->getSetting('code_max_length');
    $constraints[] = $constraint_manager->create('ComplexData',[
      'number' => [
        'Length' => [
          'max' => $number_max_length,
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel() . ' (number)',
            '@max' => $number_max_length
          ]),
        ],
      ],
      'code' => [
        'Length' => [
          'max' => $code_max_length,
          'maxMessage' => t('%name: may not be longer than @max characters.', [
            '%name' => $this->getFieldDefinition()->getLabel() . ' (code)',
            '@max' => $code_max_length
          ]),
        ],
      ],
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $random = new Random();
    $values['number'] = $random->word(mt_rand(1, $field_definition->getSetting('number_max_length')));
    $values['code'] = $random->word(mt_rand(1, $field_definition->getSetting('code_max_length')));
    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    // We consider the field empty if either of the properties is left empty.
    $number = $this->get('number')->getValue();
    $code = $this->get('code')->getValue();
    return $number === NULL || $number === '' || $code === NULL || $code === '';
  }


}
