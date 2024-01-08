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
    printf( '<input id="%s" name="%s" type="number" value="%s" min="1" step="1">',
      esc_attr( $input_id ),
      esc_attr( $input_name ),
      esc_attr( $value )
    );
    break;

    // todo: move to global page
  /*case 'db_connections':
    $post_types = get_post_types( [ 'public' => true ], 'objects' );

    foreach ( $post_types as $post_type )
    {
      $post_type_slug = $post_type->name;

      if ( $post_type_slug === $this->get_post_type()->get_slug() )
      {
        continue;
      }

      $sub_input_id = $input_id . '_' . $post_type_slug;
      $sub_input_name = $input_name . "[$post_type_slug]"; ?>

      <div>
        <label for="<?php echo esc_attr( $sub_input_id ); ?>">
          <?php echo esc_html( $post_type->label ); ?>
        </label>

        <select
          id="<?php echo esc_attr( $sub_input_id ); ?>"
          name="<?php echo esc_attr( $sub_input_name ); ?>"
        >

        </select>
      </div>
    <?php
    }
    break;*/

  default:
    require jbk_get_template_path( 'dashboard/post-type-booking-settings-page/field-input-custom.php' );
    break;
}