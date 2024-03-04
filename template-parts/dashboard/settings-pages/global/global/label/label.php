<jab-field
  class="jab-filter-instance__global-stettings__label"
  label="Label"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="filterInstance.label"
      type="text"
      :name="`jab[filters][${filterInstanceIndex}][label]`"
    >
  </template>
</jab-field>