<div class="jbk-field">
  <label
    :for="prefixInputId( 'label', filterIndex )"
    class="jbk-field__label"
  >
    Label
  </label>

  <div class="jbk-field__value">
    <input
      type="text"
      class="jbk-field__input"
      :id="prefixInputId( 'label', filterIndex )"
      v-model="filter.label"
    >
  </div>
</div>