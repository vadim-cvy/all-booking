<?php
foreach ( [ 'is-timeable', 'slots', 'fields' ] as $booking_setting_name )
{ ?>
  <div class="jbk-field jbk-filter__settings_booking__<?php echo esc_attr( $booking_setting_name ); ?>">
    <?php require_once jbk_get_template_path( __DIR__ . "/$booking_setting_name/$booking_setting_name.php" ); ?>
  </div>
<?php
}