<?php
namespace Jab;

if ( ! defined( 'ABSPATH' ) ) exit;

// todo: add hooks
final class FilterRelatedPost
{
  private int $id;

  public function __construct( int $id )
  {
    $this->id = $id;
  }

  public function get_id() : int
  {
    return $this->id;
  }

  public function get_limit() : int | null
  {
    return $this->get_meta( 'limit' );
  }

  public function get_popup_field_overrides( int $field_id ) : array
  {
    return $this->get_meta( 'popup_field_overrides_' . $field_id ) ?? [];
  }

  public function update_popup_field_overrides( int $field_id, array $overrides ) : array
  {
    $meta_key = 'popup_field_overrides_' . $field_id;

    if ( empty( $overrides ) )
    {
      $this->delete_meta( $meta_key );
    }
    else
    {
      $this->update_meta( $meta_key, $overrides );
    }
  }

  private function get_meta( string $meta_key, mixed $default = null ) : mixed
  {
    $value = get_post_meta( $this->id, 'jab_' . $meta_key, true );

    if ( $value === '' )
    {
      $value = $default;
    }

    return $value;
  }

  private function update_meta( string $meta_key, mixed $meta_value ) : void
  {
    update_post_meta( $this->id, 'jab_' . $meta_key, $meta_value );
  }

  private function delete_meta( string $meta_key ) : void
  {
    delete_post_meta( $this->id, 'jab_' . $meta_key );
  }

  public function has_related_popup_fields() : bool
  {
    return ! empty( $this->get_related_popopup_field_ids() );
  }

  public function get_related_popopup_field_ids() : array
  {
    $related_fields_ids = [];

    foreach ( Filters::get_all() as $filter )
    {
      $filter_related_fields = array_filter( $filter['popup']['fields'], fn( $field ) =>
        $field['type'] === 'pt'
        && $field['pt'] === get_post_type( $this->id )
      );

      $related_fields_ids = array_merge(
        $related_fields_ids,
        array_map( fn( $field ) => $field['id'], $filter_related_fields )
      );
    }

    return $related_fields_ids;
  }
}