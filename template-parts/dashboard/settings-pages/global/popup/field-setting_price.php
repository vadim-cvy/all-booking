<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__price"
  :label="
    field.type === 'pt' && field.is_number_adjustable ? 'Default Price per 1 Item' :
    field.type === 'pt' ? 'Post Default Price' :
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

    <p v-if="field.type === 'pt' && field.is_selectable">
      You are able to set custom price for each post on their edit pages after filter is saved.
      // todo: show list of posts missing the price settings
    </p>
  </template>
</jab-field>