<?php
namespace JBK;

use \JBK\Core\Entities\PostType;
use \JBK\Core\Entities\iLimitable;
use \JBK\Core\Entities\iBlockable;

if ( ! defined( 'ABSPATH' ) ) exit;

class VehiclePostType extends PostType implements iLimitable, iBlockable
{
  // todo
}