<div class="jbk-field">
  <label
    :for="prefixInputId( 'label', filterIndex, popupFieldIndex )"
    class="jbk-field__label"
  >
    Label
  </label>

  <div class="jbk-field__value">
    <input
      type="text"
      class="jbk-field__input"
      :id="prefixInputId( 'label', filterIndex, popupFieldIndex )"
      v-model="popupField.label"
    >
  </div>
</div>