<?php
namespace JBK\Imp\Entities;

use \JBK\Core\Entities\PostType;
use \JBK\Core\Entities\iLimitable;
use \JBK\Core\Entities\iBlockable;

if ( ! defined( 'ABSPATH' ) ) exit;

class TrackPostType extends PostType implements iLimitable, iBlockable
{
  static protected function get_slug_base() : string
  {
    return 'track';
  }

  static public function get_label_single() : string
  {
    return 'Track';
  }

  static public function get_label_multiple() : string
  {
    return 'Tracks';
  }
}