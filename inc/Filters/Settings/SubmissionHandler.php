<?php
namespace Jab\Filters\Settings;

use Jab\Utils\Settings\SettingPages\SubmissionHandler\ValidationError;
use Jab\Utils\Hooks\iHookable;

if ( ! defined( 'ABSPATH' ) ) exit;

final class SubmissionHandler extends \Jab\Utils\Settings\SettingPages\SubmissionHandler\SubmissionHandler
{
  static protected function get_POST_key() : string
  {
    return 'jab_filters_settings';
  }

  protected function handle_submission( array $submitted_data ) : void
	{
    foreach ( $submitted_data as $filter_key => $filter_data )
    {
      $field_keys_chain = [ $filter_key ];

      if ( ! is_array( $filter_data ) )
      {
        $this->throw_validation_error( static::INVALID_DATA_TYPE_MSG, $field_keys_chain );
      }

      $filter_data['state'] = $this->validate_sanitize_state( $filter_data['state'], $field_keys_chain );
      $filter_data['label'] = $this->validate_sanitize_label( $filter_data['label'], $field_keys_chain );
      $filter_data['timing'] = $this->validate_sanitize_timing( $filter_data['timing'], $field_keys_chain );
      $filter_data['popup'] = $this->validate_sanitize_popup( $filter_data['popup'], $field_keys_chain );
      $filter_data['filter_page'] =
        $this->validate_sanitize_filter_page( $filter_data['filter_page'], $field_keys_chain );

      $submitted_data[ $filter_key ] = $filter_data;
    }

    $submitted_data = $this->apply_filters( 'validate_sanitize_data', $submitted_data );

    Settings::update( $submitted_data );
  }

  private function validate_sanitize_state( $state, array $field_keys_chain ) : string
  {
    $field_keys_chain[] = 'state';

    return $this->validate_sanitize_string_field( $state, $field_keys_chain, [
      'is_required' => true,
      'allowed_values' => SettingsPage::get_available_filter_states(),
    ]);
  }

  private function validate_sanitize_label( $label, array $field_keys_chain ) : string
  {
    $field_keys_chain[] = 'label';

    return $this->validate_sanitize_string_field( $label, $field_keys_chain, [ 'is_required' => true ] );
  }

  private function validate_sanitize_filter_page( $filter_page, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'filter_page';

    $filter_page = $this->validate_sanitize_array_field( $filter_page, $field_keys_chain );

    $filter_page['items_per_page'] =
      $this->validate_sanitize_filter_page__items_per_page( $filter_page['items_per_page'], $field_keys_chain );

    return $filter_page;
  }

  private function validate_sanitize_filter_page__items_per_page( $items_per_page, array $field_keys_chain ) : int
  {
    $field_keys_chain[] = 'items_per_page';

    return $this->validate_sanitize_number_field( $items_per_page, $field_keys_chain, [
      'min' => 1,
      'type' => 'int',
    ]);
  }

  private function validate_sanitize_timing( $timing, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'timing';

    $timing = $this->validate_sanitize_array_field( $timing, $field_keys_chain, [ 'allow_empty' => false ] );

    foreach ( $timing as $i => $timing_item )
    {
      $timing_item_field_keys_chain = array_merge( $field_keys_chain, [ $i ] );

      $timing[ $i ] = $this->validate_sanitize_array_field( $timing_item, $timing_item_field_keys_chain, [
        'is_json' => true,
      ]);

      $timing[ $i ]['days'] =
        $this->validate_sanitize_timing__days( $timing[ $i ]['days'], $timing_item_field_keys_chain );

      $timing[ $i ]['slots'] =
        $this->validate_sanitize_timing__slots( $timing[ $i ]['slots'], $timing_item_field_keys_chain );
    }

    return $timing;
  }

  private function validate_sanitize_timing__days( $days, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'days';

    return $this->validate_sanitize_array_field( $days, $field_keys_chain, [
      'allow_empty' => false,
      'allowed_values' => [ 0, 1, 2, 3, 4, 5, 6 ],
      'allow_duplicates' => false,
    ]);
  }

