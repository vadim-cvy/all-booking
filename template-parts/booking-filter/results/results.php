<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-filter__results">
  <?php
  if ( ! empty( $results ) )
  {
    require_once jbk_get_template_path( 'booking-filter/results/items.php' );

    require_once jbk_get_template_path( 'booking-filter/results/pagination.php' );
  }
  else
  {
    require_once jbk_get_template_path( 'booking-filter/results/no-matches-message.php' );
  } ?>
</div>