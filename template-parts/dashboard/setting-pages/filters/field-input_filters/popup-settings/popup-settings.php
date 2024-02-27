<?php
foreach ( [ 'fields' ] as $popup_setting_name )
{
  require_once( __DIR__ . "/$popup_setting_name/$popup_setting_name.php" );
}