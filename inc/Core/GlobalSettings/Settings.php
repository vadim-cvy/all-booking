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
			'bookable_entities' => [],
			'entity_connections' => [],
		];
	}

	protected function sanitize( array $value ) : array
	{
		$value['entity_connections'] = array_filter( $value['entity_connections'] );

		foreach ( $value['entity_connections'] as $connection_key => $connection_type )
		{
			$pt_slugs = explode( '/', $connection_key );

			foreach ( $pt_slugs as $pt_slug )
			{
				if ( ! in_array( $pt_slug, $value['bookable_entities'] ) )
				{
					unset( $value['entity_connections'][ $connection_key ] );
				}
			}
		}

		return $value;
	}

	public function get_bookable_entities() : array
	{
		return $this->get_one( 'bookable_entities' );
	}

	public function get_entity_connections() : array
	{
		return $this->get_one( 'entity_connections' );
	}
}