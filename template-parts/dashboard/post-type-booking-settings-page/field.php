<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-field jbk-field_<?php echo esc_attr( $setting_name ); ?>">
  <div class="jbk-field__value">
    <?php require jbk_get_template_path( 'dashboard/post-type-booking-settings-page/field-input.php' ); ?>
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
