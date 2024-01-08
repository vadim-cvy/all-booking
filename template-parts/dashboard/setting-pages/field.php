<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-field jbk-field_<?php echo esc_attr( $setting_name ); ?>">
  <div class="jbk-field__value">
    <?php
    if ( is_a( $this, '\JBK\Core\Entities\Settings\SettingsPage' ) )
    {
      require jbk_get_template_path( 'dashboard/setting-pages/entity/field-input.php' );
    }
    else if ( is_a( $this, '\JBK\Core\GlobalSettings\SettingsPage' ) )
    {
      require jbk_get_template_path( 'dashboard/setting-pages/global/field-input.php' );
    } ?>
  </div>

  <?php
  // todo
  /*
  if ( ! empty( $description ) )
  { ?>
    <label class="jbk-field__description" for="<?php echo esc_attr( $setting_name ); ?>">
      <?php echo $description; ?>
    </label>
  <?php
  } ?>

  <?php
  if ( ! empty( $hint ) )
  { ?>
    <div class="jbk-field__hint">
      <?php echo $hint; ?>
    </div>
  <?php
  } */?>
</div>
