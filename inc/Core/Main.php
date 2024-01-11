<?php
namespace JBK\Core;

use \Cvy\DesignPatterns\Singleton;
use \JBK\Core\Pts\PostTypes;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Main extends Singleton
{
  protected function __construct()
  {
    $this->init_global_settings();

    $this->init_post_type_settings();
  }

  private function init_global_settings()
  {
    \JBK\Core\GlobalSettings\Settings::get_instance();
    \JBK\Core\GlobalSettings\SettingsPage::get_instance();
  }

  private function init_post_type_settings()
  {
    foreach ( PostTypes::get_bookable() as $pt )
    {
      \JBK\Core\Pts\Settings\SettingsPage::get_instance( $pt );
      \JBK\Core\Pts\SinglePost\SettingsMetabox::get_instance( $pt );
    }
  }
}