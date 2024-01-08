<?php
namespace JBK\Core\GlobalSettings;

use \Cvy\DesignPatterns\tSingleton;

if ( ! defined( 'ABSPATH' ) ) exit;

class Settings extends \JBK\Core\Utils\Settings
{
  use tSingleton;

  protected function get_defaults() : array
	{
    // todo
		return [
		];
	}

	public function get_slug() : string
	{
		return 'jbk_global_settings';
	}
}