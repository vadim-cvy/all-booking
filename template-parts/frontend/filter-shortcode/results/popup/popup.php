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
      fields
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