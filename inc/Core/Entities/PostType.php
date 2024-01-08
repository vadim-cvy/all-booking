<?php
namespace JBK\Core\Entities;

use \JBK\Core\Entities\Settings\Settings;
use \JBK\Core\Entities\Settings\SettingsPage;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class PostType extends \Cvy\WP\PostTypes\CustomPostType
{
  private Settings $settings;

  private SettingsPage $settings_page;

  protected function __construct()
  {
    parent::__construct();

    $this->settings = new Settings( $this );

    $this->settings_page = new SettingsPage( $this );
  }

  static public function get_slug() : string
  {
    return 'jbk_' . static::get_slug_base();
  }

  abstract static protected function get_slug_base() : string;

  protected function get_register_args() : array
  {
    $args = parent::get_register_args();

    $args['rewrite'] = [
      'slug' => str_replace( '_', '-', $this->get_slug_base() ),
    ];

    return $args;
  }

  public function get_settings_page() : SettingsPage
  {
    return $this->settings_page;
  }

  public function get_settings() : Settings
  {
    return $this->settings;
  }
}