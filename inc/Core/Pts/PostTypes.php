<?php
namespace JBK\Core\Pts;

if ( ! defined( 'ABSPATH' ) ) exit;

final class PostTypes
{
  static public function get_public() : array
  {
    $slugs = array_values(get_post_types([
      'public' => true,
      '_builtin' => false,
    ]));

    return array_map(
      fn( $slug ) => PostType::get_instance( $slug ),
      $slugs
    );
  }
}
