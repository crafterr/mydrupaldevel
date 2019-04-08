<?php

namespace Drupal\transport\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Transport plugin plugin manager.
 */
class TransportPluginManager extends DefaultPluginManager {


  /**
   * Constructs a new TransportPluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/TransportPlugin', $namespaces, $module_handler, 'Drupal\transport\Plugin\TransportPluginInterface', 'Drupal\transport\Annotation\TransportPlugin');

    $this->alterInfo('transport_transport_plugin_info');
    $this->setCacheBackend($cache_backend, 'transport_transport_plugin_plugins');
  }

}
