<?php
namespace JBK\Core\Entities;

if ( ! defined( 'ABSPATH' ) ) exit;

class Structure
{
  static private array $structure;

  static private array $defined_post_types;

  static public function define_structure( array $structure ) : void
  {
    $defined_post_types = [];

    foreach ( $structure as $post_type_slug => $post_type_connections )
    {
      $defined_post_types[] = $post_type_slug;

      foreach ( array_keys( $post_type_connections ) as $connected_post_type_slug )
      {
        $err_prefix = "$post_type_slug can not be connected to $connected_post_type_slug! ";

        if ( ! isset( $structure[ $connected_post_type_slug ] ) )
        {
          throw new Exception(
            $err_prefix . "$connected_post_type_slug do not appear in structure definition root." );
        }

        if ( ! in_array( $connected_post_type_slug, $defined_post_types ) )
        {
          throw new Exception(
            $err_prefix . "$connected_post_type_slug takes lower position in structure definition root." );
        }
      }
    }

    static::$structure = $structure;
    static::$defined_post_types = $defined_post_types;
  }

  static public function get_structure() : array
  {
    static::validate_structure_is_set();

    return static::$structure;
  }

  public function get_defined_post_types() : array
  {
    static::validate_structure_is_set();

    return static::$defined_post_types;
  }

  static private function validate_structure_is_set() : void
  {
    if ( ! isset( static::$structure ) )
    {
      throw new Exception(sprintf(
        'Structure is not set! You must set structure using %s::define_structure().',
        get_called_class()
      ));
    }
  }
}