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
		foreach ( $value['entity_connections'] as $pt_slug => $connections )
		{
			if ( ! in_array( $pt_slug, $value['bookable_entities'] ) )
			{
				unset( $value['entity_connections'][ $pt_slug ] );
			}

			$value['entity_connections'][ $pt_slug ] = array_filter( $connections );
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