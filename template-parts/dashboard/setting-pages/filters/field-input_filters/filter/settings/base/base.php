<?php
foreach ( [ 'label', 'items-per-page' ] as $base_setting_name )
{ ?>
  <div class="jbk-field jbk-filter__settings_base__<?php echo esc_attr( $base_setting_name ); ?>">
    <?php require_once jbk_get_template_path( __DIR__ . "/$base_setting_name/$base_setting_name.php" ); ?>
  </div>
<?php
}
