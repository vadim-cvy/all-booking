<div class="jab-filter__sidebar">
  <div>
    todo: calendar controls
  </div>

  <?php
  foreach ( $template_args['filter']->get_popup_fields() as $field )
  {
    if ( $field->is_visible_in_filter_controls() )
    {
      $field_attr_id = 'jab-filter__control-field--' . $field->get_id(); ?>

      <div class="
        jab-filter__control-field
        jab-filter__control-field--<?php echo esc_attr( $field->get_type() ); ?>
      ">
        <label for="<?php echo esc_attr( $field_attr_id ); ?>" class="jab-filter__control-field__label">
          <?php echo esc_html( $field->get_label() ); ?>
        </label>

        <div class="jab-filter__control-field__input-wrapper">
          <?php require jab_resolve_path( __DIR__ . '/field-' . $field->get_type() . '.php' ); ?>
        </div>
      </div>
    <?php
    }
  } ?>
</div>