  private function validate_sanitize_timing__slots( $slots, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'slots';

    $slots = $this->validate_sanitize_array_field( $slots, $field_keys_chain, [ 'allow_empty' => false ] );

    foreach ( $slots as $i => $slot )
    {
      $slot_field_keys_chain = array_merge( $field_keys_chain, [ $i ] );

      $slots[ $i ] = $this->validate_sanitize_array_field( $slot, $field_keys_chain );

      $slots[ $i ]['start'] =
        $this->validate_sanitize_timing__slots__start( $slots[ $i ]['start'], $slot_field_keys_chain );

      $slots[ $i ]['duration'] =
        $this->validate_sanitize_timing__slots__duration( $slots[ $i ]['duration'], $slot_field_keys_chain );
    }

    return $slots;
  }

  private function validate_sanitize_timing__slots__start( $start, array $field_keys_chain ) : string
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

  private function validate_sanitize_timing__slots__duration( $duration, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'duration';

    $duration = $this->validate_sanitize_array_field( $duration, $field_keys_chain );

    foreach ( [ 'd', 'h', 'm' ] as $unit )
    {
      $unit_field_keys_chain = array_merge( $field_keys_chain, [ $unit ] );

      $duration[ $unit ] = $this->validate_sanitize_number_field( $duration[ $unit ], $unit_field_keys_chain, [
        'min' => 0,
        'type' => 'int',
      ]);
    }

    if ( $duration['d'] === 0 && $duration['h'] === 0 && $duration['m'] === 0 )
    {
      $this->throw_validation_error( static::VALUE_REQUIRED_MSG, $field_keys_chain );
    }

    return $duration;
  }

  private function validate_sanitize_popup( $popup, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'popup';

    $popup = $this->validate_sanitize_array_field( $popup, $field_keys_chain );

    $popup['fields'] = $this->validate_sanitize_popup__fields( $popup['fields'], $field_keys_chain );

    return $popup;
  }

  private function validate_sanitize_popup__fields( $fields, array $field_keys_chain ) : array
  {
    $field_keys_chain[] = 'fields';

    $fields = $this->validate_sanitize_array_field( $fields, $field_keys_chain, [ 'allow_empty' => false ] );

    foreach ( $fields as $i => $field )
    {
      $field_field_keys_chain = array_merge( $field_keys_chain, [ $i ] );

      $fields[ $i ] = $this->validate_sanitize_popup__field( $field, $field_field_keys_chain );
    }

    return $fields;
  }

  private function validate_sanitize_popup__field( $field, array $field_keys_chain ) : array
  {
    $field = $this->validate_sanitize_array_field( $field, $field_keys_chain );

    $field['label'] = $this->validate_sanitize_string_field(
      $field['label'],
      array_merge( $field_keys_chain, [ 'label' ] ),
      [ 'is_required' => true ]
    );

    $field['is_required'] = ! empty( $field['is_required'] );

    $field['type'] = $this->validate_sanitize_string_field(
      $field['type'],
      array_merge( $field_keys_chain, [ 'type' ] ),
      [
        'is_required' => true,
        'allowed_values' => SettingsPage::get_available_popup_field_types(),
      ]
    );

    if ( $field['type'] === 'pt' )
    {
      $field['is_number_adjustable'] = ! empty( $field['is_number_adjustable'] );
    }
    // todo else: delete unneded keys in vue

    if ( ! empty( $field['is_number_adjustable'] ) )
    {
      foreach ( [ 'default_number', 'max_number', 'min_number' ] as $number_key )
      {
        $field[ $number_key ] = $this->validate_sanitize_number_field(
          $field[ $number_key ],
          array_merge( $field_keys_chain, [ $number_key ] ),
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
      array_merge( $field_keys_chain, [ 'price' ] ),
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
    return SettingsPage::get_instance();
  }
}