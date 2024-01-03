<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-filter">
  <div class="jbk-filter__sidebar">
    <h2 class="jbk-filter__sidebar__title">
      Filters
    </h2>

    <?php require_once jbk_get_template_path( 'booking-filter/controls-primary.php' ); ?>
  </div>

  <div class="jbk-filter__main">
    <h2 class="jbk-filter__main__title">
      Results
    </h2>

    <?php
    require_once jbk_get_template_path( 'booking-filter/controls-secondary.php' );

    require_once jbk_get_template_path( 'booking-filter/results/results.php' );

    require_once jbk_get_template_path( 'booking-filter/popups.php' );
    ?>
  </div>
</div>