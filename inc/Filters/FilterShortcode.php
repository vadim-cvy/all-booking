<?php
namespace Jab\Filters;

use WP_Error;
use DateTime;

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

  private function handle_ajax( string $action_name ) : void
  {
    $filter = new Filter( $_POST['filter_id'] ?? 0 );

    if ( ! $filter->exists() )
    {
      $this->send_ajax_error( 'Filter does not exist!' );
    }

    $control_values = $this->get_submitted_control_values();

    echo'<pre>';var_dump( $control_values );echo'</pre>';exit();

    $limited_posts_query =
      'SELECT
        p.ID AS post_id,
        p.post_type AS post_type,
        m.meta_value AS `limit`,
      FROM
        {$wpdb->posts} AS p
      LEFT JOIN
        {$wpdb->postmeta} AS m
      WHERE
        p.post_type IN ( {post types passed in controls} )
        AND m.meta_key = "jab_limit"
        AND m.meta_value IS NOT NULL';

    // todo: if no limited posts than all items are available

    $format = 'ymdHi';

    $slots = [];

    foreach ( slots generator as $slot )
    {
      $slot_index = $slot->get_time()->format( $format );

      $slots[ $slot_index ] = [];

      foreach ( $limited_posts_query as $row )
      {
        if ( ! isset( $slots[ $slot_index ][ $row->post_type ] ) )
        {
          $slots[ $slot_index ][ $row->post_type ] = [];
        }

        $slots[ $slot_index ][ $row->post_type ][ $row->post_id ] = $row->limit ?? -1;
      }
    }

    // todo: foreach submitted post type field starting from main
    $bookings_query_result =
      'SELECT
        p.ID AS post_id,
        b.start_time AS slot_min_index, -- todo: format this as $format
        b.end_time AS slot_max_index, -- todo: format this as $format
        SUM(pbr.items_number) AS times_booked -- todo: this should return the number of grouped rows
      FROM
        {$wpdb->posts} AS p
      JOIN
        {$wpdb->prefix}_jab_post_bookings_relations AS pbr
          ON pbr.post_id = p.ID
      JOIN
        {$wpdb->prefix}_jab_bookings AS b
          ON pbr.booking_id = b.id
      WHERE
        p.ID IN ({limited post ids queried before})
        AND (
          ( b.start_time < {start} AND B.end_time > {start} ) OR ( b.start_time < {end} AND B.end_time > {end} )
        )
      GROUP BY
        p.ID,
        b.start_time,
        b.end_time';

    foreach ( $bookings_query_result as $row )
    {
      foreach ( $slots as $slot_index => $slot )
      {
        if ( $slot_index < $row->slot_min_index || $slot_index > $row->slot_max_index )
        {
          continue;
        }

        $items_left = $slot[ $row->post_id ] - $row->items_booked;

        if ( $items_left < $requested_min_number_of_items )
        {
          unset( $slots[ $slot_index ] );
        }
        else
        {
          $slots[ $slot_index ][ $row->post_id ] = $items_left;
        }
      }
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

  private function get_submitted_control_values() : array
  {
    $control_values_json = stripslashes( $_POST['control_values'] );
    $control_values = json_decode( $control_values_json, true );

    $today = new DateTime( date( 'Y-m-d 00:00:00' ) );
    $max_date = new DateTime( '2024-12-31 23:59:59' ); // todo: get from filter settings

    $control_values['start_date'] = $this->parse_date( $control_values['start_date'], '00:00:00' );

    if ( $control_values['start_date'] < $today )
    {
      $control_values['start_date'] = $today;
    }

    $control_values['end_date'] = $this->parse_date( $control_values['end_date'], '23:59:59' );

    if ( $control_values['end_date'] > $max_date || $control_values['end_date'] < $control_values['start_date'] )
    {
      $control_values['end_date'] = $max_date;
    }

    foreach ( $control_values as $key => $value )
    {
      if ( is_numeric( $key ) )
      {
        // todo: parse fields and call something like $field->get_search_items_sql_where
      }
    }

    return $control_values;
  }

  private function send_ajax_error( string $err_msg ) : void
  {
    wp_send_json_error([ 'errMsg' => $err_msg ]);
  }

  private function send_ajax_success( array $data ) : void
  {
    wp_send_json_success( $data );
  }

  private function parse_date( string $date_str, string $time ) : DateTime
  {
    return DateTime::createFromFormat( 'Ymd H:i:s', $date_str . $time );
  }

  private function stringify_date( DateTime $date ) : string
  {
    return $date->format( 'Ymd' );
  }
}