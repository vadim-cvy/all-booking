<div class="jbk-field">
  <label
    :for="prefixInputId( 'type', filterIndex, popupFieldIndex )"
    class="jbk-field__label"
  >
    Type
  </label>

  <div class="jbk-field__value">
    <select
      :id="prefixInputId( 'type', filterIndex, popupFieldIndex )"
      v-model="popupField.type"
    >
      <option value="" disabled="disabled"></option>
      <option value="pt">Post Type</option>
      <option value="custom">Custom</option>
    </select>
  </div>
</div>