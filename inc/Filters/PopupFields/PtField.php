<?php
namespace Jab\Filters\PopupFields;

if ( ! defined( 'ABSPATH' ) ) exit;

class PtField extends Field
{
  public function is_qty_adjustable() : bool
  {
    return $this->get_raw_data()['is_qty_adjustable'];
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

  public function is_visible_in_filter_controls() : bool
  {
    return true;
  }
}