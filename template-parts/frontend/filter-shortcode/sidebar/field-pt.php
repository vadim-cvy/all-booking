<?php
if ( $field->is_qty_adjustable() )
{ ?>
  <input
    type="number"
    id="<?php echo esc_attr( $field_attr_id ); ?>"
    name="<?php echo esc_attr( $field->get_id() ); ?>"
    v-model="<?php echo esc_attr( 'controlValues.field_' . $field->get_id() . '_qty' ); ?>"
    min="<?php echo esc_attr( $field->get_min_number() ); ?>"
    max="<?php echo esc_attr( $field->get_max_number() ); ?>"
    class="jab-filter__booking-field__input"
  >
<?php
}
