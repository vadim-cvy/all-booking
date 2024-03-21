<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__max-number"
  label="Max Value"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.max_number"
      type="number"
      :min="1"
      step="1"
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][max_number]`"
    >
  </template>
</jab-field>