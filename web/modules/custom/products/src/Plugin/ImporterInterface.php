<?php

namespace Drupal\products\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

interface ImporterInterface extends PluginInspectionInterface {

  /**
   * Performs the import. Returns TRUE if the import was successful or FALSE otherwise.
   *
   * @return bool
   */
  public function import();

  /**
   * Returns the Importer configuration entity.
   *
   * @return \Drupal\products\Entity\ImporterInterface
   */
  public function getConfig();
}