<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function jbk_get_template_path( string $original_path ) : string
{
  $rel_path = str_replace( JBK_TEMPLATES_PATH, '', $original_path );

  $theme_path = get_theme_file_path( $rel_path );

  return file_exists( $theme_path ) ? $theme_path : $original_path;
}