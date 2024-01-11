<?php
namespace JBK\Core\GlobalSettings;

use \Cvy\DesignPatterns\tSingleton;
use \JBK\Core\Utils\ComplexOption;

if ( ! defined( 'ABSPATH' ) ) exit;

class Settings extends ComplexOption
{
	use tSingleton;

	protected function __construct()
	{
		parent::__construct( 'jbk_global_settings' );
	}

  protected function get_defaults() : array
	{
		return [
			'bookable_pts' => [],
			'pt_connections' => [],
		];
	}

	protected function sanitize( array $value ) : array
	{
		$value['pt_connections'] = array_filter( $value['pt_connections'] );

		foreach ( $value['pt_connections'] as $connection_key => $connection_type )
		{
			$pt_slugs = explode( '/', $connection_key );

			foreach ( $pt_slugs as $pt_slug )
			{
				if ( ! in_array( $pt_slug, $value['bookable_pts'] ) )
				{
					unset( $value['pt_connections'][ $connection_key ] );
				}
			}
		}

		return $value;
	}

	public function get_bookable_pts() : array
	{
		return $this->get_one( 'bookable_pts' );
	}

	public function get_pt_connections() : array
	{
		return $this->get_one( 'pt_connections' );
	}
}