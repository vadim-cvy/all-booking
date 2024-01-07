<?php
namespace JBK\Core\Entities;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class PostType extends \Cvy\WP\PostTypes\CustomPostType
{
  final static public function get_slug() : string
  {
    return 'jbk_' . static::get_slug_base();
  }

  abstract static protected function get_slug_base() : string;

  protected function get_register_args() : array
  {
    $args = parent::get_register_args();

    $args['rewrite'] = [
      'slug' => str_replace( '_', '-', $this->get_slug_base() ),
    ];

    return $args;
  }
}