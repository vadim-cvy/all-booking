<?php
/*
 * Plugin Name: All Booking
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require __DIR__ . '/vendor/autoload.php';


/**
 * Global Constants
 */
define( 'JAB_ROOT_PATH', __DIR__ . '/' );
define( 'JAB_TEMPLATES_PATH', JAB_ROOT_PATH . 'template-parts/' );



/**
 * Global functions
 */
function jab_resolve_path( string $original_path ) : string
{
  $rel_path = str_replace( JAB_ROOT_PATH, '', $original_path );

  $theme_path = get_theme_file_path( $rel_path );

  return file_exists( $theme_path ) ? $theme_path : $original_path;
}

function jab_get_plugin_name() : string
{
  return get_plugin_data( __FILE__ )['Name'];
}

function jab_enqueue_vue() : string
{
  $handle = 'jab-vue';

  wp_enqueue_script( $handle, 'https://unpkg.com/vue@3.4.19/dist/vue.global.js', [], null, true );

  return $handle;
}

function jab_enqueue_axios() : string
{
  $handle = 'jab-axios';

  wp_enqueue_script( $handle, 'https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js', [], null, true );

  return $handle;
}

function jab_enqueue_local_css( string $handle_base, string $rel_path ) : string
{
  $handle = jab_prefix_asset_handle( $handle_base );
  $url = jab_get_asset_url( $rel_path, 'css' );
  $ver = filemtime( jab_get_asset_path( $rel_path, 'css' ) );

  wp_enqueue_style( $handle, $url, [], $ver );

  return $handle;
}

function jab_enqueue_local_js( string $handle_base, string $rel_path, array $deps = [] ) : string
{
  $handle = jab_prefix_asset_handle( $handle_base );
  $url = jab_get_asset_url( $rel_path, 'js' );
  $ver = filemtime( jab_get_asset_path( $rel_path, 'js' ) );

  wp_enqueue_script( $handle, $url, $deps, $ver, true );

  return $handle;
}

function jab_prefix_asset_handle( string $handle_base ) : string
{
  return 'jab-' . $handle_base;
}

function jab_get_asset_path( string $rel_path, string $asset_type ) : string
{
  return JAB_ROOT_PATH . 'assets/dist/' . $asset_type . '/' . $rel_path;
}

function jab_get_asset_url( string $rel_path, string $asset_type ) : string
{
  return plugin_dir_url( __FILE__ ) . 'assets/dist/' . $asset_type . '/' . $rel_path;
}



/**
 * Init plugin functionality
 */
Jab\Dashboard::get_instance();
Jab\Settings\SettingsPages\Global\Page::get_instance();
Jab\Metaboxes\PtMetabox::get_instance();
Jab\Filters\FilterShortcode\Shortcode::get_instance();