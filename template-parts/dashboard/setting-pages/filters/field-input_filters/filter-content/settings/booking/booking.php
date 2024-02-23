<?php
foreach ( [ 'is-timeable', 'slots', 'custom-fields' ] as $booking_setting_name )
{
  require_once jbk_get_template_path( __DIR__ . "/$booking_setting_name/$booking_setting_name.php" );
}