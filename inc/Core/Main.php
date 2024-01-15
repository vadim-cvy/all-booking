<?php
namespace JBK\Core;

use \Cvy\DesignPatterns\Singleton;
use \JBK\Core\Pts\PostTypes;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Main extends Singleton
{
  protected function __construct()
  {
    $this->init_settings();
  }

  private function init_settings()
  {
    \JBK\Core\GlobalSettings\Settings::get_instance();
    \JBK\Core\GlobalSettings\SettingsPage::get_instance();

    \JBK\Core\Filters\Settings\Settings::get_instance();
    \JBK\Core\Filters\Settings\SettingsPage::get_instance();

    foreach ( PostTypes::get_bookable() as $pt )
    {
      \JBK\Core\Pts\Settings\SettingsPage::get_instance( $pt );
      \JBK\Core\Pts\SinglePost\SettingsMetabox::get_instance( $pt );
    }
  }
}