<div class="jbk-field">
  <label class="jbk-field__label">
    Duration Options
  </label>

  <div class="jbk-field__value jbk-items-list">
    <div class="jbk-items-list__items">
      <div
        v-for="(slotDurationOption, slotDurationOptionIndex) in slot.durationOptions"
        :key="slotDurationOptionIndex"
        class="jbk-items-list__item"
      >
        <div class="jbk-items-list__item__content">
          <?php require_once jbk_get_template_path( __DIR__ . "/slot-duration-option.php" ); ?>
        </div>

        <div class="jbk-items-list__item__actions">
          <button
            type="button"
            class="button jbk-button_danger"
            @click="() => deleteBookingSlotDurationOption( slotDurationOptionIndex, slotIndex, filterIndex )"
          >
            Delete This Duraton Option
          </button>
        </div>
      </div>
    </div>

    <div class="jbk-items-list__actions">
      <button
        @click="() => addBookingSlotDurationOption( slotIndex, filterIndex )"
        type="button"
        class="button"
      >
        Add Duration Option
      </button>
    </div>
  </div>
</div>

// todo: prices will be set on post pages for each timeslot and its duration optios (including custom fields for post types)