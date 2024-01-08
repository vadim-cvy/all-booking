<?php
namespace JBK\Core\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class Settings
{
	abstract protected function get_defaults() : array;

	final public function get_one( string $name, $default = null )
	{
		$value = $this->get_all()[ $name ] ?? null;

		if ( ! isset( $value ) && isset( $default ) )
		{
			$value = $default;
		}

		return $value;
	}

	final public function get_all() : array
	{
		$settings = get_option( $this->get_slug() );

		if ( empty( $settings ) )
		{
			$settings = [];
		}

		return array_merge( $this->get_defaults(), $settings );
	}

	abstract public function get_slug() : string;
}