<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 09/12/2018
 * Time: 15:55
 */

namespace Drupal\hello_world\Controller;


use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;

class UserController extends ControllerBase{

  public function getUser()
  {
    $accountProxy = \Drupal::currentUser();

    //user session
    $account = $accountProxy->getAccount();
    $account->isAnonymous();
    $account->isAuthenticated();
    $roles = $account->getRoles();
    $s = $account->hasPermission('administrator');

    dump($s);


    $user = \Drupal::entityTypeManager()->getStorage('user')->load($accountProxy->id());

    $url = Url::fromRoute('hello_world.hello');

    $link = [
      '#type' => 'link',
      '#url' => $url,
      '#title' => 'Protected callback'
    ];

    $path = $url->toString();

    dump($path); die();

    if ($url->access()) {
      dump($url); die();
    }


    dump($user->get('name')->value); die();


  }

  /**
   * Handles the access checking.
   *
   * @param AccountInterface $account
   *
   * @return AccessResultInterface
   */
  public function access(AccountInterface $account) {
    return in_array('editor', $account->getRoles()) ? AccessResult::forbidden() : AccessResult::allowed();
  }
}