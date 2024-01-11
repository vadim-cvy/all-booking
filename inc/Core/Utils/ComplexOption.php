<?php
namespace JBK\Core\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class ComplexOption
{
	private string $name;

	protected function __construct( string $name )
	{
		$this->name = $name;

		register_setting( $this->name, $this->name, [
      'sanitize_callback' => fn( $value ) => $this->sanitize( $value ),
			'default' => $this->get_defaults(),
			'type' => 'object',
    ]);
	}

	abstract protected function get_defaults() : array;

	abstract protected function sanitize( array $value ) : array;

	final public function get_one( string $setting_name, $default = null )
	{
		$value = $this->get_all()[ $setting_name ] ?? null;

		if ( ! isset( $value ) && isset( $default ) )
		{
			$value = $default;
		}

		return $value;
	}

	final public function get_all() : array
	{
		return get_option( $this->get_name() );
	}

	final public function get_name() : string
	{
		return $this->name;
	}
}