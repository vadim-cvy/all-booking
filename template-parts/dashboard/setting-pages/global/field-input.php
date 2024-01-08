<?php

switch ( $setting_name )
{
  case 'which':
  case 'db_connections':
    $post_types = array_values(get_post_types([
      'public' => true,
      '_builtin' => false,
    ], 'objects' ));

    foreach ( $post_types as $i => $post_type )
    {
      $post_type_input_id = $input_id . '_' . $post_type->name; ?>

      <div>
        <?php
        if ( $setting_name === 'which' )
        { ?>
          <label for="<?php echo esc_attr( $post_type_input_id ); ?>">
            <?php echo esc_html( $post_type->label ); ?>
          </label>

          <!-- todo: fix checked -->
          <input id="<?php echo esc_attr( $post_type_input_id ); ?>" type="checkbox" <?php checked( true, true ); ?>"">
        <?php
        }
        else if ( $setting_name === 'db_connections' )
        { ?>
          <div>
            <strong>
              <?php echo esc_html( $post_type->label ); ?>
            </strong>

            <?php
            foreach ( $post_types as $k => $sub_post_type )
            {
              if ( $k >= $i )
              {
                continue;
              }

              $pt_label_single = strtolower( $post_type->labels->singular_name );
              $pt_label_multiple = strtolower( $post_type->labels->name );

              $sub_pt_label_single = strtolower( $sub_post_type->labels->singular_name );
              $sub_pt_label_multiple = strtolower( $sub_post_type->labels->name );
              ?>

              <div>
                Connection with <?php echo esc_html( $sub_post_type->label ); ?>:

                <!-- todo: maybe remove id for all inputs? -->
                <select
                  id=""
                  name="<?php echo esc_attr( $input_name . '[' . $sub_post_type->name . ']' ); ?>"
                >
                  <option>
                    No connection
                  </option>

                  <option value="one_to_one">
                    <?php echo esc_html(
                      "1 $pt_label_single may be connected to ONLY 1 $sub_pt_label_single"
                      . " AND 1 $sub_pt_label_single may be connected to ONLY 1 $pt_label_single"
                    ); ?>
                  </option>

                  <option value="one_to_many">
                    <?php echo esc_html(
                      "1 $pt_label_single may be connected to 1 OR MORE $sub_pt_label_multiple"
                      . " BUT 1 $sub_pt_label_single may be connected to ONLY 1 $pt_label_single"
                    ); ?>
                  </option>

                  <option value="many_to_one">
                    <?php echo esc_html(
                      "1 $pt_label_single may be connected to ONLY 1 $sub_pt_label_single"
                      . " BUT 1 $sub_pt_label_single may be connected to 1 OR MORE $pt_label_multiple"
                    ); ?>
                  </option>

                  <option value="many_to_many">
                    <?php echo esc_html(
                      "1 $pt_label_single may be connected to 1 OR MORE $sub_pt_label_multiple"
                      . " AND 1 $sub_pt_label_single may be connected to 1 OR MORE $pt_label_multiple"
                    ); ?>
                  </option>
                </select>
              </div>
            <?php
            } ?>
          </div>
        <?php
        } ?>
      </div>
    <?php
    }
    break;
}