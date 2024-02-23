<label class="jbk-field__label">
  Repeat
</label>

<div class="jbk-field__value">
  <?php
  foreach ( [ 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun' ] as $day_index => $day_label )
  {
    $input_id_cb = "prefixBookingSlotInputId( 'repeat_' + " . $day_index . ", slotIndex, filterIndex )";
    ?>

    <div class="jbk-field jbk-field jbk-filter__settings_booking__slot__repeat__day">
      <label
        class="jbk-field__label"
        :for="<?php echo esc_attr( $input_id_cb ); ?>"
      >
        <?php echo esc_html( $day_label ); ?>
      </label>

      <div class="jbk-field__value">
        <input
          type="checkbox"
          :id="<?php echo esc_attr( $input_id_cb ); ?>"
          class="jbk-field__input"
          v-model="slot.repeat[<?php echo esc_attr( $day_index ); ?>]"
          value="<?php echo esc_attr( $day_index ); ?>"
        >
      </div>
    </div>
  <?php
  } ?>
</div>