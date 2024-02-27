<jbk-field
  class="jbk-filter-instance__global-stettings__label"
  label="Label"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="filterInstance.label"
      type="text"
    >
  </template>
</jbk-field>