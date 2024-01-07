<?php
namespace JBK\Imp\Entities;

use \JBK\Core\Entities\PostType;
use \JBK\Core\Entities\iLimitable;
use \JBK\Core\Entities\iBlockable;

if ( ! defined( 'ABSPATH' ) ) exit;

class GuidPostType extends PostType implements iLimitable, iBlockable
{
  static protected function get_slug_base() : string
  {
    return 'guid';
  }

  static public function get_label_single() : string
  {
    return 'Guid';
  }

  static public function get_label_multiple() : string
  {
    return 'Guides';
  }
}