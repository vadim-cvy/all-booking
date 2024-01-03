<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-filter__popup__tab-controls">
  <?php
  foreach ( $popup_type_data['tabs'] as $tab_key => $tab_label )
  { ?>
    <a
      href="#"
      @click="<?php echo esc_attr( sprintf( '() => popups.default.activeTab = "%s"', $tab_key ) ); ?>"
    >
      <?php echo esc_html( $tab_label ); ?>
    </a>
  <?php
  } ?>
</div>

<div class="jbk-filter__popup__tabs">
  <?php
  foreach ( array_keys( $popup_type_data['tabs'] ) as $tab_key )
  { ?>
    <div
      class="jbk-filter__popup__tab jbk-filter__popup__tab_<?php echo esc_attr( $tab_key ); ?>"
      v-show="<?php echo esc_attr( sprintf( 'popups.default.activeTab === "%s"', $tab_key ) ); ?>"
    >
      <?php require_once jbk_get_template_path( "booking-filter/popups/content-default/tab-content-$tab_key.php" ); ?>
    </div>
  <?php
  } ?>
</div>