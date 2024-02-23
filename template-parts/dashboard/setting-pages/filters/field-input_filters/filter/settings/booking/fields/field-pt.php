<div class="jbk-field" v-show="bookingField.type === 'pt'">
  <label
    :for="prefixBookingFieldInputId( 'pt', bookingFieldIndex, filterIndex )"
    class="jbk-field__label"
  >
    Post Type
  </label>

  <div class="jbk-field__value">
    <select
      :id="prefixBookingFieldInputId( 'pt', bookingFieldIndex, filterIndex )"
      v-model="bookingField.pt"
    >
      <option value="" selected="selected" disabled="disabled"></option>

      <?php
      foreach ( [ '' ] as $post_type )
      {
        printf( '<option value="%s">%s</option>',
          esc_attr( 'dummy_pt_slug' ),
          esc_html( 'Todo PT' ),
        );
      } ?>
    </select>
  </div>
</div>