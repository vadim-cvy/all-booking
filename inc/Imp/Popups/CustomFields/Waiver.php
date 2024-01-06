<?php
namespace JBK;

use \JBK\Core\Popups\CustomFields\CustomField;

if ( ! defined( 'ABSPATH' ) ) exit;

class Waiver extends CustomField
{
  public function render() : void
  {
    // todo
  }

  protected function get_modify_vue_object_code() : string
  {
    // todo
  }

  protected function get_price( Booking $booking ) : int
  {
    // todo
  }

  public function get_strucutre() : array
  {
    return [
      'name' => 'waiver',
      'label' => 'Waiver',
      'type' => 'custom',
      'input' => [
        'type' => 'toggle',
        'default' => true,
        'psc' => 1,
        'allow_psc_update' => false,
      ],
    ];
  }
}