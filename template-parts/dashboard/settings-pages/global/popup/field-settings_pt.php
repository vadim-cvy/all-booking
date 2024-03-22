<div v-if="field.type === 'pt'">
  <?php
  foreach ( [ 'pt', 'is-number-adjustable' ] as $field_setting_name )
  {
    require jab_resolve_path( __DIR__ . "/field-setting_$field_setting_name.php" );
  } ?>

  <div v-if="field.is_number_adjustable">
    <?php
    foreach ( [ 'default-number', 'max-number', 'min-number' ] as $field_setting_name )
    {
      require jab_resolve_path( __DIR__ . "/field-setting_$field_setting_name.php" );
    } ?>
  </div>

  <?php
  foreach ( [ 'price' ] as $field_setting_name )
  {
    require jab_resolve_path( __DIR__ . "/field-setting_$field_setting_name.php" );
  } ?>

  // todo: add ability to choose if users should be able to select specific post or specific term only (post will be selected automatically by php on submission). The same shuold work for main field. So filter will show either specific posts or only specific terms.
</div>
