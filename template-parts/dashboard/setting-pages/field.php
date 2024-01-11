<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-field jbk-field_<?php echo esc_attr( $template_args['setting_name_dashed'] ); ?>">
  <div class="jbk-field__value">
    <?php
    $field_input_dir_path = 'dashboard/setting-pages/';

    if ( is_a( $this, '\JBK\Core\Entities\Settings\SettingsPage' ) )
    {
      $field_input_dir_path .= 'entity/';
    }
    else if ( is_a( $this, '\JBK\Core\GlobalSettings\SettingsPage' ) )
    {
      $field_input_dir_path .= 'global/';
    }

    $field_input_own_template_path = jbk_get_template_path(
      $field_input_dir_path
      . 'field-input_' . $template_args['setting_name_dashed'] . '.php'
    );

    if ( file_exists( $field_input_own_template_path ) )
    {
      require_once $field_input_own_template_path;
    }
    else
    {
      require jbk_get_template_path( $field_input_dir_path . 'field-input.php' );
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
