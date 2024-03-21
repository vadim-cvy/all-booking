<?php
namespace Jab\FilterPopupFields;

if ( ! defined( 'ABSPATH' ) ) exit;

class PtField extends Field
{
  public function is_number_adjustable() : bool
  {
    return $this->get_raw_data()['is_number_adjustable'];
  }

  public function get_default_number() : int
  {
    return $this->get_raw_data()['default_number'];
  }

  public function get_max_number() : int
  {
    return $this->get_raw_data()['max_number'];
  }

  public function get_min_number() : int
  {
    return $this->get_raw_data()['min_number'];
  }

  public function get_pt() : string
  {
    return $this->get_raw_data()['pt'];
  }

  // todo: is selectable
}