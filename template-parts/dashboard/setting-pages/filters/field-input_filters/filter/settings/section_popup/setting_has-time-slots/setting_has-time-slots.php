<div class="jbk-field">
  <label
    :for="prefixInputId( 'has-timeslots', filterIndex )"
    class="jbk-field__label"
  >
    Has Timeslots
  </label>

  <div class="jbk-field__value">
    <input
      type="checkbox"
      class="jbk-field__input"
      :id="prefixInputId( 'has-timeslots', filterIndex )"
      v-model="filter.hasTimeslots"
    >
  </div>
</div>