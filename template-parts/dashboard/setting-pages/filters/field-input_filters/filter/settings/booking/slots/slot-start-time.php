<div class="jbk-field">
  <label
    :for="prefixBookingSlotInputId( 'start-time-h', slotIndex, filterIndex )"
    class="jbk-field__label"
  >
    Start Time
  </label>

  <div class="jbk-field__value">
    <input
      type="number"
      min="0"
      max="23"
      class="jbk-field__input"
      :id="prefixBookingSlotInputId( 'start-time-h', slotIndex, filterIndex )"
      v-model="slot.startTime.h"
      :disabled="!filter.booking.isTimeable"
    > :
    <input
      type="number"
      min="0"
      max="59"
      class="jbk-field__input"
      v-model="slot.startTime.m"
      :disabled="!filter.booking.isTimeable"
    >
  </div>
</div>