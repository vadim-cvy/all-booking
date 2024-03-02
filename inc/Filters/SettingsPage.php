<?php
namespace Jab\Filters;

use \Jab\Utils\Dashboard\SettingPages\TopPage;

if ( ! defined( 'ABSPATH' ) ) exit;

class SettingsPage extends TopPage
{
  protected function get_menu_position() : int
  {
    return 25;
  }

  protected function get_menu_label() : string
  {
    return 'Filters';
  }

  public function get_page_title() : string
  {
    return jab_get_plugin_name() . ': Filters Settings';
  }

  public function get_slug() : string
  {
    return 'jab_filters';
  }

  protected function get_template_args() : array
  {
    return [];
  }

  protected function enqueue_assets() : void
  {
    $local_handle_base = 'filters-setting-page';

    jab_enqueue_local_css( $local_handle_base, 'dashboard/setting-pages/filters/index.css' );

    $vue_handle = jab_enqueue_vue();

    $js_handle =
      jab_enqueue_local_js( $local_handle_base, 'dashboard/setting-pages/filters/index.dev.js', [ $vue_handle ] );

    wp_localize_script( $js_handle, 'jabFiltersSettingsPage', $this->get_js_data() );
  }

  private function get_js_data() : array
  {
    $pts = array_values(get_post_types([
      'public' => true,
      '_builtin' => false,
    ]));

    foreach ( $pts as $i => $pt_slug )
    {
      $pts[ $i ] = [
        'label' => get_post_type_object( $pt_slug )->label,
        'slug' => $pt_slug,
      ];
    }

    return [
      'filters' => Settings::get(),
      'pts' => $pts,
    ];
  }
}