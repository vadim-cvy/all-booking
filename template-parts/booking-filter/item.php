<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-filter__item">
  <h3 class="jbk-filter__item__title">
    <?php echo esc_html( $item->get_label() ); ?>
  </h3>

  <button
    class="jbk-filter__item__button"
    type="button"
    @click="<?php echo sprintf( 'openItemPopup( %d, "default" )', $item->get_id() ); ?>"
  >
    Book
  </button>
</div>