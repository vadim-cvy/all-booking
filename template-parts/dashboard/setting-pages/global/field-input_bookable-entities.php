<?php

foreach ( $template_args['public_pts'] as $pt )
{
  $pt_slug = $pt->get_slug();

  $pt_input_id = $template_args['input_id'] . '_' . $pt_slug;
  $pt_input_name = $template_args['input_name'] . '[]'; ?>

  <div>
    <label for="<?php echo esc_attr( $pt_input_id ); ?>">
      <?php echo esc_html( $pt->get_label_multiple() ); ?>
    </label>

    <input
      id="<?php echo esc_attr( $pt_input_id ); ?>"
      name="<?php echo esc_attr( $pt_input_name ); ?>"
      type="checkbox"
      <?php checked( true, $pt->is_bookable() ); ?>
      value="<?php echo esc_attr( $pt->get_slug() ); ?>"
    >
  </div>
<?php
}