<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-filter__items">
  <?php
  foreach ( $items as $item )
  {
    require jbk_get_template_path( 'booking-filter/item.php' );
  } ?>
</div>