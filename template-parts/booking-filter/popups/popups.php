<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-filter__popups">
  <?php
  foreach ( $popup_types as $popup_type => $popup_type_data )
  { ?>
    <div
      id="jbk-filter__popup_<?php echo esc_attr( $popup_type ); ?>"
      class="jbk-filter__popup"
    >
      <?php require_once jbk_get_template_path( "booking-filter/popups/content-$popup_type/content-$popup_type.php" ); ?>
    </div>
  <?php
  } ?>
</div>