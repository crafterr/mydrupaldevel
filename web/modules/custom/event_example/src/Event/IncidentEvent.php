<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 20/04/2019
 * Time: 18:55
 */

namespace Drupal\event_example\Event;


final class IncidentEvent {

  /**
   * @Event
   *
   */
  const NEW_REPORT = 'event_example.new_incident_report';
}