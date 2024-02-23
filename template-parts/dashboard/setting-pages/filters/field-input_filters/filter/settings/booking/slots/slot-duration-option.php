<div class="jbk-field">
  <label
    class="jbk-field__label"
    :for="prefixBookingSlotDurationOptionInputId( 'label', slotDurationOptionIndex, slotIndex, filterIndex )"
  >
    Option Label
  </label>

  <div class="jbk-field__value">
    <input
      type="text"
      class="jbk-field__input"
      :id="prefixBookingSlotDurationOptionInputId( 'label', slotDurationOptionIndex, slotIndex, filterIndex )"
      v-model="slotDurationOption.label"
    >
  </div>
</div>

<div class="jbk-field">
  <label
    class="jbk-field__label"
    :for="prefixBookingSlotDurationOptionInputId( 'time-d', slotDurationOptionIndex, slotIndex, filterIndex )"
  >
    Option Time
  </label>

  <div class="jbk-field__value">
    <div class="jbk-field">
      <label
        class="jbk-field__label"
        :for="prefixBookingSlotDurationOptionInputId( 'time-d', slotDurationOptionIndex, slotIndex, filterIndex )"
      >
        Days
      </label>

      <div class="jbk-field__value">
        <input
          type="number"
          min="0"
          step="1"
          class="jbk-field__input"
          :id="prefixBookingSlotDurationOptionInputId( 'time-d', slotDurationOptionIndex, slotIndex, filterIndex )"
          v-model.number="slotDurationOption.d"
        >
      </div>
    </div>

    <div class="jbk-field">
      <label
        class="jbk-field__label"
        :for="prefixBookingSlotDurationOptionInputId( 'time-h', slotDurationOptionIndex, slotIndex, filterIndex )"
      >
        Hours
      </label>

      <div class="jbk-field__value">
        <input
          type="number"
          min="0"
          max="23"
          step="1"
          class="jbk-field__input"
          :id="prefixBookingSlotDurationOptionInputId( 'time-h', slotDurationOptionIndex, slotIndex, filterIndex )"
          v-model.number="slotDurationOption.h"
          :disabled="!filter.booking.isTimeable"
        >
      </div>
    </div>

    <div class="jbk-field">
      <label
        class="jbk-field__label"
        :for="prefixBookingSlotDurationOptionInputId( 'time-m', slotDurationOptionIndex, slotIndex, filterIndex )"
      >
        Minutes
      </label>

      <div class="jbk-field__value">
        <input
          type="number"
          min="0"
          max="59"
          step="1"
          class="jbk-field__input"
          :id="prefixBookingSlotDurationOptionInputId( 'time-m', slotDurationOptionIndex, slotIndex, filterIndex )"
          v-model.number="slotDurationOption.m"
          :disabled="!filter.booking.isTimeable"
        >
      </div>
    </div>
  </div>
</div>