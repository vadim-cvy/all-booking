<jab-field
  v-if="filterInstance.popup.fields[0] !== field"
  class="jab-filter-instance__popup-stettings__fields__field__is-selectable"
  label="Can user select specific post(s) right from popup?"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.is_selectable"
      type="checkbox"
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][is_selectable]`"
    >
  </template>
</jab-field>