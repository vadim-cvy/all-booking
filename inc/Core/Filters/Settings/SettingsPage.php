<?php
namespace JBK\Core\Filters\Settings;

use \Cvy\DesignPatterns\tSingleton;
use \JBK\Core\Utils\Dashboard\SettingPages\TopPage;
use \Cvy\WP\Assets\JS;
use \Cvy\WP\Assets\CSS;

if ( ! defined( 'ABSPATH' ) ) exit;

final class SettingsPage extends TopPage
{
  use tSingleton;

  protected function __construct()
  {
    parent::__construct( Settings::get_instance() );

    // todo: make it work for specific page only
    $this->enqueue_css();
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
    return 'All Booking Filters Settings';
  }

  public function get_slug() : string
  {
    return 'jbk_filters_settings';
  }

  protected function get_sections_structure() : array
  {
    return [
      'common' => [
        'label' => 'Common',
        'fields' => [
          'filters' => [
            'label' => 'Filters',
            'setting_name' => 'filters',
          ],
        ],
      ]
    ];
  }

  protected function enqueue_footer_js() : void
  {
    wp_enqueue_script( 'jbk-vue', 'https://unpkg.com/vue@3.4.19/dist/vue.global.js' );

    (new JS( 'dashboard-page-filters-settings/index.dev.js', [ 'jbk-vue' ] ))->enqueue( $this->get_js_data() );
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
      'filters' => $this->settings->get_all(),
      'pts' => $pts,
    ];
  }

  private function enqueue_css() : void
  {
    (new CSS( 'dashboard-page-filters-settings.css' ))->enqueue();
  }
}