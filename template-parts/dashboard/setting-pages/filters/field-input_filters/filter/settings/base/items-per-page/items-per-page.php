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