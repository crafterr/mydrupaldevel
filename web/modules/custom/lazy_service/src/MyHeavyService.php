<?php

namespace Drupal\lazy_service;
class MyHeavyService  implements HeavyServiceInterface {

  public function __construct() {
    //sleep(4);
  }

  public function doSomething() {
    return __CLASS__;
  }

}