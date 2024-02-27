<?php
namespace JBK\Core\Filters\Settings;

use \Cvy\DesignPatterns\tSingleton;
use \JBK\Core\Utils\ComplexOption;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Settings extends ComplexOption
{
	use tSingleton;

	protected function __construct()
	{
		parent::__construct( 'jbk_filters_settings' );
	}

  protected function get_defaults() : array
	{
		return [];
	}

	protected function sanitize( array | string $value ) : array
	{
		// todo: implement sanitization & errors handling

		if ( is_string( $value ) )
		{
			$value = json_decode( $value, true );
		}

		// $error = true;

		// if ( $error )
		// {
		// 	return $this->get_all();
		// }

		return $value;
	}
}