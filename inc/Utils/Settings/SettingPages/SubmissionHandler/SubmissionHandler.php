<?php
namespace Jab\Utils\Settings\SettingPages\SubmissionHandler;

use Jab\Utils\Settings\SettingPages\Page;
use \Jab\Utils\Hooks\iHookable;

use Exception;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class SubmissionHandler extends \Jab\Utils\DesignPatterns\Singleton implements iHookable
{
  use \Jab\Utils\Hooks\tHookable;

  const VALUE_REQUIRED_MSG = 'Value required';

  private $validation_errors = [];

  final protected function __construct()
  {
    if ( empty( $_POST ) )
    {
      return;
    }

    try
    {
      $this->do_action( 'before-handle' );

      $this->handle_submission( $this->get_submitted_data() );

      $this->do_action( 'after-handle' );
    }
    catch ( ValidationError $e ) {}

    if ( $this->has_validation_errors() )
    {
      // todo: show in ui
      echo'<pre>';var_dump( $this->get_validation_errors() );echo'</pre>';exit();
    }
  }

  abstract protected function handle_submission( array $submitted_data ) : void;

  private function get_submitted_data() : array
  {
    $submitted_data = $_POST[ $this->get_POST_key() ] ?? null;

    if ( ! is_array( $submitted_data ) )
    {
      $this->throw_validation_error( 'Submission data must be type of array' );
    }

    array_walk_recursive( $submitted_data, fn( &$value ) => $value = stripslashes( $value ) );

    return $this->apply_filters( 'submitted_data', $submitted_data );
  }

  abstract static protected function get_POST_key() : string;

  final protected function throw_validation_error( $msg, array $field_key_chain = [] ) : void
  {
    $this->add_validation_error( $msg, $field_key_chain );

    throw new ValidationError();
  }

  final protected function add_validation_error( $msg, array $field_key_chain = [] ) : void
  {
    if ( empty( $field_key_chain ) )
    {
      $field_key_chain = [ 'root' ];
    }

    $error = $msg;

    foreach ( array_reverse( $field_key_chain ) as $field_key )
    {
      $error = [ $field_key => $error ];
    }

    $this->validation_errors = array_merge_recursive( $this->validation_errors, $error );
  }

  final protected function has_validation_errors() : bool
  {
    return ! empty( $this->get_validation_errors() );
  }

  final protected function get_validation_errors() : array
  {
    return $this->apply_filters( 'validation_errors', $this->validation_errors );
  }

  final protected function validate_sanitize_string_field(
    mixed $field_value,
    array $field_key_chain,
    array $modifiers = []
  ) : string
  {
    $modifiers = array_merge([
      'is_required' => null,
      'min_len' => null,
      'max_len' => null,
      '_is_numeric' => false,
      'allowed_values' => null,
      'default' => '',
    ], $modifiers );

    if ( ! isset( $modifiers['is_required'] ) && isset( $modifiers['min_len'] ) )
    {
      $modifiers['is_required'] = true;
    }

    if ( ! is_string( $field_value ) || ( $modifiers['_is_numeric'] && ! is_numeric( $field_value ) ) )
    {
      $this->throw_validation_error(
        'Value must be type of ' . $modifiers['_is_numeric'] ? 'number' : 'string',
        $field_key_chain
      );
    }

    $field_value = sanitize_text_field( $field_value );

    if ( $field_value === '' )
    {
      if ( $modifiers['is_required'] )
      {
        $this->throw_validation_error( static::VALUE_REQUIRED_MSG, $field_key_chain );
      }
      else
      {
        return $modifiers['default'];
      }
    }

    if ( isset( $modifiers['allowed_values'] ) && ! in_array( $field_value, $modifiers['allowed_values'] ) )
    {
      $this->throw_validation_error( 'Invalid value', $field_key_chain );
    }

    if ( isset( $modifiers['min_len'] ) && strlen( $field_value ) < $modifiers['min_len'] )
    {
      $this->throw_validation_error( 'Minimum length is ' . $modifiers['min_len'], $field_key_chain );
    }

    if ( isset( $modifiers['max_len'] ) && strlen( $field_value ) > $modifiers['max_len'] )
    {
      $this->throw_validation_error( 'Maximum length is ' . $modifiers['max_len'], $field_key_chain );
    }

    return $field_value;
  }

  final protected function validate_sanitize_number_field(
    mixed $field_value,
    array $field_key_chain,
    array $modifiers = [],
  ) : int | float | null
  {
    $modifiers = array_merge([
      'is_required' => null,
      'min' => null,
      'max' => null,
      'type' => 'float',
      'default' => null,
    ], $modifiers );

    if ( ! in_array( $modifiers['type'], [ 'int', 'float' ] ) )
    {
      throw new Exception( 'Invalid type modifier value!' );
    }

    if ( ! isset( $modifiers['is_required'] ) && isset( $modifiers['min'] ) )
    {
      $modifiers['is_required'] = true;
    }

    $field_value = $this->validate_sanitize_string_field(
      $field_value,
      [
        'is_required' => $modifiers['is_required'],
        '_is_numeric' => true,
      ],
      $field_key_chain
    );

    if ( $field_value === '' )
    {
      return $modifiers['default'];
    }

    if (
      ! is_numeric( $field_value )
      || ( $modifiers['type'] === 'int' && (int) $field_value != $field_value )
    )
    {
      $this->throw_validation_error( 'Value must type of ' . $modifiers['type'], $field_key_chain );
    }

    $field_value = $modifiers['type'] === 'int' ? (int) $field_value : (float) $field_value;

    if ( isset( $modifiers['min'] ) && $field_value < $modifiers['min'] )
    {
      $this->throw_validation_error( 'Minimum value is ' . $modifiers['min'], $field_key_chain );
    }

    if ( isset( $modifiers['max'] ) && $field_value > $modifiers['max'] )
    {
      $this->throw_validation_error( 'Maximum value is ' . $modifiers['max'], $field_key_chain );
    }

    return $field_value;
  }

  final protected function validate_sanitize_array_field(
    mixed $field_value,
    array $field_key_chain,
    array $modifiers = [],
  ) : array
  {
    $modifiers = array_merge([
      'allow_empty' => true,
      'allow_duplicates' => true,
      'allowed_values' => null,
    ], $modifiers );

    if ( ! isset( $modifiers['is_required'] ) && isset( $modifiers['allow_empty'] ) )
    {
      $modifiers['is_required'] = true;
    }

    if ( is_string( $field_value ) )
    {
      $field_value = json_decode( $field_value, true );

      if ( json_last_error() !== JSON_ERROR_NONE )
      {
        $this->throw_validation_error( 'Value must be type of array (JSON)', $field_key_chain );
      }
    }

    if ( ! is_array( $field_value ) )
    {
      $this->throw_validation_error( 'Value must be type of array', $field_key_chain );
    }

    if ( empty( $field_value ) )
    {
      if ( ! $modifiers['allow_empty'] )
      {
        $this->throw_validation_error( static::VALUE_REQUIRED_MSG, $field_key_chain );
      }
      else
      {
        return $field_value;
      }
    }

    if ( ! $modifiers['allow_duplicates'] && count( $field_value ) !== count( array_unique( $field_value ) ) )
    {
      $this->throw_validation_error( 'Duplicate values not allowed', $field_key_chain );
    }

    if ( isset( $modifiers['allowed_values'] ) )
    {
      foreach ( $field_value as $value )
      {
        if ( ! in_array( $value, $modifiers['allowed_values'] ) )
        {
          $this->throw_validation_error( 'Invalid value', $field_key_chain );
        }
      }
    }

    return $field_value;
  }

  final static protected function get_hook_base_args() : array
  {
    return [ static::get_POST_key() ];
  }

  final static protected function get_hook_name_prefix() : string
  {
    return 'submission/';
  }
}