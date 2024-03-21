<?php
namespace Jab;

use Jab\FilterPopupFields\Field;
use Jab\FilterPopupFields\PtField;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Filter
{
  private int $id;

  private array $raw_data;

  private array $popup_field_instances;

  public function __construct( int $id, array $raw_data = [] )
  {
    $this->id = $id;

    $this->raw_data = ! empty( $raw_data ) ? $raw_data : $this->load_raw_data();
  }

  public function get_id() : int
  {
    return $this->id;
  }

  public function get_label() : string
  {
    return $this->raw_data['label'];
  }

  public function get_popup_fields() : array
  {
    if ( ! isset( $this->popup_field_instances ) )
    {
      foreach ( $this->raw_data['popup']['fields'] as $field_data )
      {
        switch ( $field_data['type'] )
        {
          case 'pt':
            $field_class_name = PtField::class;
            break;

          default:
            $field_class_name = Field::class;
            break;
        }

        $this->popup_field_instances[] = new $field_class_name( $field_data['id'], $field_data );
      }
    }

    return $this->popup_field_instances;
  }

  public function get_popup_field( int $field_id ) : FilterPopupField | null
  {
    foreach ( $this->get_popup_fields() as $field )
    {
      if ( $field->get_id() === $field_id )
      {
        return $field;
      }
    }

    return null;
  }

  public function exists() : bool
  {
    return ! empty( $this->load_raw_data() );
  }

  private function load_raw_data() : array
  {
    return array_filter( Settings::get()['filters'],
      fn( $filter ) => $filter['id'] === $this->get_id()
    )[0] ?? [];
  }

  public function save() : void
  {
    // todo

    // todo: dont save popup fields from raw data but rather use each($this->get_popup_fields())->save()
  }
}