<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<p class="jbk-filter__results__section">
  <?php echo esc_html( sprintf( 'There are no %s %s matching selected filters.',
    $are_unavailable_hidden ? 'available' : '',
    $items_label_plural
  )); ?>
</p>