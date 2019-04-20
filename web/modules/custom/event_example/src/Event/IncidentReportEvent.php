<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 20/04/2019
 * Time: 19:06
 */

namespace Drupal\event_example\Event;

use Symfony\Component\EventDispatcher\Event;

class IncidentReportEvent extends Event{

  protected $type;

  protected $report;

  /**
   * IncidentReportEvent constructor.
   *
   * @param string $type
   * @param string $report
   */
  public function __construct(string $type, string $report) {
    $this->type = $type;
    $this->report = $report;
  }

  /**
   * @return string
   */
  public function getType(): string {
    return $this->type;
  }

  /**
   * @return string
   */
  public function getReport(): string {
    return $this->report;
  }


}