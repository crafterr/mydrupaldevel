<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class TranslatorController.
 */
class TranslatorController extends ControllerBase {

  public function hello() {
    $accountProxy = \Drupal::currentUser();
    $user = \Drupal::entityTypeManager()->getStorage('user')->load($accountProxy->id());

    $url = 'http://www.onet.pl';

    /**
     * :variable = Use this style of placeholder when substituting the value of an href attribute. Values will be HTML escaped and filtered for dangerous protocols.
     */
    $urlLink = t('Hello <a href=":url">@name</a>', array(':url' => 'http://example.com', '@name' => 'Adam'));


    /**
     * %variable
     */

    /**
     * Use this style of placeholder to pass text through drupal_placeholder() which will result in the text being HTML escaped, and then wrapped with <em> tags.
     */
    /**
     * output
     * The file was saved to <em class="placeholder">sites/default/files/myfile.txt</em>.
     */

    $path_to_file = 'sites/default/files/myfile.txt';
    t('The file was saved to %path.', array('%path' => $path_to_file));





    // dump($userName); die();

    //:variable
    /**
     * t('Hello <a href=":url">@name</a>', array(':url' => 'http://example.com', '@name' => $name));
     */
    $title = t('@name Blog', array('@name' => $user->getDisplayName()));

    return [
      '#type' => 'markup',
      '#markup' => $urlLink
    ];
  }

}
