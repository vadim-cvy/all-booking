<?php
namespace Jab\FilterPopupFields;

if ( ! defined( 'ABSPATH' ) ) exit;

class PtField extends Field
{
  public function is_number_adjustable() : bool
  {
    return $this->raw_data['is_number_adjustable'];
  }

  public function get_default_number() : int
  {
    return $this->raw_data['default_number'];
  }

  public function get_max_number() : int
  {
    return $this->raw_data['max_number'];
  }

  public function get_min_number() : int
  {
    return $this->raw_data['min_number'];
  }

  // todo: is selectable
}