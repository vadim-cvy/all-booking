<?php
foreach ( [ 'state', 'label', 'source-pt', 'timing' ] as $global_setting_name )
{
  require jab_resolve_path( __DIR__ . "/$global_setting_name/$global_setting_name.php" );
}