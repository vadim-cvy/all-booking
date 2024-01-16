<div class="jbk-field">
  <label class="jbk-field__label">
    Fields
  </label>

  <div class="jbk-field__value">
    <div
      class="jbk-filters-setting__filter__settings__popup-field"
      v-for="(popupField, popupFieldIndex) in filter.popupFields"
      :key="popupFieldIndex"
    >
      <div class="jbk-filters-setting__filter__settings__popup-field__settings">
        <?php
        foreach ( [ 'label', 'type', 'pt', 'price' ] as $popup_field_setting_name )
        {
          require_once jbk_get_template_path( __DIR__ . "/field-setting_$popup_field_setting_name.php" );
        } ?>
      </div>

      <div class="jbk-filters-setting__filter__settings__popup-field__actions">
        <button
          @click="() => deletePopupField( popupFieldIndex, filterIndex )"
          type="button"
          class="button jbk-button_delete"
        >
          Delete Field
        </button>

        <button
          @click="() => addPopupField( filterIndex, popupFieldIndex )"
          type="button"
          class="button"
        >
          Add Sub Field
        </button>
      </div>
    </div>
  </div>
</div>