<?php

/**
 * @file
 * Contains \Drupal\icecream\Plugin\Flavor\Vanilla.
 */

namespace Drupal\icecream\Plugin\Flavor;

use Drupal\Core\Annotation\Translation;
use Drupal\icecream\FlavorBase;

/**
 * Provides a 'vanilla' flavor.
 *
 * @Flavor(
 *   id = "vanilla",
 *   name = @Translation("Vanilla"),
 *   price = 1.75,
 *   opinion = @Translation("Fajny jest ogolnie ten smak")
 * )
 */
class Vanilla extends FlavorBase {}
