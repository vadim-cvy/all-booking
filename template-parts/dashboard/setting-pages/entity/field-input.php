<?php
switch ( $template_args['field_name'] )
{
  case 'has-seasons':
  case 'has-timeslots':
  case 'is-blockable':
  case 'has-limit':
  case 'has-price':
  case 'has-filter':
    printf( '<input id="%s" name="%s" type="checkbox" value="1" %s>',
      esc_attr( $template_args['input_id'] ),
      esc_attr( $template_args['input_name'] ),
      checked( true, $template_args['setting_value'], false )
    );
    break;

  case 'items-per-filter-page':
  case 'max-future-days':
    printf( '<input id="%s" name="%s" type="number" value="%s" min="1" step="1">',
      esc_attr( $template_args['input_id'] ),
      esc_attr( $template_args['input_name'] ),
      esc_attr( $template_args['setting_value'] )
    );
    break;
}