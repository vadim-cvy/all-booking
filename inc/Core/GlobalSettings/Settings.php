<?php
namespace JBK\Core\GlobalSettings;

use \Cvy\DesignPatterns\tSingleton;
use \JBK\Core\Utils\ComplexOption;

if ( ! defined( 'ABSPATH' ) ) exit;

class Settings extends ComplexOption
{
	use tSingleton;

  protected function get_defaults() : array
	{
		return [
			'connections' => [],
		];
	}

	public function get_name() : string
	{
		return 'jbk_global_settings';
	}
}