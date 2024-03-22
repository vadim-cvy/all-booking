<?php
if ( ! $field->is_hidden() )
{
  $field_attr_id = 'jab-filter__popup__booking-field--' . $field->get_id(); ?>

  <div class="
    jab-filter__popup__booking-field
    jab-filter__popup__booking-field--<?php echo esc_attr( $field->get_type() ); ?>
  ">
    <label for="<?php echo esc_attr( $field_attr_id ); ?>" class="jab-filter__popup__booking-field__label">
      <?php
      echo esc_html( $field->get_label() );

      if ( $field->is_required() )
      { ?>
        <span class="jab-filter__popup__booking-field__required-mark">*</span>
      <?php
      } ?>
    </label>

    <div class="jab-filter__popup__boking-field__input-wrapper">
      <?php require jab_resolve_path( __DIR__ . '/booking-field-' . $field->get_type() . '.php' ); ?>
    </div>
  </div>
<?php
}
