<?php
use \JBK\Core\Entities\PostTypes;

switch ( $setting_name )
{
  case 'bookable_entities':
    foreach ( PostTypes::get_public() as $pt )
    {
      $pt_slug = $pt->get_slug();

      $pt_input_id = $input_id . '_' . $pt_slug;
      $pt_input_name = $input_name . '[]'; ?>

      <div>
        <label for="<?php echo esc_attr( $pt_input_id ); ?>">
          <?php echo esc_html( $pt->get_label_single() ); ?>
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
    break;

  // todo: this will save post types with no connections as well
  case 'entity_connections':
    foreach ( PostTypes::get_public() as $i => $pt )
    {
      if ( $i === 0 )
      {
        continue;
      } ?>

      <div>
        <strong>
          <?php echo esc_html( $pt->get_label_single() ); ?>
        </strong>

        <?php
        foreach ( PostTypes::get_public() as $k => $sub_pt )
        {
          if ( $k >= $i )
          {
            continue;
          }

          $pt_label_single = strtolower( $pt->get_label_single() );
          $pt_label_multiple = strtolower( $pt->get_label_multiple() );

          $sub_pt_label_single = strtolower( $sub_pt->get_label_single() );
          $sub_pt_label_multiple = strtolower( $sub_pt->get_label_multiple() );

          $connection_types = [
            'one_to_one' =>
              "1 $pt_label_single may be connected to ONLY 1 $sub_pt_label_single"
              . " AND 1 $sub_pt_label_single may be connected to ONLY 1 $pt_label_single",
            'one_to_many' =>
              "1 $pt_label_single may be connected to 1 OR MORE $sub_pt_label_multiple"
              . " BUT 1 $sub_pt_label_single may be connected to ONLY 1 $pt_label_single",
            'many_to_one' =>
              "1 $pt_label_single may be connected to ONLY 1 $sub_pt_label_single"
              . " BUT 1 $sub_pt_label_single may be connected to 1 OR MORE $pt_label_multiple",
            'many_to_many' =>
              "1 $pt_label_single may be connected to 1 OR MORE $sub_pt_label_multiple"
              . " AND 1 $sub_pt_label_single may be connected to 1 OR MORE $pt_label_multiple",
          ]; ?>

          <div>
            Connection with <strong><?php echo esc_html( $sub_pt->get_label_single() ); ?></strong>:

            <select name="<?php echo esc_attr( $input_name . '[' . $pt->get_slug() . '][' . $sub_pt->get_slug() . ']' ); ?>">
              <option value="">
                No connection
              </option>

              <?php
              foreach ( $connection_types as $connection_type => $connection_type_label )
              {
                $is_selected =
                  $pt->is_bookable()
                  && $sub_pt->is_bookable()
                  && $pt->get_connection_type( $sub_pt->get_slug() ) === $connection_type;
                ?>

                <option
                  value="<?php echo esc_attr( $connection_type ); ?>"
                  <?php selected( true, $is_selected ); ?>
                >
                  <?php echo esc_html( $connection_type_label ); ?>
                </option>
              <?php
              } ?>
            </select>
          </div>
        <?php
        } ?>
      </div>
    <?php
    }
    break;
}