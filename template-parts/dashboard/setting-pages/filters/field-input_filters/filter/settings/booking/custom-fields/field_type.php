<div class="jbk-field">
  <label
    :for="prefixBookingCustomFieldInputId( 'type', bookingCustomFieldIndex, filterIndex )"
    class="jbk-field__label"
  >
    Type
  </label>

  <div class="jbk-field__value">
    <select
      :id="prefixBookingCustomFieldInputId( 'type', bookingCustomFieldIndex, filterIndex )"
      v-model="bookingCustomField.type"
    >
      <option value="" disabled="disabled"></option>
      <option value="pt">Post Type</option>
      <option value="custom">Custom</option>
    </select>
  </div>
</div>