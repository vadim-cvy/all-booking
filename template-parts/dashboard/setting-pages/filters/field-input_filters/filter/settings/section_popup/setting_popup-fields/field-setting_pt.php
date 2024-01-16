<div class="jbk-field" v-show="popupField.type === 'pt'">
  <label
    :for="prefixInputId( 'pt', filterIndex, popupFieldIndex )"
    class="jbk-field__label"
  >
    Post Type
  </label>

  <div class="jbk-field__value">
    <select
      :id="prefixInputId( 'pt', filterIndex, popupFieldIndex )"
      v-model="popupField.pt"
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