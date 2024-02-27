<?php
namespace JBK\Core;

use \Cvy\DesignPatterns\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Main extends Singleton
{
  protected function __construct()
  {
    \JBK\Core\Filters\Settings\Settings::get_instance();
    \JBK\Core\Filters\Settings\SettingsPage::get_instance();
  }
}