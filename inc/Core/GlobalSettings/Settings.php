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
		// todo
		return $value;
	}
}