<?php
switch ( $setting_name )
{
  case 'has_seasons':
  case 'has_timeslots':
  case 'is_blockable':
  case 'has_limit':
  case 'has_price':
  case 'has_filter':
    printf( '<input id="%s" name="%s" type="checkbox" value="1" %s>',
      esc_attr( $input_id ),
      esc_attr( $input_name ),
      checked( true, $value, false )
    );
    break;

  case 'items_per_filter_page':
  case 'max_future_days':
    printf( '<input id="%s" name="%s" type="number" value="%s" min="1" step="1">',
      esc_attr( $input_id ),
      esc_attr( $input_name ),
      esc_attr( $value )
    );
    break;

  case 'connections':
    $global_settings_page = \JBK\Core\GlobalSettings\SettingsPage::get_instance();

    printf( 'You can see and setup %s connections on <a href="%s">%s</a> page.',
      esc_html( $this->get_post_type()->get_label_single() ),
      esc_url( $global_settings_page->get_url() ),
      esc_html( $global_settings_page->get_page_title() )
    );
}