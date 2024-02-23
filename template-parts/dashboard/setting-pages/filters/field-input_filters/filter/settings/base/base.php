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

<div class="jbk-field">
  <label
    :for="prefixInputId( 'items-per-page', filterIndex )"
    class="jbk-field__label"
  >
    Items Per Page
  </label>

  <div class="jbk-field__value">
    <input
      type="number"
      min="1"
      step="1"
      class="jbk-field__input"
      :id="prefixInputId( 'items-per-page', filterIndex )"
      v-model.number="filter.itemsPerPage"
    >
  </div>
</div>