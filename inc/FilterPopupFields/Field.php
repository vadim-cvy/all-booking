<?php
namespace Jab\FilterPopupFields;

if ( ! defined( 'ABSPATH' ) ) exit;

class Field
{
  private int $id;

  protected array $raw_data;

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

  public function get_type() : string
  {
    return $this->raw_data['type'];
  }

  public function is_required() : bool
  {
    return ! empty( $this->raw_data['is_required'] );
  }

  public function is_hidden() : bool
  {
    return ! empty( $this->raw_data['is_hidden'] );
  }

  private function load_raw_data() : array
  {
    // todo
  }

  public function save() : void
  {
    // todo
  }
}