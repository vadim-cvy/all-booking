<?php
namespace Jab\Filters\Settings;

if ( ! defined( 'ABSPATH' ) ) exit;

class SettingsPage extends \Jab\Utils\Dashboard\SettingPages\TopPage
{
  static public function get_available_filter_states() : array
  {
    // todo: add hooks
    return [
      'enabled',
      'under_development',
      'disabled',
    ];
  }

  static public function get_available_popup_field_types() : array
  {
    // todo: add hooks
    return [
      'pt',
      'number',
      'true_false',
    ];
  }

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

  protected function instansiate_submission_handlers()
  {
    SubmissionHandler::get_instance();
  }
}