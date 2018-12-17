<?php

namespace Drupal\hello_world\Ajax;

use Drupal\Core\Ajax\CommandInterface;
use \Symfony\Component\HttpFoundation\Response;


class HelloCommand implements CommandInterface{

  public function render() {
    $manager = \Drupal::languageManager();
    $language = $manager->getCurrentLanguage();
    $build = array(
      '#theme' => 'hello_world_content',
      '#params' => ['adam','maciek','grzesiek'],
      '#language' => $language
    );

    // This is the important part, because will render only the TWIG template.
    $response = render($build);
    return [
      'response' => $response,
      'command' => 'example',
      'message' => 'My Awesome Message'
    ];
  }

}