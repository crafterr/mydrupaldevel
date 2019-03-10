<?php
namespace Drupal\sandwich_types\Plugin\SandwichPlugin;

use Drupal\sandwich\Annotation\SandwichPlugin;
use Drupal\sandwich\Plugin\SandwichPluginBase;

/**
 * Provides a hamburger sandwich.
 *
 * @SandwichPlugin(
 *   id = "hamburger",
 *   description = @Translation("Ketchup, Ham, mustard, rocket, sun-dried tomatoes."),
 *   calories = 1000
 * )
 */
class ExampleHamSandwich extends SandwichPluginBase {

  /**
   * {inheritdoc}
   */
  public function order(array $extras) {
    $ingredients = array('Ketchup, ham, mustard', 'rocket', 'sun-dried tomatoes');
    $sandwich = array_merge($ingredients, $extras);
    return 'You ordered an ' . implode(', ', $sandwich) . ' sandwich. Enjoy!';
  }
}