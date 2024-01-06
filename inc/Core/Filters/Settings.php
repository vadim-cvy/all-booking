<?php
namespace JBK\Core\Filters;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class Settings
{
  // static abstract protected function get_post_type() : ItemsPostType;

  // static public function are_unavailable_hidden_by_default() : bool
  // {
  //   return static::get_option( 'are_unavailable_hidden_by_default', true );
  // }

  // static public function get_per_page() : bool
  // {
  //   return static::get_option( 'per_page', 10 );
  // }

  // static public function get_max_future_days() : int
  // {
  //   return static::get_option( 'max_future_days', 180 );
  // }

  // static final protected function get_option( string $name, $default_value = null )
  // {
  //   $post_type_slug = static::get_post_type()->get_slug();

  //   return get_option( "jbk_{$post_type_slug}_$name", $default_value );
  // }
}