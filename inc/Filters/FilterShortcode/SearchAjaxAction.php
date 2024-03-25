<?php
namespace Jab\Filters\FilterShortcode;

use WP_Error;
use DateTime;
use Jab\FilterRelatedPosts\FilterRelatedPosts;

if ( ! defined( 'ABSPATH' ) ) exit;

final class SearchAjaxAction extends AjaxAction
{
  protected function get_name_base() : string
  {
    return 'search';
  }

  protected function is_nopriv_allowed() : bool
  {
    return true;
  }

  // todo: support specific post ids not just qty propbably
  protected function handle_submission() : void
  {
    // todo: update structure (see loop below)
    $requested_pts_data = $this->get_requested_pts_data();

    $posts_limits = FilterRelatedPosts::get_limits( array_keys( $requested_pts_data ) );

    $main_pt = array_keys( $requested_pts_data )[0];

    $main_pt_available_items = [];

    $posts_qty_to_check = [];

    foreach ( $requested_pts_data as $pt => $requested_pt_posts_qty )
    {
      $posts_qty_to_check[ $pt ] = [];

      foreach ( $requested_pt_posts_qty as $post_id => $requsted_qty )
      {
        // todo: this should work different in case pt field is term based - posts from the same term should be summed
        $post_limit = $post_id === 'any' ? max( $posts_limits[ $pt ] ) : $posts_limits[ $pt ][ $post_id ];

        if ( $requested_qty > $post_limit )
        {
          $this->respond_no_matches();
        }

        if ( $post_id === 'any' )
        {

        }
        else
        {
          $posts_qty_to_check[ $pt ][ $post_id ] = $requested_qty;
        }
      }
    }







    foreach ( $requested_pts_data as $pt => $requested_pt_posts_qty )
    {
      foreach ( $requested_pt_posts_qty as $post_id => $requested_qty )
      {

      }
    }






    $available_items_ids = [];

    $main_requested_pt = array_keys( $requested_pts_data )[0];

    $posts_ids_to_check = array_map( $posts_limits, fn( $pt_posts_limits ) => array_keys( $pt_posts_limits ) );

    foreach ( $posts_limits as $pt => $pt_posts_limits )
    {

    }











    $slots = [];










    $date_time_format = 'ymdHi';

    foreach ( $this->get_filter_instance()->get_slots() as $slot )
    {
      $slot_start = $slot->get_time()->format( $date_time_format );

      $slots[ $slot_start ] = [
        'end' => $slot->get_time() + min duration ->format( $date_time_format ),
        'availability' => [],
      ];
    }

    if ( empty( $slots ) )
    {
      $this->respond_with_items( $slots );
    }







    $main_requested_pt_limits =

    $is_main_pt_unlimited = empty( array_filter( $requested_pts_limits['main_pt'] ) );

    if ( $is_main_pt_unlimited )
    {
      $this->respond_with_items( array_keys( $requested_pts_limits['main_pt'] ) );
    }

    $secondary_requested_pts_limits = FilterRelatedPosts::get_limits( $secondary_requested_pts );

    $secondary_requested_pts_needing_check =
      array_filter( $secondary_requested_pts, function( $pt ) use ( $secondary_requested_pts_limits )
      {
        $pt_limits = $secondary_requested_pts_limits[ $pt ];

        $has_unlimited_post = count( array_filter( $pt_limits ) ) < count( $pt_limits );

        return ! $has_unlimited_post;
      });

    foreach ( array_keys( $slots ) as $slot_index )
    {
      $slots[ $slot_index ]['availability'] = array_merge(
        [ $main_pt => $main_pt_limits ],
        array_filter(
          $secondary_requested_pts_limits,
          fn( $pt ) => in_array( $pt, $secondary_requested_pts_needing_check ),
          ARRAY_FILTER_USE_KEY
        )
      );
    }

echo'<pre>';var_dump( $slots );echo'</pre>';exit();







    $bookings_query_result =
      'SELECT
        p.ID AS post_id,
        b.start_time AS `start``, -- todo: format this as $date_time_format
        b.end_time AS `end`, -- todo: format this as $date_time_format
        SUM(pbr.items_number) AS times_booked -- todo: this should return the number of grouped rows
      FROM
        {$wpdb->posts} AS p
      JOIN
        {$wpdb->prefix}_jab_post_blockers_relations AS pbr
          ON pbr.post_id = p.ID
      JOIN
        {$wpdb->prefix}_jab_blockers AS b
          ON pbr.blocker_id = b.id
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
      foreach ( $slots as $slot_start => $slot )
      {
        if ( $slot_start < $row->start )
        {
          continue;
        }

        if ( $slot['end'] > $row->end )
        {
          break;
        }

        foreach ( $slot as $slot_pt => $slot_pt_availability )
        {
          $slot_pt_availability[ $row->post_id ] -= $row->items_booked;

          if ( $slot_pt_availability[ $row->post_id ] < $requested_pts_qty[ $slot_pt ] )
          {
            unset( $slot_pt_availability[ $row->post_id ] );
          }

          if ( empty( $slot_pt_availability ) )
          {
            unset( $slots[ $slot_index ][ $slot_pt ] );
          }
          else
          {
            $slots[ $slot_index ][ $slot_pt ] = $slot_pt_availability;
          }
        }

        if ( empty( $slots[ $slot_index ] ) )
        {
          unset( $slots[ $slot_index ] );
        }
      }
    }

    $items_ids = array_unique( array_merge( ...array_column( $slots, $main_pt ) ) );

    $this->respond_with_items( $items_ids );
  }

  private function get_requested_pts_data() : array
  {
    $requested_pts_qty = [];

    // todo: make this recursive
    foreach ( $this->get_filter_instance()->get_popup_fields() as $field )
    {
      if ( $field->get_type() !== 'pt' )
      {
        continue;
      }

      $pt = $field->get_pt();

      if ( ! isset( $requested_pts_qty[ $pt ] ) )
      {
        $requested_pts_qty[ $pt ] = 0;
      }

      if ( $field->is_qty_adjustable() )
      {
        $submitted_field_values = $this->get_submitted_field_values()[ $field->get_id() ] ?? [];

        $requested_pts_qty[ $pt ] += $submitted_field_values['qty'] ?? $field->get_default_number();
      }
      else
      {
        $requested_pts_qty[ $pt ] += 1;
      }
    }

    return $requested_pts_qty;
  }

  private function get_start_date() : Date
  {
    $today = new DateTime( date( 'Y-m-d 00:00:00' ) );

    $start_date = $this->parse_date( $this->get_submitted_data()['start_date'], '00:00:00' );

    if ( $start_date < $today || $start_date > $this->get_max_date() )
    {
      $start_date = $today;
    }

    return $start_date;
  }

  private function get_end_date() : Date
  {
    $end_date = $this->parse_date( $this->get_submitted_data()['end_date'], '23:59:59' );

    if ( $end_date > $max_date || $end_date < $this->get_start_date() )
    {
      $end_date = $max_date;
    }

    return $end_date;
  }

  private function get_max_date() : Date
  {
    return new DateTime( '2024-12-31 23:59:59' ); // todo: get from filter settings
  }

  private function parse_date( string $date_str, string $time ) : DateTime
  {
    return DateTime::createFromFormat( 'Ymd H:i:s', $date_str . $time );
  }

  private function get_submitted_field_values() : array
  {
    $field_values = [];

    foreach ( $this->get_submitted_data() as $key => $value )
    {
      preg_match( '/^field_([0-9]+)(_(\w+))?/', $key, $matches );

      if ( empty( $matches ) )
      {
        continue;
      }

      $field_id = $matches[1];

      if ( ! isset( $field_values[ $field_id ] ) )
      {
        $field_values[ $field_id ] = [];
      }

      $value_key = $matches[3] ?? 'value';

      if ( $value_key === 'qty' )
      {
        $value = absint( $value );
      }

      $field_values[ $field_id ][ $value_key ] = $value;
    }

    return $field_values;
  }
}