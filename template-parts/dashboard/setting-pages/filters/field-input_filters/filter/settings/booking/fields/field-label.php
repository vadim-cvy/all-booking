<div class="jbk-field">
  <label
    :for="prefixBookingFieldInputId( 'label', bookingFieldIndex, filterIndex )"
    class="jbk-field__label"
  >
    Label
  </label>

  <div class="jbk-field__value">
    <input
      type="text"
      class="jbk-field__input"
      :id="prefixBookingFieldInputId( 'label', bookingFieldIndex, filterIndex )"
      v-model="bookingField.label"
      :disabled="!bookingField.isCustom"
    >
  </div>
</div>