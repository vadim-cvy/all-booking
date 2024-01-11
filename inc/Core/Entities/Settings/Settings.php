<?php
namespace JBK\Core\Entities\Settings;

use \JBK\Core\Entities\PostType;
use \JBK\Core\Utils\ComplexOption;

if ( ! defined( 'ABSPATH' ) ) exit;

class Settings extends ComplexOption
{
	static private array $instances = [];

	static public function get_instance( PostType $pt )
	{
		$name = 'jbk_' . $pt->get_slug() . '_booking_settings';
		$name = str_replace( 'jbk_jbk', 'jbk', $name );

		if ( ! isset( static::$instances[ $name ] ) )
		{
			static::$instances[ $name ] = new static( $name, $pt );
		}

		return static::$instances[ $name ];
	}

	protected function get_defaults() : array
	{
		return [
			'has_limit' => true,
			'has_price' => true,
			'has_seasons' => true,
			'has_timeslots' => true,
			'is_blockable' => true,
			'has_filter' => true,
			'items_per_filter_page' => 12,
			'max_future_days' => 180,
		];
	}

	protected function sanitize( array $value ) : array
	{
		return $value;
	}

	public function has_limit() : bool
	{
		return $this->get_one( 'has_limit' );
	}

	public function has_price() : bool
	{
		return $this->get_one( 'has_price' );
	}

	public function has_seasons() : bool
	{
		return $this->get_one( 'has_seasons' );
	}

	public function has_timeslots() : bool
	{
		return $this->get_one( 'has_timeslots' );
	}

	public function is_blockable() : bool
	{
		return $this->get_one( 'is_blockable' );
	}

	public function has_filter() : bool
	{
		return $this->get_one( 'has_filter', false );
	}

	public function get_items_per_filter_page() : int
	{
		return $this->get_one( 'items_per_filter_page' );
	}

	public function get_max_future_days() : int
	{
		return $this->get_one( 'max_future_days' );
	}
}