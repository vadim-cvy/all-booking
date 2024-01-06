<?php
namespace JBK;

use \JBK\Core\Popups\Popup;
use \JBK\Imp\Entities\GuidPostType;
use \JBK\Imp\Entities\VehiclePostType;
use \JBK\Imp\Popups\CustomFields\Waiver;

if ( ! defined( 'ABSPATH' ) ) exit;

class TrackPopup extends Popup
{
  protected function get_fields_structure() : array
  {
    return [
      [
        'name' => 'guid',
        'label' => 'Guid',
        'type' => 'connected_entity',
        'entity' => GuidPostType::get_slug(),
        'input' => [
          'type' => 'toggle',
          'default' => true,
        ],
      ],
      [
        'name' => 'persons_number',
        'label' => 'Persons Number',
        'hint' => 'Minimum 3 persons.',
        'type' => 'connected_entity',
        'entity' => VehiclePostType::get_slug(),
        'input' => [
          'type' => 'select',
          'allow_psc_update' => true,
          'psc' => 3,
        ],
        'sub_fields' => [
          [
            'name' => 'driver',
            'label' => 'Driver',
            'hint' => 'Select a driver in case you want to take tour as a passanger, not driver.',
            'type' => 'connected_entity',
            'entity' => GuidPostType::get_slug(),
            'input' => [
              'type' => 'toggle',
            ],
          ]
        ],
      ],
      Waiver::get_structure(),
    ];
  }
}