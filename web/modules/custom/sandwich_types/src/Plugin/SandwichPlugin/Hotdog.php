<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 10/03/2019
 * Time: 17:53
 */

namespace Drupal\sandwich_types\Plugin\SandwichPlugin;

use Drupal\sandwich\Plugin\SandwichPluginBase;


/**
 * Provides a hamburger sandwich.
 *
 * @SandwichPlugin(
 *   id = "hotdog",
 *   description = @Translation("Ketchup, Sassuage, mustard, rocket, sun-dried tomatoes."),
 *   calories = 1000
 * )
 */
class Hotdog extends SandwichPluginBase {

  public function order(array $extras) {
    return 'You ordered hotdog';
  }

}