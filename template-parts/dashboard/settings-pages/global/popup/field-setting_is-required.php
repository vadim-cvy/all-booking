<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__is-required"
  label="Is Required?"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.is_required"
      type="checkbox"
      :disabled="filterInstance.popup.fields[0] === field"
    >

    <input
      v-model="field.is_required"
      type="hidden"
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][is_required]`"
    >
  </template>
</jab-field>