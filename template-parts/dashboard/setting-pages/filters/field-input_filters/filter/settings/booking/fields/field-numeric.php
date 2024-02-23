<div class="jbk-field">
  <label
    :for="prefixBookingFieldInputId( 'numeric__is-numeric', bookingFieldIndex, filterIndex )"
    class="jbk-field__label"
  >
    Numeric
  </label>

  <div class="jbk-field__value">
    <div class="jbk-field">
      <label
        :for="prefixBookingFieldInputId( 'numeric__is-numeric', bookingFieldIndex, filterIndex )"
        class="jbk-field__label"
      >
        Is Numeric?
      </label>

      <div class="jbk-field__value">
        <input
          type="checkbox"
          :id="prefixBookingFieldInputId( 'numeric__is-numeric', bookingFieldIndex, filterIndex )"
          v-model="bookingField.numeric.isNumeric"
        >
      </div>
    </div>

    <div v-show="bookingField.numeric.isNumeric">
      <div class="jbk-field">
        <label
          :for="prefixBookingFieldInputId( 'numeric__default', bookingFieldIndex, filterIndex )"
          class="jbk-field__label"
        >
          Default Number of Items
        </label>

        <div class="jbk-field__value">
          <input
            type="number"
            min="0"
            :id="prefixBookingFieldInputId( 'numeric__default', bookingFieldIndex, filterIndex )"
            v-model="bookingField.numeric.default"
          >
        </div>
      </div>

      <div class="jbk-field">
        <label
          :for="prefixBookingFieldInputId( 'numeric__is-editable', bookingFieldIndex, filterIndex )"
          class="jbk-field__label"
        >
          Is Editable by User?
        </label>

        <div class="jbk-field__value">
          <input
            type="checkbox"
            :id="prefixBookingFieldInputId( 'numeric__is-editable', bookingFieldIndex, filterIndex )"
            v-model="bookingField.numeric.isEditable"
          >
        </div>
      </div>

      <div v-show="bookingField.numeric.isEditable">
        <div class="jbk-field">
          <label
            :for="prefixBookingFieldInputId( 'numeric__min', bookingFieldIndex, filterIndex )"
            class="jbk-field__label"
          >
            Min value user can enter
          </label>

          <div class="jbk-field__value">
            <input
              type="number"
              min="0"
              :id="prefixBookingFieldInputId( 'numeric__min', bookingFieldIndex, filterIndex )"
              v-model="bookingField.numeric.min"
            >
          </div>
        </div>

        <div class="jbk-field">
          <label
            :for="prefixBookingFieldInputId( 'numeric__max', bookingFieldIndex, filterIndex )"
            class="jbk-field__label"
          >
            Max value user can enter
          </label>

          <div class="jbk-field__value">
            <input
              type="number"
              min="0"
              :id="prefixBookingFieldInputId( 'numeric__max', bookingFieldIndex, filterIndex )"
              v-model="bookingField.numeric.max"
            >
          </div>
        </div>

        <div class="jbk-field">
          <label
            :for="prefixBookingFieldInputId( 'numeric__step', bookingFieldIndex, filterIndex )"
            class="jbk-field__label"
          >
            Step
          </label>

          <div class="jbk-field__value">
            <input
              type="number"
              min="0"
              :id="prefixBookingFieldInputId( 'numeric__step', bookingFieldIndex, filterIndex )"
              v-model="bookingField.numeric.step"
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</div>