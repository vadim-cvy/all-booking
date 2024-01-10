<?php
namespace JBK\Core\Entities;

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
      GlobalSettings::get_instance()->get_bookable_entities()
    );
  }

  static public function get_connections() : array
  {
    static $connections;

    if ( ! isset( $connections ) )
    {
      $connections = [];

      foreach ( GlobalSettings::get_instance()->get_entity_connections() as $pt_slug => $connected_pts )
      {
        $connections[ $pt_slug ] = $connected_pts;

        foreach ( $connected_pts as $connected_pt_slug => $connection_type )
        {
          $connections[ $connected_pt_slug ][ $pt_slug ] =
            implode( '_', array_reverse( explode( '_', $connection_type ) ) );
        }
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
