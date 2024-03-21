<div
  v-show="areAdvancedControlsVisible"
  class="jab-filter__sidebar__advanced-controls__popup jab-filter__popup"
>
  <?php require jab_resolve_path( __DIR__ . '/../../common/popup/close.php' ); ?>

  <div class="jab-filter__popup__content">
    <div class="jab-filter__popup__booking-fields">
      <?php require jab_resolve_path( __DIR__ . '/../../common/popup/booking-fields.php' ); ?>
    </div>

    <div>
      // todo: calculated results instantly after each update via ajax so user can see how much results match the filter
    </div>
  </div>

  <div class="jab-filter__popup__actions">
    <?php require jab_resolve_path( __DIR__ . '/../../common/popup/action-button-close.php' ); ?>

    // todo: add onclick - close popup and update results
    // todo: disable if no items match the filter
    <button
      class="jab-filter__popup__action-button jab-filter__popup__action-button--apply"
    >
      See {results number} results
    </button>
  </div>
</div>