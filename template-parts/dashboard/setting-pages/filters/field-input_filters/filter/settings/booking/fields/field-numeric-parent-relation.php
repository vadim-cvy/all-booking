<div class="jbk-field" v-if="bookingField.parent !== null">
  <label
    :for="prefixBookingFieldInputId( 'numeric-parent-relation', bookingFieldIndex, filterIndex )"
    class="jbk-field__label"
  >
    Numeric Parent Relation
  </label>

  <div class="jbk-field__value">
    <select
      class="jbk-field__input"
      :id="prefixBookingFieldInputId( 'numeric-parent-relation', bookingFieldIndex, filterIndex )"
      v-model="bookingField.numericParentRelation"
    >
      <option value="each">Show for each item</option>
      <option value="once">Show once ignoring how much items user asked in parent field</option>
    </select>
  </div>
</div>