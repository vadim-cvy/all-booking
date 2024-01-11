<?php
namespace JBK;

use \JBK\Core\Popups\Popup;
use \JBK\Imp\Pts\VehiclePostType;
use \JBK\Imp\Popups\CustomFields\Waiver;

if ( ! defined( 'ABSPATH' ) ) exit;

class VehiclePopup extends Popup
{
  protected function get_fields_structure() : array
  {
    return [
      [
        'name' => 'vehicles',
        'label' => 'Vehicles',
        'type' => 'connected_pt',
        'pt' => VehiclePostType::get_slug(),
        'input' => [
          'type' => 'select',
          'allow_psc_update' => true,
        ],
      ],
      Waiver::get_structure(),
    ];
  }
}