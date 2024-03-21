<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__default-number"
  :label="field.type === 'pt' ? 'Default Number of Items' : 'Default Value'"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.default_number"
      type="number"
      :min="field.is_number_adjustable ? 0 : 1"
      step="1"
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][default_number]`"
    >
  </template>
</jab-field>