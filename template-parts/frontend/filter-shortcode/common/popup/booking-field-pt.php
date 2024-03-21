<?php
if ( $field->is_number_adjustable() )
{ ?>
  <input
    type="number"
    id="<?php echo esc_attr( $field_attr_id ); ?>"
    name="<?php echo esc_attr( $field->get_id() ); ?>"
    value="<?php echo esc_attr( $field->get_default_number() ); ?>"
    min="<?php echo esc_attr( $field->get_min_number() ); ?>"
    max="<?php echo esc_attr( $field->get_max_number() ); ?>"
    class="jab-filter__popup__booking-field__input"
  >
<?php
}
