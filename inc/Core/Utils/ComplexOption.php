<?php
namespace JBK\Core\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class ComplexOption
{
	abstract protected function get_defaults() : array;

	final public function get_one( string $setting_name, $default = null )
	{
		$value = static::get_all()[ $setting_name ] ?? null;

		if ( ! isset( $value ) && isset( $default ) )
		{
			$value = $default;
		}

		return $value;
	}

	final public function get_all() : array
	{
		$all = get_option( static::get_name() );

		if ( empty( $all ) )
		{
			$all = [];
		}

		return array_merge( static::get_defaults(), $all );
	}

	abstract public function get_name() : string;
}