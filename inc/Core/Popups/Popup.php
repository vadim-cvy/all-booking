<?php
namespace JBK\Core\Popups;

use \JBK\Core\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class Popup extends Sinleton
{
  protected function __construct()
  {
    $this->validate_fields_structure( $this->get_fields_structure() );
  }

  private function validate_fields_structure( array $fields_structure, array $parent_field_structure = null  ) : void
  {
    foreach ( $fields_structure as $field_structure )
    {
      $this->validate_field_structure( $field_structure, $parent_field_structure );
    }
  }

  private function validate_field_structure( array $field_structure, array $parent_field_structure = null ) : void
  {
    $this->validate_field_structure__missed_props( $field_structure );

    $this->validate_field_structure__type( $field_structure );

    $this->validate_field_structure__sub_fields( $field_structure );
  }

  private function validate_field_structure__missed_props( array $field_structure ) : void
  {
    foreach ( [ 'type', 'input', 'name', 'label' ] as $prop_name )
    {
      if ( ! isset( $field_structure[ $prop_name ] ) )
      {
        $this->throw_field_structure_validation_error__prop_missed( $field_structure, $prop_name );
      }
    }
  }

  private function validate_field_structure__sub_fields( array $field_structure ) : void
  {
    $sub_fields = $field_structure['sub_fields'] ?? null;

    if ( ! isset( $sub_fields ) )
    {
      return;
    }

    if ( $field_type !== 'connected_pt' )
    {
      $this->throw_field_structure_validation_error__prop_unappropirate( $field_structure, 'sub_fields',
        'Only fields of type "connected_pt" may have "sub_fields" prop.' );
    }

    $this->validate_fields_structure( $sub_fields, $field_structure );
  }

  private function validate_field_structure__type( array $field_structure ) : void
  {
    $pt = $field_structure['pt'] ?? null;

    switch ( $field_structure['type'] )
    {
      case 'connected_pt':
        if ( ! isset( $pt ) )
        {
          $this->throw_field_structure_validation_error__prop_missed( $field_structure, 'pt' );
        }

        if ( ! in_array( $pt, Structure::get_defined_post_types() ) )
        {
          $this->throw_field_structure_validation_error__prop_unexpected_value( $field_structure, 'pt',
            'Post type is not defined.' );
        }

        if (
          isset( $parent_field_structure )
          && ! Structure::connection_exists( $pt, $parent_field_structure['pt'] )
        )
        {
          $this->throw_field_structure_validation_error__prop_unexpected_value( $field_structure, 'pt',
            "\"$pt\" and \"{$parent_field_structure['pt']}\" post types are not connected." );
        }
        break;

      case 'custom':
        if ( isset( $pt ) )
        {
          $this->throw_field_structure_validation_error__prop_unappropirate( $field_structure, 'pt' );
        }
        break;

      default:
        $this->throw_field_structure_validation_error__prop_unexpected_value( $field_structure, 'type' );
    }
  }

  private function throw_field_structure_validation_error__prop_missed( array $field_structure, array $prop_name )
  {
    return $this->throw_field_structure_validation_error( $field_structure,
      "\"$prop_name\" prop is required but is missed." );
  }

  private function throw_field_structure_validation_error__prop_unappropirate(
    array $field_structure,
    array $prop_name,
    string $details = ''
  )
  {
    return $this->throw_field_structure_validation_error( $field_structure,
      "\"$prop_name\" prop is unappropirate. $details" );
  }

  private function throw_field_structure_validation_error__prop_unexpected_value(
    array $field_structure,
    array $prop_name,
    string $details = ''
  )
  {
    return $this->throw_field_structure_validation_error( $field_structure,
      "Unexpected value (\"{$field_structure[$prop_name]}\") for \"$prop_name\" prop. $details"
    );
  }

  private function throw_field_structure_validation_error( array $field_structure, string $details = '' )
  {
    return "{$field_structure['name']} field structure validation error! $details";
  }

  private function get_fields_normalized_structure() : void
  {
    $fields_structure = [];

    foreach ( $this->get_fields_structure() as $field_structure )
    {
      $field_structure['hint'] = $field_structure['hint'] ?? '';

      $has_connected_pt = $field_structure['type'] === 'connected_pt';

      $input_structure = $field_structure['input'];

      $input_structure_defaults = [
        'required' => false,
        'default' => null,
        'sub_fields' => null,
      ];

      if ( $has_connected_pt )
      {
        $input_structure_defaults['psc'] = 1;
        $input_structure_defaults['allow_psc_update'] = false;
      }

      switch ( $input_structure['type'] )
      {
        case 'toggle':
          $input_structure_defaults['default'] = false;
          break;

        case 'select':
          $input_structure_defaults['allow_multiple'] = true;
      }

      $input_structure = array_merge( $input_structure_defaults, $input_structure );

      if ( $has_connected_pt )
      {
        if ( ! isset( $input_structure['min_psc'] ) )
        {
          $input_structure['min_psc'] = $input_structure['allow_psc_update'] ? $input_structure['psc'] : null;
        }
      }

      $field_structure['input'] = $input_structure;

      $fields_structure[ $field_structure['name'] ] = $field_structure;
    }

    return $fields_structure;
  }

  abstract protected function get_fields_structure() : array;
}