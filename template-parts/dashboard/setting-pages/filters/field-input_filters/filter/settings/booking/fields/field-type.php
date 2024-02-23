<div class="jbk-field">
  <label
    :for="prefixBookingFieldInputId( 'type', bookingFieldIndex, filterIndex )"
    class="jbk-field__label"
  >
    Type
  </label>

  <div class="jbk-field__value">
    <select
      :id="prefixBookingFieldInputId( 'type', bookingFieldIndex, filterIndex )"
      v-model="bookingField.type"
      :disabled="!bookingField.isCustom"
    >
      <option value="" disabled="disabled"></option>
      <option value="pt">Post Type</option>
      <option value="custom">Custom</option>
    </select>
  </div>
</div>