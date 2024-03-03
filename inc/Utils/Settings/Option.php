<?php
namespace Jab\Utils\Settings;

use Jab\Utils\Hooks\iHookable;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class Option
{
  use \Jab\Utils\Hooks\tHookable;

  final static public function get() : array
  {
    $value = get_option( static::get_option_name(), static::get_default_value() );

    return static::apply_filters( 'value', $value );
  }

  final static public function update( array $value ) : void
  {
    update_option( static::get_option_name(), $value );

    static::do_action( 'updated', $value );
  }

  abstract static protected function get_default_value_raw() : array;

  final static protected function get_default_value() : array
  {
    return static::apply_filters( 'default_value', static::get_default_value_raw() );
  }

  abstract static public function get_option_name() : string;

  final static protected function get_hook_base_args() : array
  {
    return [ static::get_option_name() ];
  }

  final static protected function get_hook_name_prefix() : string
  {
    return 'option/';
  }

  final static protected function get_parent_hookable() : iHookable | null
  {
    return null;
  }
}