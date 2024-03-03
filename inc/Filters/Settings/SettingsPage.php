<?php
namespace Jab\Filters\Settings;

if ( ! defined( 'ABSPATH' ) ) exit;

final class SettingsPage extends \Jab\Utils\Settings\SettingPages\TopPage
{
  static public function get_available_filter_states() : array
  {
    return $this->apply_filters( 'available_filter_states', [
      'enabled',
      'under_development',
      'disabled',
    ]);
  }

  static public function get_available_popup_field_types() : array
  {
    return $this->apply_filters( 'available_popup_field_types', [
      'pt',
      'number',
      'true_false',
    ]);
  }

  static protected function get_menu_position() : int
  {
    return 25;
  }

  static protected function get_menu_label() : string
  {
    return 'Filters';
  }

  static public function get_page_title() : string
  {
    return jab_get_plugin_name() . ': Filters Settings';
  }

  static public function get_slug() : string
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

  protected function instansiate_submission_handlers() : void
  {
    SubmissionHandler::get_instance();
  }
}