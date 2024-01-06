<?php
namespace JBK\Core\Filters;

use \DateTime;
use \Exception;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class Template
{
  // static private array $items;

  // static abstract protected function get_post_type() : ItemsPostType;

  // static public final function render() : void
  // {
  //   extract( static::get_vars() );

  //   require_once jbk_get_template_path( 'booking-filter/' . static::get_root_template_file_name() );
  // }

  // static protected function get_root_template_file_name() : void
  // {
  //   return 'booking-filter.php';
  // }

  // static protected function get_vars() : array
  // {
  //   return [
  //     'paginate_links_args' => static::get_paginate_links_args(),
  //     'results' => static::get_results(),
  //     'are_unavailable_hidden' => static::are_unavailable_hidden(),
  //     'items_label_plural' => static::get_items_label_plural(),
  //     'popup_types' => static::get_popup_types(),
  //   ];
  // }

  // static protected function get_results() : array
  // {
  //   return static::get_items();
  // }

  // static protected final function get_items() : array
  // {
  //   global $wpdb;

  //   if ( ! static::$items )
  //   {
  //     $items_db_data = $wpdb->get_results( static::get_items_query_sql() );

  //     static::$items = array_map(
  //       fn( $item_db_data ) => new Item( $item_db_data ),
  //       $items_db_data
  //     );
  //   }

  //   return static::$items;
  // }

  // static private function get_items_query_sql() : string
  // {
  //   global $wpdb;

  //   $post_type_slug = static::get_post_type()->get_slug();

  //   $sql =
  //     "SELECT
  //       i.id AS id,
  //       i.start_time AS start_time,
  //       i.bookings_limit AS own_bookings_limit,
  //       (
  //         SELECT
  //           COUNT(*)
  //         FROM
  //           jbk_{$post_type_slug}_bookings
  //         WHERE
  //           ( start_time > i.start_time AND start_time < i.end_time )
  //           OR ( end_time > i.start_time AND end_time < i.end_time )
  //       ) AS own_active_bookings
  //     FROM
  //       jbk_{$post_type_slug}_items AS i ";

  //   foreach ( static::get_post_type()->get_dependency_post_types() as $dependency_post_type )
  //   {
  //     $dependency_post_type_slug = $dependency_post_type->get_slug();

  //     $sql .= "LEFT JOIN (
  //       SELECT
  //         i.id AS id,
  //         i.start_time AS start_time,
  //         i.bookings_limit AS own_bookings_limit,
  //         (
  //           SELECT
  //             COUNT(*)
  //           FROM
  //             %{table name letter}
  //           WHERE
  //             ( start_time > i.start_time AND start_time < i.end_time )
  //             OR ( end_time > i.start_time AND end_time < i.end_time )
  //         ) AS own_active_bookings
  //       FROM
  //         %{table name letter} AS dep_i
  //     ) ON i.";
  //   }

  //   $placeholder_values = [];





  //   $where = $this->get_items_query_where();

  //   if ( static::are_unavailable_hidden() )
  //   {
  //     $where['sql'] =
  //       "( {$where['sql']} )
  //       AND (
  //         i.limit = -1
  //         OR b.item_total_bookings IS NULL
  //         OR b.item_total_bookings < i.limit
  //       ) ";
  //   }



  //   $sql .= "WHERE {$where['sql']} ";
  //   $placeholder_values = array_merge( $placeholder_values, $where['placeholder_values'] );

  //   $sql .= 'ORDER BY start_time ';

  //   $sql .= 'LIMIT %d ';
  //   $limit = $this->get_per_page();
  //   $placeholder_values[] = $limit;

  //   $sql .= 'OFFSET %d ';
  //   $placeholder_values[] = ( $this->get_cur_page() - 1 ) * $limit;

  //   return $wpdb->prepare( $sql, $placeholder_values );
  // }

  // static protected function get_items_query_where() : array
  // {
  //   $sql = '';
  //   $placeholder_values = [];

  //   $sql .= 'start_time >= "%s"';
  //   $placeholder_values[] = static::get_start_date()->format( 'Y-m-d' );

  //   $sql .= ' AND end_time <= "%s"';
  //   $placeholder_values[] = static::get_end_date()->format( 'Y-m-d' );

  //   return [
  //     'sql' => $sql,
  //     'placeholder_values' => $placeholder_values,
  //   ];
  // }

  // static protected final function are_unavailable_hidden() : bool
  // {
  //   return (bool) ( $_GET['only_available'] ?? Settings::are_unavailable_hidden_by_default() );
  // }

  // static protected function get_items_label_plural() : string
  // {
  //   return static::get_post_type()->get_label_plural();
  // }

  // static protected function get_popup_types() : array
  // {
  //   return [
  //     'default' => [
  //       'tabs' => [
  //         'details' => 'Details',
  //         'calendar' => 'Calendar',
  //         'book' => 'Book',
  //       ],
  //     ],
  //   ];
  // }

  // static protected function get_paginate_links_args() : array
  // {
  //   return [
  //     'base' => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
  //     'format' => '?page=%#%',
  //     'current' => static::get_cur_page(),
  //     'total' => static::get_total_pages(),
  //     'prev_text' => '<',
  //     'next_text' => '>',
  //   ];
  // }

  // static protected function get_cur_page() : int
  // {
  //   return $_GET['page'] ?? 1;
  // }

  // static protected final function get_total_pages() : int
  // {
  //   return ceil( count( static::get_results() ) / static::get_per_page() );
  // }

  // static private function get_per_page() : int
  // {
  //   return Settings::get_per_page()
  // }

  // static protected final function get_start_date() : DateTime
  // {
  //   return static::get_date_arg( 'start_date' );
  // }

  // static protected final function get_end_date() : DateTime
  // {
  //   return static::get_date_arg( 'end_date', static::get_start_date() );
  // }

  // static private function get_date_arg( string $arg_name, DateTime $min_date = null ) : DateTime
  // {
  //   $today = new DateTime( date( 'Y-m-d' ) );

  //   if ( ! $min_date )
  //   {
  //     $min_date = $today;
  //   }
  //   else if ( $min_date < $today )
  //   {
  //     throw new Exception( '$min_date can not be less than today!' );
  //   }

  //   $max_date = new DateTime( date( 'Y-m-d', '+ ' . Settings::get_max_future_days() . ' days' ) );

  //   $date_str = $_GET[ $arg_name ] ?? '';

  //   if ( $date_str )
  //   {
  //     $date = new DateTime( $date_str );
  //   }

  //   if ( empty( $date ) || $date > $max_date )
  //   {
  //     $date = $max_date;
  //   }
  //   else if ( $date < $min_date )
  //   {
  //     $date = $min_date;
  //   }

  //   return $date;
  // }
}