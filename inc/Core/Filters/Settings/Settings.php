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
		parent::__construct( 'jbk_filter_settings' );
	}

  protected function get_defaults() : array
	{
		return [
			// todo
		];
	}

	protected function sanitize( array $value ) : array
	{
		// todo

		return $value;
	}
}