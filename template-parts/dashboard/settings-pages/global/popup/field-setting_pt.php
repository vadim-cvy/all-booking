<jab-field
  class="jab-filter-instance__popup-stettings__fields__field__pt"
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
      :name="`jab[filters][${filterInstanceIndex}][popup][fields][${fieldIndex}][pt]`"
    >
  </template>
</jab-field>