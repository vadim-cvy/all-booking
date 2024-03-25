<?php
namespace Jab\Filters\FilterShortcode;

use WP_Error;
use DateTime;
use Jab\Filters\Filter;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Shortcode extends \Jab\Utils\Shortcode
{
  protected function __construct()
  {
    parent::__construct();

    $this->register_ajax_actions();
  }

  private function register_ajax_actions() : void
  {
    SearchAjaxAction::get_instance();
  }

  static protected function get_name_base() : string
  {
    return 'filter';
  }

  protected function get_allowed_att_names() : array
  {
    return $this->get_required_att_names();
  }

  protected function get_required_att_names() : array
  {
    return [ 'id' ];
  }

  protected function render() : WP_Error | null
  {
    $template_args = $this->get_template_args();

    require jab_resolve_path( JAB_TEMPLATES_PATH . '/frontend/filter-shortcode/filter-shortcode.php' );

    return null;
  }

  protected function get_template_args() : array
  {
    return [
      'filter' => new Filter( $this->get_att( 'id' ) ),
      'item_popup_triggers' => [
        [
          'slug' => 'details',
          'label_html' => 'Details',
        ],
        [
          'slug' => 'book',
          'label_html' => 'Book Now',
        ],
      ],
    ];
  }

  protected function enqueue_js() : void
  {
    $vue_handle = jab_enqueue_vue();
    $axios_handle = jab_enqueue_axios();

    $local_script_handle = jab_enqueue_local_js( 'filter-shortcode', 'frontend/filter-shortcode/index.dev.js',
      [ $vue_handle, $axios_handle ] );

    wp_localize_script( $local_script_handle, 'jabFilterData', [
      'ajaxUrl' => admin_url('admin-ajax.php'),
      'id' => $this->get_att( 'id' ),
      'maxEndDate' => $this->stringify_date( new DateTime( '31-12-2024' ) ),// todo: add dashboard filter setting like "Max Days From Now"
    ]);
  }

  protected function enqueue_css() : void
  {
    jab_enqueue_local_css( 'filter-shortcode', 'frontend/filter-shortcode/index.css');
  }

  protected function validate_sanitize_att(
    string $name,
    mixed $value,
    array $raw_atts
  ) : WP_Error | string | int | float
  {
    switch ( $name )
    {
      case 'id':
        $value = (int) $value;

        $value = (new Filter( $value ))->exists() ? $value : new WP_Error( 'invalid_id', 'This filter does not exist.' );

        break;
    }

    return $value;
  }

  protected function get_wrapper_tag_atts() : array
  {
    return [
      ...parent::get_wrapper_tag_atts(),
      'data-jab-filter-id' => $this->get_att( 'id' ),
    ];
  }

  private function stringify_date( DateTime $date ) : string
  {
    return $date->format( 'Ymd' );
  }
}