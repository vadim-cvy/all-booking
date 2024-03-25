<?php
namespace Jab\Settings\SettingsPages\Global;

use Jab\Utils\Settings\SettingsPages\SubmissionHandler\ValidationError;
use Jab\Utils\Hooks\iHookable;
use Jab\Settings\Settings;

if ( ! defined( 'ABSPATH' ) ) exit;

final class SubmissionHandler extends \Jab\Utils\Settings\SettingsPages\SubmissionHandler\SubmissionHandler
{
  static protected function get_POST_key() : string
  {
    return 'jab';
  }

  protected function on_data_valid( array $validated_sanitized_data ) : void
  {
    Settings::update( $validated_sanitized_data );
  }

  protected function validate_sanitize_submitted_data( array $submitted_data ) : array
	{
    $field_keys_chain = [ 'filters' ];

    $submitted_data['filters'] = $this->validate_sanitize_array_field( $submitted_data['filters'], $field_keys_chain );

    foreach ( $submitted_data['filters'] as $i => $filter_data )
    {
      $submitted_data['filters'][ $i ] =
        $this->validate_sanitize_filter( $filter_data, [ ...$field_keys_chain, $i ] );
    }

    return $submitted_data;
  }

  private function validate_sanitize_filter( $filter, array $field_keys_chain ) : array
  {
    $filter = $this->validate_sanitize_array_field( $filter, $field_keys_chain );

    $filter['id'] = $this->validate_sanitize_filter__id( $filter['id'], $field_keys_chain );
    $filter['state'] = $this->validate_sanitize_filter__state( $filter['state'], $field_keys_chain );
    $filter['label'] = $this->validate_sanitize_filter__label( $filter['label'], $field_keys_chain );
    $filter['timing'] = $this->validate_sanitize_filter__timing( $filter['timing'], $field_keys_chain );
    $filter['popup'] = $this->validate_sanitize_filter__popup( $filter['popup'], $field_keys_chain );
    $filter['filter_page'] = $this->validate_sanitize_filter__filter_page( $filter['filter_page'], $field_keys_chain );

    return $filter;
  }

  private function validate_sanitize_filter__id( $id, array $field_keys_chain ) : int
  {
    $field_keys_chain[] = 'id';

    return $this->validate_sanitize_number_field( $id, $field_keys_chain, [
      'is_required' => true,
      'min' => 1,
      'type' => 'int',
    ]);
  }

  private function validate_sanitize_filter__state( $state, array $field_keys_chain ) : string
  {
    $field_keys_chain[] = 'state';

    return $this->validate_sanitize_string_field( $state, $field_keys_chain, [
      'is_required' => true,
      'allowed_values' => array_keys( Page::get_available_filter_states() ),
    ]);
  }

  private function validate_sanitize_filter__label( $label, array $field_keys_chain ) : string
  {
    $field_keys_chain[] = 'label';

    return $this->validate_sanitize_string_field( $label, $field_keys_chain, [ 'is_required' => true ] );
  }

  private function validate_sanitize_filter__filter_page( $filter_page, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'filter_page';

    $filter_page = $this->validate_sanitize_array_field( $filter_page, $field_keys_chain );

    $filter_page['items_per_page'] =
      $this->validate_sanitize_filter__filter_page__items_per_page( $filter_page['items_per_page'], $field_keys_chain );

    return $filter_page;
  }

  private function validate_sanitize_filter__filter_page__items_per_page( $items_per_page, array $field_keys_chain ) : int
  {
    $field_keys_chain[] = 'items_per_page';

    return $this->validate_sanitize_number_field( $items_per_page, $field_keys_chain, [
      'min' => 1,
      'type' => 'int',
    ]);
  }

  private function validate_sanitize_filter__timing( $timing, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'timing';

    $timing = $this->validate_sanitize_array_field( $timing, $field_keys_chain, [ 'allow_empty' => false ] );

    foreach ( $timing as $i => $timing_item )
    {
      $timing_item_field_keys_chain = [ ...$field_keys_chain, $i ];

      $timing[ $i ] = $this->validate_sanitize_array_field( $timing_item, $timing_item_field_keys_chain, [
        'is_json' => true,
      ]);

      $timing[ $i ]['days'] =
        $this->validate_sanitize_filter__timing__days( $timing[ $i ]['days'], $timing_item_field_keys_chain );

      $timing[ $i ]['slots'] =
        $this->validate_sanitize_filter__timing__slots( $timing[ $i ]['slots'], $timing_item_field_keys_chain );
    }

    return $timing;
  }

  private function validate_sanitize_filter__timing__days( $days, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'days';

    return $this->validate_sanitize_array_field( $days, $field_keys_chain, [
      'allow_empty' => false,
      'allowed_values' => [ 0, 1, 2, 3, 4, 5, 6 ],
      'allow_duplicates' => false,
    ]);
  }

