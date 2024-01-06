<?php
/*
 * Plugin Name: All Booking
 */

use \JBK\Imp\Entities\TrackPostType;
use \JBK\Imp\Entities\GuidPostType;
use \JBK\Imp\Entities\VehiclePostType;
use \JBK\Core\Entities\Structure;
use \JBK\Imp\Filters\TracksFilter;
use \JBK\Imp\Filters\VehiclesFilter;


if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/init.php';

$track_post_type_slug = TrackPostType::get_slug();
$guid_post_type_slug = GuidPostType::get_slug();
$vehicle_post_type_slug = VehiclePostType::get_slug();

Structure::get_instance()->define_structure([
  $guid_post_type_slug => [],

  $vehicle_post_type_slug => [
    $guid_post_type_slug => 'many_to_many_required',
  ],

  $track_post_type_slug => [
    $guide_post_type_slug => 'all_to_all',
    $vehicle_post_type_slug => 'many_required_to_many',
  ],
]);

TracksFilter::get_instance();
VehiclesFilter::get_instance();