<div v-if="field.type === 'pt'">
  <?php
  foreach ( [ 'pt', 'is-number-adjustable' ] as $field_setting_name )
  {
    require_once jab_resolve_path( __DIR__ . "/field-setting_$field_setting_name.php" );
  } ?>

  <div v-if="field.is_number_adjustable">
    <?php
    foreach ( [ 'default-number', 'max-number', 'min-number' ] as $field_setting_name )
    {
      require_once jab_resolve_path( __DIR__ . "/field-setting_$field_setting_name.php" );
    } ?>
  </div>

  <?php
  foreach ( [ 'price' ] as $field_setting_name )
  {
    require_once jab_resolve_path( __DIR__ . "/field-setting_$field_setting_name.php" );
  } ?>
</div>
