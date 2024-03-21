<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__price"
  :label="
    field.type === 'pt' && field.is_number_adjustable ? 'Price per 1 Item' :
    'Price'
  "
>
  <template #default="{ inputId }">
    $ <input
      :id="inputId"
      v-model="field.price"
      type="number"
      min="0"
      step="0.01"
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][price]`"
    >

    // todo: implement formula for number field like val*10
    // todo: also implement price formulas for all fields like field_x_val*val*10. Only fields from above can be used in the formula to prevent recursions

    <p v-if="field.type === 'pt' && field.is_selectable">
      You are able to set custom price for each post on their edit pages after filter is saved.
      // todo: show list of posts missing the price settings
    </p>
  </template>
</jab-field>