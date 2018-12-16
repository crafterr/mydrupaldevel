<?php
namespace Drupal\hello_world\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;

class HelloWorldAccess implements AccessInterface {

  /**
   * @var ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * HelloWorldAccess constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   */
  public function __construct(ConfigFactoryInterface $configFactory) {
    $this->configFactory = $configFactory;
  }


  /**
   * Handles the access checking.
   *
   * @param AccountInterface $account
   *
   * @return AccessResult
   */
  public function access(AccountInterface $account) {
    $salutation = $this->configFactory->get('hello_world.custom_salutation')->get('salutation_good_morning');

    return in_array('editor', $account->getRoles()) && $salutation != "" ? AccessResult::forbidden() : AccessResult::allowed();
  }
}