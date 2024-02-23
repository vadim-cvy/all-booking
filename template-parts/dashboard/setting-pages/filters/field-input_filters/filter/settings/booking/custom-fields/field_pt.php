<div class="jbk-field" v-show="bookingCustomField.type === 'pt'">
  <label
    :for="prefixBookingCustomFieldInputId( 'pt', bookingCustomFieldIndex, filterIndex )"
    class="jbk-field__label"
  >
    Post Type
  </label>

  <div class="jbk-field__value">
    <select
      :id="prefixBookingCustomFieldInputId( 'pt', bookingCustomFieldIndex, filterIndex )"
      v-model="bookingCustomField.pt"
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