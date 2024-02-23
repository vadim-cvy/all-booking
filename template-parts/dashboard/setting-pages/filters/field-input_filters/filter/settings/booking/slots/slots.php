<div class="jbk-field">
  <label class="jbk-field__label">
    Slots
  </label>

  <div class="jbk-field__value">
    <div
      v-for="(slot, slotIndex) in filter.booking.slots"
      :key="slotIndex"
    >
      <?php
      require_once jbk_get_template_path( __DIR__ . "/slot-start-time.php" );
      require_once jbk_get_template_path( __DIR__ . "/slot-duration.php" );
      ?>
    </div>
  </div>
</div>