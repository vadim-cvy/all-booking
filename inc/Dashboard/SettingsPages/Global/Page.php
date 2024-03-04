<?php
namespace Jab\Dashboard\SettingsPages\Global;

use Jab\Settings;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Page extends \Jab\Utils\Settings\SettingsPages\TopPage
{
  static public function get_available_filter_states() : array
  {
    return static::apply_filters( 'available_filter_states', [
      'enabled' => 'Visible for users',
      'under_development' => 'Hidden from users',
    ]);
  }

  static public function get_available_popup_field_types() : array
  {
    return static::apply_filters( 'available_popup_field_types', [
      'pt' => 'Post Type',
      'number' => 'Number',
      'true_false' => 'True/False',
    ]);
  }

  static protected function get_menu_position() : int
  {
    return 25;
  }

  static protected function get_menu_label() : string
  {
    return jab_get_plugin_name();
  }

  static public function get_page_title() : string
  {
    return jab_get_plugin_name() . ': Settings';
  }

  static public function get_slug() : string
  {
    return 'jab_global';
  }

  protected function get_template_args() : array
  {
    return [
      'available_filter_states' => $this->get_available_filter_states(),
      'available_popup_field_types' => $this->get_available_popup_field_types(),
    ];
  }

  protected function enqueue_assets() : void
  {
    jab_enqueue_local_css( 'global-settings-page', 'dashboard/settings-pages/global/index.css' );

    $vue_handle = jab_enqueue_vue();

    $js_handle =
      jab_enqueue_local_js( 'global-settings-page', 'dashboard/settings-pages/global/index.dev.js', [ $vue_handle ] );

    wp_localize_script( $js_handle, 'jabGlobalSettingsPage', $this->get_js_data() );
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
      'settings' => Settings::get(),
      'pts' => $pts,
    ];
  }

  protected function instansiate_submission_handlers() : void
  {
    SubmissionHandler::get_instance();
  }
}