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

	public function get_all() : array
	{
		$all = parent::get_all();

		foreach ( $all['connections'] as $key => $connections )
		{
			$all['connections'][ $key ] = array_filter( $connections );
		}

		$all['connections'] = array_filter( $all['connections'] );

		return $all;
	}
}