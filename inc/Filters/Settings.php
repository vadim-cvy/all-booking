<?php
namespace Jab\Filters;

if ( ! defined( 'ABSPATH' ) ) exit;

class Settings
{
  static public function get() : array
  {
    return get_option( static::get_option_name(), [] );
  }

  static public function get_option_name() : string
  {
    return 'jab_filters_settings';
  }
}