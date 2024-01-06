<?php
namespace JBK;

use \JBK\Core\Entities\PostType;
use \JBK\Core\Entities\iLimitable;
use \JBK\Core\Entities\iBlockable;

if ( ! defined( 'ABSPATH' ) ) exit;

class GuidPostType extends PostType implements iLimitable, iBlockable
{
  // todo
}