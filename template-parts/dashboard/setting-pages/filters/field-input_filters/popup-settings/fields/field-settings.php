<jbk-field
  class="jbk-filter-instance__popup-stettings__fields__field__label"
  label="Label"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.label"
      type="text"
      :name="`jbk_filters_settings[${filterInstanceIndex}][popup][fields][${fieldIndex}][label]`"
    >
  </template>
</jbk-field>

<jbk-field
  class="jbk-filter-instance__popup-stettings__fields__field__is-required"
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
      :name="`jbk_filters_settings[${filterInstanceIndex}][popup][fields][${fieldIndex}][is_required]`"
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
      :disabled="filterInstance.popup.fields[0] === field"
    >
      <option value="pt">Post Type</option>
      <option value="true_false">True/false</option>
      <option value="number">Number</option>
    </select>

    <input
      v-model="field.type"
      type="hidden"
      :name="`jbk_filters_settings[${filterInstanceIndex}][popup][fields][${fieldIndex}][type]`"
    >

    <p>
      // todo: pt > add terms conditions (only in terms/not in terms)
      // todo: pt > add option (for end users) to select not exactly a specific post but a trem of post type and post to be selected automatically
      // todo: pt > add swap option for different fields
    </p>
  </template>
</jbk-field>

<jbk-field
  v-if="field.type === 'pt'"
  class="jbk-filter-instance__popup-stettings__fields__field__pt"
  label="Post Type"
>
  <template #default="{ inputId }">
    <select
      :id="inputId"
      v-model="field.pt"
      :disabled="filterInstance.popup.fields[0] === field"
    >
      <option
        v-for="pt in pts"
        :key="pt.slug"
        :value="pt.slug"
      >
        {{ pt.label }}
      </option>
    </select>

    <input
      v-model="field.pt"
      type="hidden"
      :name="`jbk_filters_settings[${filterInstanceIndex}][popup][fields][${fieldIndex}][pt]`"
    >
  </template>
</jbk-field>

<jbk-field
  v-if="field.type === 'pt' && filterInstance.popup.fields[0] !== field"
  class="jbk-filter-instance__popup-stettings__fields__field__is-selectable"
  label="Can user select specific post(s) right from popup?"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.is_selectable"
      type="checkbox"
      :name="`jbk_filters_settings[${filterInstanceIndex}][popup][fields][${fieldIndex}][is_selectable]`"
    >
  </template>
</jbk-field>

<jbk-field
  v-if="field.type === 'pt'"
  class="jbk-filter-instance__popup-stettings__fields__field__is-number-adjustable"
  :label="'Can user adjust the number of posts to book?'"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.is_number_adjustable"
      type="checkbox"
      :name="`jbk_filters_settings[${filterInstanceIndex}][popup][fields][${fieldIndex}][is_number_adjustable]`"
    >
  </template>
</jbk-field>

<jbk-field
  v-if="field.type === 'pt' || field.type === 'number'"
  class="jbk-filter-instance__popup-stettings__fields__field__default-number"
  :label="
    (field.type === 'number' || (field.type === 'pt' && field.is_number_adjustable) ? 'Default' : '')
    + ( field.type === 'pt' ? ' Number of Items' : '' )
  "
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.default_number"
      type="number"
      :min="field.is_number_adjustable ? 0 : 1"
      step="1"
      :name="`jbk_filters_settings[${filterInstanceIndex}][popup][fields][${fieldIndex}][default_number]`"
    >
  </template>
</jbk-field>

<jbk-field
  v-if="(field.type === 'pt' && field.is_number_adjustable) || field.type === 'number'"
  class="jbk-filter-instance__popup-stettings__fields__field__max-number"
  :label="'Max' + ( field.type === 'pt' ? 'Number of Items' : '' )"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.max_number"
      type="number"
      :min="1"
      step="1"
      :name="`jbk_filters_settings[${filterInstanceIndex}][popup][fields][${fieldIndex}][max_number]`"
    >
  </template>
</jbk-field>

<jbk-field
  v-if="(field.type === 'pt' && field.is_number_adjustable) || field.type === 'number'"
  class="jbk-filter-instance__popup-stettings__fields__field__min-number"
  :label="'Min' + ( field.type === 'pt' ? 'Number of Items' : '' )"
>
  <template #default="{ inputId }">
    <input
      :id="inputId"
      v-model="field.min_number"
      type="number"
      :min="1"
      step="1"
      :name="`jbk_filters_settings[${filterInstanceIndex}][popup][fields][${fieldIndex}][min_number]`"
    >
  </template>
</jbk-field>

<jbk-field
  v-if="field.type"
  class="jbk-filter-instance__popup-stettings__fields__field__price"
  :label="
    field.type === 'pt' && field.is_selectable ?
    'Default Price per Item' :
      field.type === 'pt' || field.type === 'number' ?
      'Price per Item' :
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
      :name="`jbk_filters_settings[${filterInstanceIndex}][popup][fields][${fieldIndex}][price]`"
    >

    <p v-if="field.type === 'pt' && field.is_selectable">
      You are able to set custom price for each post on their edit pages after filter is saved.
      // todo: show list of posts missing the price settings
    </p>
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