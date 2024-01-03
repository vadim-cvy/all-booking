<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-filter__item">
  <h4 class="jbk-filter__item__label">
    <?php echo esc_html( $item->get_label() ); ?>
  </h4>

  <button
    class="jbk-filter__item__button"
    type="button"
    @click="<?php echo esc_attr( sprintf( 'openItemPopup( %d, "default" )', $item->get_id() ) ); ?>"
  >
    Book
  </button>
</div>