<div class="jbk-field">
  <label
    :for="prefixBookingCustomFieldInputId( 'label', bookingCustomFieldIndex, filterIndex )"
    class="jbk-field__label"
  >
    Label
  </label>

  <div class="jbk-field__value">
    <input
      type="text"
      class="jbk-field__input"
      :id="prefixBookingCustomFieldInputId( 'label', bookingCustomFieldIndex, filterIndex )"
      v-model="bookingCustomField.label"
    >
  </div>
</div>