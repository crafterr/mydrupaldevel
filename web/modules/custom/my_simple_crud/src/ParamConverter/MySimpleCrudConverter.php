<?php
namespace Drupal\my_simple_crud\ParamConverter;

use Drupal\Core\ParamConverter\ParamConverterInterface;
use Drupal\my_simple_crud\StorageServiceInterface;
use Symfony\Component\Routing\Route;

class MySimpleCrudConverter implements ParamConverterInterface {

  private $storageService;

  public function __construct(StorageServiceInterface $storageService) {
    $this->storageService = $storageService;
  }

  public function convert($value, $definition, $name, array $defaults) {
    if (!$this->storageService->exists($value)) {
      return 'invalid';
    }
    return $this->storageService->load($value);
  }

  public function applies($definition, $name, Route $route) {
    return (!empty($definition['type']) && $definition['type'] == 'my_simple_crud');
  }

}