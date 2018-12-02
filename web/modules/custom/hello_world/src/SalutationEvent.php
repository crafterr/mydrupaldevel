<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 11/11/2018
 * Time: 22:28
 */

namespace Drupal\hello_world;


use Symfony\Component\EventDispatcher\Event;

class SalutationEvent extends Event
{

  const EVENT = 'hello_world.salutation_event';

  /**
   * @var string
   */
  protected $message;

  public function getValue()
  {
    return $this->message;
  }

  public function setValue($message)
  {
    $this->message = $message;
  }

}