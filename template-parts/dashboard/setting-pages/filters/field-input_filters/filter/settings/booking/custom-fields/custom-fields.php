<label class="jbk-field__label">
  Custom Fields
</label>

<div class="jbk-field__value">
  <div class="jbk-items-list">
    <div class="jbk-items-list__items">
      <div
        class="jbk-items-list__item"
        v-for="(bookingCustomField, bookingCustomFieldIndex) in filter.booking.customFields"
        :key="bookingCustomFieldIndex"
      >
        <div class="jbk-items-list__item__content">
          <?php
          foreach ( [ 'label', 'type', 'pt', 'price' ] as $custom_field_name )
          {
            require_once jbk_get_template_path( __DIR__ . "/field_$custom_field_name.php" );
          } ?>
        </div>

        <div class="jbk-items-list__item__actions">
          <button
            type="button"
            class="button jbk-button_danger"
            @click="() => deleteBookingCustomField( bookingCustomFieldIndex, filterIndex )"
          >
            Delete This Field
          </button>

          <button
            type="button"
            class="button"
            @click="() => addBookingCustomFieldSubField( filterIndex, bookingCustomFieldIndex )"
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
        @click="() => addBookingCustomField( filterIndex )"
      >
        Add Field
      </button>
    </div>
  </div>
</div>