  private function validate_sanitize_filter__timing__slots( $slots, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'slots';

    $slots = $this->validate_sanitize_array_field( $slots, $field_keys_chain, [ 'allow_empty' => false ] );

    foreach ( $slots as $i => $slot )
    {
      $slot_field_keys_chain = [ ...$field_keys_chain, $i ];

      $slots[ $i ] = $this->validate_sanitize_array_field( $slot, $field_keys_chain );

      $slots[ $i ]['start'] =
        $this->validate_sanitize_filter__timing__slot__start( $slots[ $i ]['start'], $slot_field_keys_chain );

      $slots[ $i ]['duration'] =
        $this->validate_sanitize_filter__timing__slot__duration( $slots[ $i ]['duration'], $slot_field_keys_chain );
    }

    return $slots;
  }

  private function validate_sanitize_filter__timing__slot__start( $start, array $field_keys_chain ) : string
  {
    $field_keys_chain[] = 'start';

    $start = $this->validate_sanitize_string_field( $start, $field_keys_chain, [ 'is_required' => true ] );

    $time_parts = explode( ':', $start );

    $h = $time_parts[0];
    $m = $time_parts[1];

    if ( ! is_numeric( $h ) || ! is_numeric( $m ) || $h > 23 || $h < 0 || $m > 59 || $m < 0 )
    {
      $this->throw_validation_error( 'Invalid format', $field_keys_chain );
    }

    return $start;
  }

  private function validate_sanitize_filter__timing__slot__duration( $duration, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'duration';

    $duration = $this->validate_sanitize_array_field( $duration, $field_keys_chain );

    foreach ( [ 'default', 'step', 'min', 'max' ] as $duration_setting_name )
    {
      $duration_setting_field_keys_chain = [ ...$field_keys_chain, $duration_setting_name ];

      $duration[ $duration_setting_name ] = $this->validate_sanitize_array_field( $duration[ $duration_setting_name ],
        $duration_setting_field_keys_chain );

      foreach ( [ 'd', 'h', 'm' ] as $unit )
      {
        $unit_field_keys_chain = [ ...$duration_setting_field_keys_chain, $unit ];

        $duration[ $duration_setting_name ][ $unit ] = $this->validate_sanitize_number_field(
          $duration[ $duration_setting_name ][ $unit ],
          $unit_field_keys_chain,
          [
            'min' => 0,
            'type' => 'int',
          ]
        );
      }

      if (
        $duration[ $duration_setting_name ]['d'] === 0
        && $duration[ $duration_setting_name ]['h'] === 0
        && $duration[ $duration_setting_name ]['m'] === 0 )
      {
        $this->throw_validation_error( static::VALUE_REQUIRED_MSG, $duration_setting_field_keys_chain );
      }
    }

    return $duration;
  }

  private function validate_sanitize_filter__popup( $popup, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'popup';

    $popup = $this->validate_sanitize_array_field( $popup, $field_keys_chain );

    $popup['fields'] = $this->validate_sanitize_filter__popup__fields( $popup['fields'], $field_keys_chain );

    return $popup;
  }

  private function validate_sanitize_filter__popup__fields( $fields, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'fields';

    $fields = $this->validate_sanitize_array_field( $fields, $field_keys_chain, [ 'allow_empty' => false ] );

    foreach ( $fields as $i => $field )
    {
      $field_field_keys_chain = [ ...$field_keys_chain, $i ];

      $fields[ $i ] = $this->validate_sanitize_filter__popup__field( $field, $field_field_keys_chain );
    }

    return $fields;
  }

  private function validate_sanitize_filter__popup__field( $field, array $field_keys_chain ) : array
  {
    $field = $this->validate_sanitize_array_field( $field, $field_keys_chain );

    $field['id'] = $this->validate_sanitize_number_field(
      $field['id'],
      [ ...$field_keys_chain, 'id' ],
      [
        'is_required' => true,
        'min' => 1,
        'type' => 'int',
      ]
    );

    $field['label'] = $this->validate_sanitize_string_field(
      $field['label'],
      [ ...$field_keys_chain, 'label' ],
      [ 'is_required' => true ]
    );

    $field['is_required'] = ! empty( $field['is_required'] );

    $field['type'] = $this->validate_sanitize_string_field(
      $field['type'],
      [ ...$field_keys_chain, 'type' ],
      [
        'is_required' => true,
        'allowed_values' => array_keys( Page::get_available_popup_field_types() ),
      ]
    );

    if ( $field['type'] === 'pt' )
    {
      $field['is_qty_adjustable'] = ! empty( $field['is_qty_adjustable'] );
    }
    // todo else: delete unneded keys in vue

    if ( ! empty( $field['is_qty_adjustable'] ) )
    {
      foreach ( [ 'default_number', 'max_number', 'min_number' ] as $number_key )
      {
        $field[ $number_key ] = $this->validate_sanitize_number_field(
          $field[ $number_key ],
          [ ...$field_keys_chain, $number_key ],
          [
            'is_required' => false,
            'min' => 1,
            'type' => 'int',
          ],
        );
      }
    }

    $field['price'] = $this->validate_sanitize_number_field(
      $field['price'],
      [ ...$field_keys_chain, 'price' ],
      [
        'is_required' => false,
        'min' => 0,
        'type' => 'float',
        'default' => 0,
      ]
    );

    return $field;
  }

  static protected function get_parent_hookable() : iHookable | null
  {
    return Page::get_instance();
  }
}