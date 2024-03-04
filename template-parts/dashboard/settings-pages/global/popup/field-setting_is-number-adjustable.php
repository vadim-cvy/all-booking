<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__is-number-adjustable"
  label="Can user adjust the number of posts to book?"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.is_number_adjustable"
      type="checkbox"
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][is_number_adjustable]`"
    >
  </template>
</jab-field>