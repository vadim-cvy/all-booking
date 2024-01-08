<?php
use \JBK\Core\Entities\PostTypes;

switch ( $setting_name )
{
  case 'which':
  case 'connections':
    $post_types = array_values(get_post_types([
      'public' => true,
      '_builtin' => false,
    ], 'objects' ));

    foreach ( $post_types as $i => $pt )
    {
      $pt_input_id = $input_id . '_' . $pt->name; ?>

      <div>
        <?php
        if ( $setting_name === 'which' )
        { ?>
          <label for="<?php echo esc_attr( $pt_input_id ); ?>">
            <?php echo esc_html( $pt->label ); ?>
          </label>

          <input
            id="<?php echo esc_attr( $pt_input_id ); ?>"
            type="checkbox"
            <?php checked( true, PostTypes::is_bookable( $pt->name ) ); ?>
          >
        <?php
        }
        else if ( $setting_name === 'connections' )
        { ?>
          <div>
            <strong>
              <?php echo esc_html( $pt->label ); ?>
            </strong>

            <?php
            foreach ( $post_types as $k => $sub_pt )
            {
              if ( $k >= $i )
              {
                continue;
              }

              $pt_label_single = strtolower( $pt->labels->singular_name );
              $pt_label_multiple = strtolower( $pt->labels->name );

              $sub_pt_label_single = strtolower( $sub_pt->labels->singular_name );
              $sub_pt_label_multiple = strtolower( $sub_pt->labels->name );

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
                Connection with <?php echo esc_html( $sub_pt->label ); ?>:

                <select name="<?php echo esc_attr( "{$input_name}[$pt->name][$sub_pt->name]" ); ?>">
                  <option value="">
                    No connection
                  </option>

                  <?php
                  foreach ( $connection_types as $connection_type => $connection_type_label )
                  {
                    $is_selected = PostTypes::get_connection( $pt->name, $sub_pt->name ) === $connection_type;
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
        } ?>
      </div>
    <?php
    }
    break;
}