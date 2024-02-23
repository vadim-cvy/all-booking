<label class="jbk-field__label">
  Popup Fields
</label>

<div class="jbk-field__value">
  <div class="jbk-items-list">
    <div class="jbk-items-list__items">
      <div
        class="jbk-items-list__item"
        v-for="(bookingField, bookingFieldIndex) in filter.booking.fields"
        :key="bookingFieldIndex"
      >
        <div class="jbk-items-list__item__content">
          <?php
          foreach ( [ 'label', 'numeric-parent-relation', 'type', 'pt', 'numeric', 'price' ] as $field_name )
          {
            require_once jbk_get_template_path( __DIR__ . "/field-$field_name.php" );
          } ?>
        </div>

        <div class="jbk-items-list__item__actions">
          <button
            type="button"
            class="button jbk-button_danger"
            @click="() => deleteBookingField( bookingFieldIndex, filterIndex )"
            v-if="bookingField.isCustom"
          >
            Delete This Field
          </button>

          <button
            type="button"
            class="button"
            @click="() => addBookingFieldSubField( filterIndex, bookingFieldIndex )"
            v-if="bookingField.isCustom"
          >
            Add Sub Field
          </button>
        </div>
      </div>
    </div>

    <div class="jbk-items-list__actions">
      <button
        type="button"
        class="button"
        @click="() => addBookingField( filterIndex )"
      >
        Add Field
      </button>
    </div>
  </div>
</div>