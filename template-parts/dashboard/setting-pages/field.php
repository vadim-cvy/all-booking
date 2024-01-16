<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="jbk-field jbk-field_<?php echo esc_attr( $template_args['section_name'] . '__' . $template_args['field_name']  ); ?>">
  <div class="jbk-field__value">
    <?php
    $field_input_template_path = __DIR__ . '/';

    if ( is_a( $this, '\JBK\Core\Pts\Settings\SettingsPage' ) )
    {
      $field_input_template_path .= 'pt/';
    }
    else if ( is_a( $this, '\JBK\Core\GlobalSettings\SettingsPage' ) )
    {
      $field_input_template_path .= 'global/';
    }
    else if ( is_a( $this, '\JBK\Core\Filters\Settings\SettingsPage' ) )
    {
      $field_input_template_path .= 'filters/field-input_filters/';
    }

    $field_input_template_path .= 'field-input_' . $template_args['field_name'] . '.php';

    require jbk_get_template_path( $field_input_template_path ); ?>
  </div>

  <?php
  // todo
  /*
  if ( ! empty( $description ) )
  { ?>
    <label class="jbk-field__description" for="<?php echo esc_attr( $input_id ); ?>">
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
