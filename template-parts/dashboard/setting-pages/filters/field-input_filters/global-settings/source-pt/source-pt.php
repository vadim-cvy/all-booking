<jbk-field
  class="jbk-filter-instance__global-stettings__source-pt"
  label="Source Post Type"
>
  <template #default="{ inputId }">
    <select
      :id="inputId"
      v-model="filterInstance.sourcePt"
    >
      <option
        v-for="pt in pts"
        :key="pt.slug"
        :value="pt.slug"
      >
        {{ pt.label }}
      </option>
    </select>
  </template>
</jbk-field>