<div v-if="field.type === 'number'">
  <?php
  foreach ( [ 'default-number', 'max-number', 'min-number', 'price' ] as $field_setting_name )
  {
    require_once jab_resolve_path( __DIR__ . "/field-setting_$field_setting_name.php" );
  } ?>
</div>
