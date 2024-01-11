<?php
namespace JBK\Core\Pts;

use \Exception;
use \JBK\Core\GlobalSettings\Settings as GlobalSettings;

if ( ! defined( 'ABSPATH' ) ) exit;

class PostTypes
{
  static public function get_public() : array
  {
    $slugs = array_values(get_post_types([
      'public' => true,
      '_builtin' => false,
    ]));

    return array_map(
      fn( $slug ) => PostType::get_instance( $slug ),
      $slugs
    );
  }

  static public function get_bookable() : array
  {
    return array_map(
      fn( $slug ) => PostType::get_instance( $slug ),
      GlobalSettings::get_instance()->get_bookable_pts()
    );
  }

  static public function get_connections() : array
  {
    static $connections;

    if ( ! isset( $connections ) )
    {
      $connections = [];

      foreach ( GlobalSettings::get_instance()->get_pt_connections() as $connection_key => $connection_type )
      {
        $pt_slugs = explode( '/', $connection_key );

        if ( ! isset( $connections[ $pt_slugs[0] ] ) )
        {
          $connections[ $pt_slugs[0] ] = [];
        }

        if ( ! isset( $connections[ $pt_slugs[1] ] ) )
        {
          $connections[ $pt_slugs[1] ] = [];
        }

        $connections[ $pt_slugs[0] ][ $pt_slugs[1] ] = [
          'pt' => PostType::get_instance( $pt_slugs[1] ),
          'type' => $connection_type,
        ];

        $connections[ $pt_slugs[1] ][ $pt_slugs[0] ] = [
          'pt' => PostType::get_instance( $pt_slugs[0] ),
          'type' => implode( '_', array_reverse( explode( '_', $connection_type ) ) ),
        ];
      }
    }

    return $connections;
  }

  static public function validate_is_bookable( string $slug ) : void
  {
    if ( ! static::is_bookable( $slug ) )
    {
      throw new Exception( $slug . ' is not bookable!' );
    }
  }

  static public function is_bookable( string $slug ) : bool
  {
    foreach ( static::get_bookable() as $pt )
    {
      if ( $pt->get_slug() === $slug )
      {
        return true;
      }
    }

    return false;
  }
}
