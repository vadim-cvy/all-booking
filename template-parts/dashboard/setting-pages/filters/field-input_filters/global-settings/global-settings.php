<?php
foreach ( [ 'state', 'label', 'source-pt', 'timing' ] as $global_setting_name )
{
  require_once( __DIR__ . "/$global_setting_name/$global_setting_name.php" );
}