<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 12/11/2018
 * Time: 10:31
 */

namespace Drupal\hello_world\Logger;


use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Logger\RfcLoggerTrait;
use Drupal\Core\Logger\RfcLogLevel;
use Psr\Log\LoggerInterface;
use Drupal\Core\Logger\LogMessageParserInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

class MailLogger implements  LoggerInterface
{
  use RfcLoggerTrait;

  /**
   * @var \Drupal\Core\Logger\LogMessageParserInterface
   */
  protected $parser;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * MailLogger constructor.
   *
   * @param \Drupal\Core\Logger\LogMessageParserInterface $parser
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   */
  public function __construct(LogMessageParserInterface $parser,ConfigFactoryInterface $configFactory) {
    $this->parser = $parser;
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public function log($level, $message, array $context = array()) {
    if ($level !== RfcLogLevel::ERROR) {
      return;
    }

    $to = $this->configFactory->get('system.site')->get('mail');
    $langode = $this->configFactory->get('system.site')->get('langcode');
    $variables = $this->parser->parseMessagePlaceholders($message, $context);
    $markup = new FormattableMarkup($message, $variables);
    \Drupal::service('plugin.manager.mail')->mail('hello_world', 'hello_world_log', $to, $langode, ['message' => $markup]);
  }
}