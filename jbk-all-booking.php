<?php
/*
 * Plugin Name: All Booking
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/init.php';

function jbk_get_template_path( string $rel_path ) : string
{
  $rel_path = 'template-parts/' . $rel_path;

  $original_path = JBK_TEMPLATES_PATH . $rel_path;

  $theme_path = get_theme_file_path( $rel_path );

  return file_exists( $theme_path ) ? $theme_path : $original_path;
}
