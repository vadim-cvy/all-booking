<?php
foreach ( $template_args['public_pts'] as $i => $pt )
{
  if ( $i === 0 )
  {
    continue;
  }

  foreach ( $template_args['public_pts'] as $k => $sub_pt )
  {
    if ( $k >= $i )
    {
      continue;
    } ?>

    <div data-pts="<?php echo esc_attr( json_encode( [ $pt->get_slug(), $sub_pt->get_slug() ] ) ); ?>">
      <strong>
        <?php echo esc_html( $pt->get_label_single() . ' / ' . $sub_pt->get_label_single()  ); ?>
      </strong>

      <ul>
        <?php
        foreach ( $template_args['connection_types'] as $connection_type => $connection_type_label )
        {
          $connection_input_name =
            $template_args['input_name'] . '[' . $pt->get_slug() . '/' . $sub_pt->get_slug() . ']';

          $connection_input_id =
            $template_args['input_id'] . '_' . $pt->get_slug() . '-' . $sub_pt->get_slug() . '_' . $connection_type;

          if ( $connection_type === 'no_connection' )
          {
            $connection_input_value = '';
            $is_checked = true;
          }
          else
          {
            $connection_input_value = $connection_type;

            $is_checked =
              $pt->is_bookable()
              && $sub_pt->is_bookable()
              && $pt->has_connection( $sub_pt->get_slug() )
              && $pt->get_connection_type( $sub_pt->get_slug() ) === $connection_type;
          }

          $label_placeholders = [
            '%pt_label_single%' => strtolower( $pt->get_label_single() ),
            '%pt_label_multiple%' => strtolower( $pt->get_label_multiple() ),
            '%sub_pt_label_single%' => strtolower( $sub_pt->get_label_single() ),
            '%sub_pt_label_multiple%' => strtolower( $sub_pt->get_label_multiple() ),
          ];

          $connection_type_label = str_replace(
            array_keys( $label_placeholders ),
            array_values( $label_placeholders ),
            $connection_type_label
          ); ?>

          <li>
            <input
              type="radio"
              id="<?php echo esc_attr( $connection_input_id ); ?>"
              name="<?php echo esc_attr( $connection_input_name ); ?>"
              value="<?php echo esc_attr( $connection_input_value ); ?>"
              <?php checked( true, $is_checked ); ?>
            >

            <label for="<?php echo esc_attr( $connection_input_id ); ?>">
              <?php echo $connection_type_label; ?>
            </label>
          </li>
        <?php
        } ?>
      </ul>
    </div>
  <?php
  }
}