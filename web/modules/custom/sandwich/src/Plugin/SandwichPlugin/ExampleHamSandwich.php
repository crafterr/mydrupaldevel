<?php
namespace Drupal\sandwich\Plugin\SandwichPlugin;

use Drupal\sandwich\Annotation\SandwichPlugin;
use Drupal\sandwich\Plugin\SandwichPluginBase;

/**
 * Provides a ham sandwich.
 *
 * @SandwichPlugin(
 *   id = "ham_sandwich",
 *   description = @Translation("Ham, mustard, rocket, sun-dried tomatoes."),
 *   calories = 426
 * )
 */
class ExampleHamSandwich extends SandwichPluginBase {

  /**
   * {inheritdoc}
   */
  public function order(array $extras) {
    $ingredients = array('ham, mustard', 'rocket', 'sun-dried tomatoes');
    $sandwich = array_merge($ingredients, $extras);
    return 'You ordered an ' . implode(', ', $sandwich) . ' sandwich. Enjoy!';
  }
}