<?php
namespace JBK\Core\Entities;

use \JBK\Core\GlobalSettings\Settings;

if ( ! defined( 'ABSPATH' ) ) exit;

class PostTypes
{
  static public function get_bookable_post_types() : array
  {
    return array_keys( static::get_all_connections() );
  }

  static private function get_all_connections() : array
  {
    static $all_connections;

    if ( ! isset( $all_connections ) )
    {
      $all_connections = [];

      foreach ( Settings::get_instance()->get_one( 'connections' ) as $post_type_slug => $connected_post_types )
      {
        $all_connections[ $post_type_slug ] = $connected_post_types;

        foreach ( $connected_post_types as $connected_post_type_slug => $connection_type )
        {
          $all_connections[ $connected_post_type_slug ][ $post_type_slug ] =
            implode( '_', array_reverse( explode( '_', $connection_type ) ) );
        }
      }
    }

    return $all_connections;
  }

  static public function get_connections( string $slug ) : array | null
  {
    return static::get_all_connections()[ $slug ] ?? null;
  }

  static public function get_connection( string $slug_1, string $slug_2 ) : string | null
  {
    if ( ! static::is_bookable( $slug_1 ) || ! static::is_bookable( $slug_2 ) )
    {
      return null;
    }

    return static::get_connections( $slug_1 )[ $slug_2 ] ?? null;
  }

  static public function have_connection( string $slug_1, string $slug_2 ) : bool
  {
    return !! static::get_connection( $slug_1, $slug_2 );
  }

  static public function is_bookable( string $slug ) : bool
  {
    return in_array( $slug, static::get_bookable_post_types() );
  }
}
