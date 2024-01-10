<?php
namespace JBK\Core\Entities;

use \Exception;
use \JBK\Core\Entities\Settings\Settings;

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
    return $this->get_connections()[ $slug ] ?? false;
  }

  public function get_connection_type( string $slug ) : string
  {
    return $this->get_connections()[ $slug ];
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