<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-filter__items">
  <?php
  foreach ( $date_items as $item )
  {
    require jbk_get_template_path( 'booking-filter/results/item.php' );
  } ?>
</div>