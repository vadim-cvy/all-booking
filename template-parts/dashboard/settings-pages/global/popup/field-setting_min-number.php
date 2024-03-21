<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__min-number"
  label="Min Value"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.min_number"
      type="number"
      :min="1"
      step="1"
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][min_number]`"
    >
  </template>
</jab-field>