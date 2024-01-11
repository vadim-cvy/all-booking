<?php
namespace JBK\Core\Pts;

use \Exception;
use \JBK\Core\Pts\Settings\Settings;

if ( ! defined( 'ABSPATH' ) ) exit;

class PostType extends \Cvy\WP\PostTypes\PostType
{
  private Settings $settings;

  public function get_connections() : array
  {
    PostTypes::validate_is_bookable( $this->get_slug() );

    return PostTypes::get_connections()[ $this->get_slug() ] ?? [];
  }

  public function has_connection( string $slug ) : bool
  {
    return in_array( $slug, array_map(
      fn( $connection ) => $connection['pt']->get_slug(),
      $this->get_connections()
    ));
  }

  public function get_connection_type( string $slug ) : string
  {
    foreach ( $this->get_connections() as $connection )
    {
      if ( $connection['pt']->get_slug() === $slug )
      {
        return $connection['type'];
      }
    }
  }

  public function is_bookable() : bool
  {
    return PostTypes::is_bookable( $this->get_slug() );
  }

  public function get_settings() : Settings
  {
    PostTypes::validate_is_bookable( $this->get_slug() );

    return Settings::get_instance( $this );
  }
}