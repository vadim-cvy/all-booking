<?php
namespace Jab\Filters\Settings;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Settings extends \Jab\Utils\Settings\Option
{
  static protected function get_default_value_raw() : array
  {
    return [];
  }

  static public function get_option_name() : string
  {
    return 'jab_filters_settings';
  }
}