<jbk-field
  class="jbk-filter-instance__global-stettings__label"
  label="Label"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="filterInstance.label"
      type="text"
      :name="`jbk_filters_settings[${filterInstanceIndex}][label]`"
    >
  </template>
</jbk-field>