<div class="jab-filter__sidebar">
  <div>
    todo: calendar controls
  </div>

  <?php
  foreach ( $template_args['filter']->get_popup_fields() as $field )
  {
    if ( $field->is_visible_in_filter_controls() )
    {
      $field_vue_values_object = 'controlValues.popupRelated';

      require jab_resolve_path( __DIR__ . '/../common/booking-field.php' );
    }
  } ?>
</div>