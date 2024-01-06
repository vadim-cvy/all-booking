<?php
namespace JBK\Core\Popups\CustomFields;

use \JBK\Core\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class CustomField extends Singleton
{
  public function __construct( PostType $pt )
  {
    // todo
  }

  abstract public function render() : void;

  abstract protected function get_modify_vue_object_code() : string;

  abstract protected function get_price( Booking $booking ) : int;

  abstract protected function get_post_types() : array;

  abstract public function get_structure() : array;
}