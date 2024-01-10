<?php
switch ( $template_args['setting_name'] )
{
  case 'has_seasons':
  case 'has_timeslots':
  case 'is_blockable':
  case 'has_limit':
  case 'has_price':
  case 'has_filter':
    printf( '<input id="%s" name="%s" type="checkbox" value="1" %s>',
      esc_attr( $template_args['input_id'] ),
      esc_attr( $template_args['input_name'] ),
      checked( true, $template_args['setting_value'], false )
    );
    break;

  case 'items_per_filter_page':
  case 'max_future_days':
    printf( '<input id="%s" name="%s" type="number" value="%s" min="1" step="1">',
      esc_attr( $template_args['input_id'] ),
      esc_attr( $template_args['input_name'] ),
      esc_attr( $template_args['setting_value'] )
    );
    break;

  case 'connections':
    printf( 'You can see and setup %s connections on <a href="%s">%s</a> page.',
      esc_html( $template_args['pt']->get_label_single() ),
      esc_url( $template_args['global_settings_page']->get_url() ),
      esc_html( $template_args['global_settings_page']->get_page_title() )
    );
}