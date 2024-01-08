<?php
namespace JBK\Core\Entities\Settings;

use \JBK\Core\Entities\PostType;

if ( ! defined( 'ABSPATH' ) ) exit;

class Settings
{
	private PostType $post_type;

  public function __construct( PostType $post_type )
  {
    $this->post_type = $post_type;

		$this->register_settings();
  }

	private function register_settings() : void
	{
		register_setting( $this->get_slug(), $this->get_slug() );
	}

	private function get_defaults() : array
	{
		return [
			'has_limit' => true,
			'has_price' => true,
			'has_seasons' => true,
			'has_timeslots' => true,
			'is_blockable' => true,
			'has_filter' => true,
			'items_per_filter_page' => 12,
		];
	}

	public function get_one( string $name, $default = null )
	{
		$value = $this->get_all()[ $name ] ?? null;

		if ( ! isset( $value ) && isset( $default ) )
		{
			$value = $default;
		}

		if ( ! isset( $value ) )
		{
			switch ( $name )
			{
				case 'limit':
					$value = false;
					break;
			}
		}

		return $value;
	}

	public function get_all() : array
	{
		$settings = get_option( $this->get_slug() );

		if ( empty( $settings ) )
		{
			$settings = [];
		}

		return array_merge( $this->get_defaults(), $settings );
	}

	private function get_slug() : string
	{
		return $this->post_type->get_slug() . '_booking_settings';
	}
}