<div
  v-show="isPopupVisible"
  class="jab-filter__popup"
>
  <button
    class="jab-filter__popup__close"
    @click.prevent="() => isPopupVisible = false"
  >
    Close
  </button>

  <div class="jab-filter__popup__content">
    <div class="jab-filter__popup__booking-fields">
      <?php
      foreach ( $template_args['filter']->get_popup_fields() as $field )
      {
        $field_vue_values_object = 'bookingRequestData';

        require jab_resolve_path( __DIR__ . '/../../common/booking-field.php' );
      } ?>
    </div>
  </div>

  <div class="jab-filter__popup__actions">
    <button
      class="jab-filter__popup__action-button jab-filter__popup__action-button--close"
      @click.prevent="() => isPopupVisible = false"
    >
      Close
    </button>

    <button
      class="jab-filter__popup__action-button jab-filter__popup__action-button--apply"
    >
      Book
    </button>
  </div>
</div>