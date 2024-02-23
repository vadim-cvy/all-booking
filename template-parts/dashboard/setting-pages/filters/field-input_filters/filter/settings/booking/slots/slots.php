<div class="jbk-field">
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
        <div class="jbk-items-list__item__content">
          <?php
          require_once jbk_get_template_path( __DIR__ . "/slot-repeat.php" );
          require_once jbk_get_template_path( __DIR__ . "/slot-start-time.php" );
          require_once jbk_get_template_path( __DIR__ . "/slot-duration.php" );
          ?>
        </div>

        <div class="jbk-items-list__item__actions">
          <button
            type="button"
            class="button jbk-button_danger"
            @click="() => deleteBookingSlot( slotIndex, filterIndex )"
          >
            Delete This Slot
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
        Add Slot
      </button>
    </div>
  </div>
</div>