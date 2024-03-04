<?php
namespace Jab;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Filters
{
  static public function get_all() : array
  {
    return Settings::get_filters();
  }

  static public function get_by_id( int $id ) : array | null
  {
    return array_filter( static::get_all(), fn( $filter ) => $filter['id'] === $id )[0] ?? null;
  }

  static public function get_popup_field( int $field_id ) : array | null
  {
    foreach ( static::get_all() as $filter )
    {
      foreach ( $filter['popup']['fields'] as $field )
      {
        if ( $field['id'] === $field_id )
        {
          return $field;
        }
      }
    }

    return null;
  }
}