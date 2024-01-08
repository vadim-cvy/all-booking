<?php
/*
 * Plugin Name: All Booking
 */

use \JBK\Imp\Entities\TrackPostType;
use \JBK\Imp\Entities\GuidPostType;
use \JBK\Imp\Entities\VehiclePostType;
use \JBK\Imp\Filters\TracksFilter;
use \JBK\Imp\Filters\VehiclesFilter;


if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/init.php';

\JBK\Core\Main::get_instance();

TrackPostType::get_instance();
GuidPostType::get_instance();
VehiclePostType::get_instance();

// TracksFilter::get_instance();
// VehiclesFilter::get_instance();