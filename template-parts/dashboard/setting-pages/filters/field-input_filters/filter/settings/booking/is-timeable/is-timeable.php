<label
  class="jbk-field__label"
  :for="prefixInputId( 'is-timeable', filterIndex )"
>
  Is Timeable?
</label>

<div class="jbk-field__value">

  <input
    type="checkbox"
    class="jbk-field__input"
    :id="prefixInputId( 'is-timeable', filterIndex )"
    v-model="filter.booking.isTimeable"
  >
</div>