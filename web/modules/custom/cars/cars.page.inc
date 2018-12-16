<?php

/**
 * @file
 * Contains cars.page.inc.
 *
 * Page callback for Cars entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Cars templates.
 *
 * Default template: cars.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_cars(array &$variables) {
  // Fetch Cars Entity Object.
  $cars = $variables['elements']['#cars'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
