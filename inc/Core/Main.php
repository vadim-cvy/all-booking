<?php
namespace JBK\Core;

use \Cvy\DesignPatterns\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

class Main extends Singleton
{
  protected function __construct()
  {
    // Structure::get_instance();

    \JBK\Core\GlobalSettings\SettingsPage::get_instance();
  }
}