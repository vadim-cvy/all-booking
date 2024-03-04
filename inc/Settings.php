<?php
namespace Jab;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Settings extends \Jab\Utils\Settings\Option
{
  static public function get_filters() : array
  {
    return static::get()['filters'];
  }

  static protected function get_default_value_raw() : array
  {
    return [
      'filters' => [],
    ];
  }

  static public function get_option_name() : string
  {
    return 'jab';
  }
}