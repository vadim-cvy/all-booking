<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__type"
  label="Type"
>
  <template #default="{ inputId }">
    <select
      :id="inputId"
      v-model="field.type"
      :disabled="filterInstance.popup.fields[0] === field"
    >
      <?php
      foreach ( $template_args['available_popup_field_types'] as $popup_field_type_key => $popup_field_type_label )
      {
        printf( '<option value="%s">%s</option>',
          esc_attr( $popup_field_type_key ),
          esc_html( $popup_field_type_label )
        );
      } ?>
    </select>

    <input
      v-model="field.type"
      type="hidden"
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][type]`"
    >

    <p>
      // todo: pt > add terms conditions (only in terms/not in terms)
      // todo: pt > add option (for end users) to select not exactly a specific post but a trem of post type and post to be selected automatically
      // todo: pt > add swap option for different fields
    </p>
  </template>
</jab-field>