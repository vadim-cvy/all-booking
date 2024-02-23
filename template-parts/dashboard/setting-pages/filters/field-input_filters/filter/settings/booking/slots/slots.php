<label class="jbk-field__label">
  Slots
</label>

<div class="jbk-field__value jbk-items-list">
  <div class="jbk-items-list__items">
    <div
      v-for="(slot, slotIndex) in filter.booking.slots"
      :key="slotIndex"
      class="jbk-items-list__item"
    >
      <div class="jbk-items-list__item__content jbk-filter__settings_booking__slot">
        <?php
        foreach ( [ 'repeat', 'start-time', 'duration' ] as $slot_field_name )
        { ?>
          <div class="jbk-field jbk-filter__settings_booking__slot__<?php echo esc_attr( $slot_field_name ); ?>">
            <?php require_once jbk_get_template_path( __DIR__ . "/slot-$slot_field_name.php" ); ?>
          </div>
        <?php
        } ?>
      </div>

      <div class="jbk-items-list__item__actions">
        <button
          type="button"
          class="button jbk-button_danger"
          @click="() => deleteBookingSlot( slotIndex, filterIndex )"
        >
          Delete This Time Slot
        </button>
      </div>
    </div>
  </div>

  <div class="jbk-items-list__actions">
    <button
      @click="() => addBookingSlot( filterIndex )"
      type="button"
      class="button"
    >
      Add Time Slot
    </button>
  </div>

  // todo: prices will be set on post pages for each timeslot and its duration optios (including custom fields for post types)
</div>