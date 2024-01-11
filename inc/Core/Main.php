<?php
namespace JBK\Core;

use \Cvy\DesignPatterns\Singleton;
use \JBK\Core\GlobalSettings\Settings as GlobalSettings;
use \JBK\Core\GlobalSettings\SettingsPage as GlobalSettingsPage;
use \JBK\Core\Pts\PostTypes as PostTypes;
use \JBK\Core\Pts\Settings\Settings as PostTypeSettings;
use \JBK\Core\Pts\Settings\SettingsPage as PostTypeSettingsPage;

if ( ! defined( 'ABSPATH' ) ) exit;

class Main extends Singleton
{
  protected function __construct()
  {
    $this->init_global_settings();

    $this->init_post_type_settings();
  }

  private function init_global_settings()
  {
    GlobalSettings::get_instance();
    GlobalSettingsPage::get_instance();
  }

  private function init_post_type_settings()
  {
    foreach ( PostTypes::get_bookable() as $pt )
    {
      PostTypeSettingsPage::get_instance( $pt );
    }
  }
}