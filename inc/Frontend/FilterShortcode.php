<?php
namespace Jab\Frontend;

use WP_Error;
use Jab\Filter;

if ( ! defined( 'ABSPATH' ) ) exit;

final class FilterShortcode extends \Jab\Utils\Shortcode
{
  protected function __construct()
  {
    parent::__construct();

    $this->register_ajax_actions();
  }

  private function register_ajax_actions() : void
  {
    $action_names = [ 'search' ];

    foreach ( $action_names as $action_name )
    {
      $action_full_name = 'jab_filter_' . $action_name;

      $cb = fn() => $this->handle_ajax( $action_name );

      add_action( 'wp_ajax_' . $action_full_name, $cb );
      add_action( 'wp_ajax_nopriv_' . $action_full_name, $cb );
    }
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
      'maxEndDate' => '20241231',// todo: add dashboard filter setting like "Max Days From Now"
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

  private function handle_ajax( string $action_name ) : void
  {
    $filter = new Filter( $_POST['filter_id'] ?? 0 );

    if ( ! $filter->exists() )
    {
      $this->send_ajax_error( 'Filter does not exist!' );
    }

    // todo
    $items = [
      [
        'id' => 1,
        'title' => 'Result 1',
        'excerpt' => 'Excerpt 1',
        'img' => [
          'src' => 'https://via.placeholder.com/150',
          'alt' => 'Placeholder',
        ],
        'status' => [
          'slug' => 'available',
          'label' => 'Available',
        ],
      ],
    ];

    $this->send_ajax_success([
      'items' => $items,
    ]);
  }

  private function send_ajax_error( string $err_msg ) : void
  {
    wp_send_json_error([ 'errMsg' => $err_msg ]);
  }

  private function send_ajax_success( array $data ) : void
  {
    wp_send_json_success( $data );
  }
}