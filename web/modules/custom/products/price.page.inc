<?php

/**
 * @file
 * Contains price.page.inc.
 *
 * Page callback for Price entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Price templates.
 *
 * Default template: price.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_price(array &$variables) {
  // Fetch Price Entity Object.
  $price = $variables['elements']['#price'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
