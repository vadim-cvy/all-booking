<?php
namespace Jab\Filters;

use Jab\Filters\PopupFields\Field;
use Jab\Settings\Settings;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Filters
{
  static public function get_all() : array
  {
    $filters = [];

    foreach ( Settings::get()['filters'] as $filter_data )
    {
      $filters[] = new Filter( $filter_data['id'], $filter_data );
    }

    return $filters;
  }

  static public function get_popup_field( int $field_id ) : Field | null
  {
    foreach ( static::get_all() as $filter )
    {
      $field = $filter->get_popup_field( $field_id );

      if ( $field )
      {
        return $field;
      }
    }

    return null;
  }
}