<jab-field
  class="jab-filter-instance__global-stettings__state"
  label="State"
>
  <template #default="{ inputId }">
    <select
      :id="inputId"
      v-model="filterInstance.state"
      :name="`jab[filters][${filterInstanceIndex}][state]`"
    >
      <?php
      foreach ( $template_args['available_filter_states'] as $filter_state_key => $filter_state_label )
      {
        printf( '<option value="%s">%s</option>',
          esc_attr( $filter_state_key ),
          esc_html( $filter_state_label )
        );
      } ?>
    </select>
  </template>
</jab-field>