<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__label"
  label="Label"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.label"
      type="text"
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][label]`"
    >
  </template>
</jab-field>