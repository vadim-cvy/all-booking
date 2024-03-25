<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__is-number-adjustable"
  label="Can user adjust quantity?"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.is_qty_adjustable"
      type="checkbox"
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][is_qty_adjustable]`"
    >
  </template>
</jab-field>