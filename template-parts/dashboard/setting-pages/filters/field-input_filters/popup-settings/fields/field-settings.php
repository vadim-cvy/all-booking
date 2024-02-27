<jbk-field
  class="jbk-filter-instance__popup-stettings__fields__field__label"
  label="Label"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.label"
      type="text"
    >
  </template>
</jbk-field>

<jbk-field
  class="jbk-filter-instance__popup-stettings__fields__field__type"
  label="Type"
>
  <template #default="{ inputId }">
    <select
      :id="inputId"
      v-model="field.type"
    >
      <option value="pt">Post Type</option>
      <option value="true_false">True/false</option>
      <option value="number">Number</option>
    </select>
  </template>
</jbk-field>

<jbk-field
  v-if="field.type"
  class="jbk-filter-instance__popup-stettings__fields__field__price"
  :label="field.type === 'number' ? 'Price Formula' : 'Price'"
>
  <template #default="{ inputId }">
    <p v-if="field.type === 'pt'">
      You will be able to set the price for each post on its edit page.

      // todo: show list of posts missing the price settings
    </p>

    <div
      v-else-if="field.type === 'number'"
      class="jbk-filter-instance__popup-stettings__fields__field__price__formula"
    >
      <input
        :id="inputId"
        v-model="field.priceFormula"
        type="text"
        pattern="[0-9\(\)\-\+\/\*\$\.]*"
      >
      <p>
        Use "$" placeholder to refer the number specified by the user. For example, if you want to charge $10 per item, you should enter "$*10".
      </p>
    </div>

    <div v-else-if="field.type === 'true_false'">
      <input
        :id="inputId"
        v-model="field.price"
        type="number"
        min="0"
        step="0.01"
      >
    </div>
  </template>
</jbk-field>

<jbk-field
  v-if="field.type === 'pt'"
  class="jbk-filter-instance__popup-stettings__fields__field__is-selectable"
  label="Can user select specific post(s) right from popup?"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.isSelectable"
      type="checkbox"
    >
  </template>
</jbk-field>

<jbk-field
  v-if="field.type === 'pt'"
  class="jbk-filter-instance__popup-stettings__fields__field__is-number-adjustable"
  :label="'Can user adjust the number of items ' + ( field.isSelectable ? 'of the selected type' : '' ) + ' they want to book?'"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.isNumberAdjustable"
      type="checkbox"
    >
  </template>
</jbk-field>

<jbk-field
  v-if="field.type"
  class="jbk-filter-instance__popup-stettings__fields__field__sub-fields"
  label="Sub Fields"
>
  <template #default="{ inputId }">
    // todo
    // todo: all subfields of numeric pt or number will be shown the number of times specified in the number input value
  </template>
</jbk-field>