<?php
namespace Jab\FilterRelatedPosts;

if ( ! defined( 'ABSPATH' ) ) exit;

final class FilterRelatedPosts
{
  static public function get_limits( array $post_types, bool $from_cache = true ) : array
  {
    global $wpdb;

    static $limits = [];

    $post_types_to_query = array_diff( $post_types, array_keys( $limits ) );

    if ( ! empty( $post_types_to_query ) )
    {
      foreach ( $post_types_to_query as $post_type )
      {
        $limits[ $post_type ] = [];
      }

      $post_types_sql_placeholders = implode( ', ', array_fill( 0, count( $post_types_to_query ), '%s' ) );

      $sql =
        "SELECT
          p.ID AS post_id,
          p.post_type AS post_type,
          m.meta_value AS `limit`
        FROM
          {$wpdb->posts} AS p
        LEFT JOIN
          {$wpdb->postmeta} AS m ON
            p.ID = m.post_id
            AND m.meta_key = 'jab_limit'
        WHERE
          p.post_type IN ($post_types_sql_placeholders)";

      $rows = $wpdb->get_results( $wpdb->prepare( $sql, $post_types_to_query ) );

      foreach ( $rows as $row )
      {
        $limits[ $row->post_type ][ $row->post_id ] = $row->limit;
      }
    }

    return array_intersect_key( $limits, array_flip( $post_types ) );
  }
}