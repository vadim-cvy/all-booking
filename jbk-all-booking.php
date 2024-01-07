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

TrackPostType::get_instance();
GuidPostType::get_instance();
VehiclePostType::get_instance();

// Structure::get_instance();

// TracksFilter::get_instance();
// VehiclesFilter::get_instance();