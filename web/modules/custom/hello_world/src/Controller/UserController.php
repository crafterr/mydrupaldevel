<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 09/12/2018
 * Time: 15:55
 */

namespace Drupal\hello_world\Controller;


use Drupal\Core\Access\AccessResult;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\AppendCommand;
use Drupal\Core\Ajax\RemoveCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Drupal\hello_world\Ajax\HelloCommand;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

  public function hideBlock(Request $request)
  {
    if (!$request->isXmlHttpRequest()) {
      throw new NotFoundHttpException();
    }

    $response = new AjaxResponse();
    //$command = new RemoveCommand('.dupa');
   // $response->addCommand($command);
    $response->addCommand(new ReplaceCommand('div.content2',$this->getContent()));
    return $response;
  }


  private function getContent()
  {
    $manager = \Drupal::languageManager();
    $language = $manager->getCurrentLanguage();

    $allLang = $manager->getLanguages();
    //dump($allLang); die();
    $build = array(
      '#theme' => 'hello_world_content',
      '#params' => ['adam','maciek','grzesiek'],
      '#language' => $language,
      '#languages' => $allLang
    );

    return $build;
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